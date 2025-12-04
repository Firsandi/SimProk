<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentStatus;
use App\Models\RoomProker;
use App\Models\RoomMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
    // List dokumen user
    public function index()
    {
        $documents = Document::where('submitted_by', auth()->id())
                             ->with('room', 'proker', 'latestStatus')
                             ->latest()
                             ->paginate(10);

        return view('user.Document-list', compact('documents'));
    }

    // Form upload dokumen
    public function create(RoomProker $proker)
    {
        // cek apakah user anggota proker
        if (!$proker->members()->where('user_id', auth()->id())->exists()) {
            abort(403, 'Anda bukan anggota proker ini');
        }

        $room = $proker->room;

        // Tentukan dokumen yang boleh diunggah sesuai role di proker
        $allowedDocs = [];

        // Ambil role user di room
        $role = RoomMember::where('room_id', $room->id)
            ->where('user_id', auth()->id())
            ->value('role');

        // Cek apakah proposal sudah di-approve
        $proposalApproved = Document::where('proker_id', $proker->id)
            ->where('document_type', 'proposal')
            ->whereHas('latestStatus', function($query) {
                $query->where('status', 'approved');
            })
            ->exists();

        // Cek apakah LPJ sudah di-approve
        $lpjApproved = Document::where('proker_id', $proker->id)
            ->where('document_type', 'lpj')
            ->whereHas('latestStatus', function($query) {
                $query->where('status', 'approved');
            })
            ->exists();

        // Cek apakah Layout BPP sudah di-approve
        $layoutBppApproved = Document::where('proker_id', $proker->id)
            ->where('document_type', 'layout_bpp')
            ->whereHas('latestStatus', function($query) {
                $query->where('status', 'approved');
            })
            ->exists();

        // Dokumen yang bisa diupload oleh Bendahara
        if ($role === 'bendahara') {
            $allowedDocs[] = [
                'value' => 'layout_bpp', 
                'label' => 'Layout BPP', 
                'enabled' => true // Layout BPP bisa diupload kapan saja
            ];
            $allowedDocs[] = [
                'value' => 'spj', 
                'label' => 'SPJ (Surat Pertanggungjawaban)', 
                'enabled' => $layoutBppApproved // SPJ bisa diupload jika Layout BPP sudah approved
            ];
        }

        // Dokumen yang bisa diupload oleh Sekretaris
        if ($role === 'sekretaris') {
            $allowedDocs[] = [
                'value' => 'proposal', 
                'label' => 'Proposal', 
                'enabled' => true // Proposal bisa diupload kapan saja
            ];
            $allowedDocs[] = [
                'value' => 'lpj', 
                'label' => 'LPJ (Laporan Pertanggungjawaban)', 
                'enabled' => $proposalApproved // LPJ bisa diupload jika Proposal sudah approved
            ];
        }

        return view('user.Document-create', compact('proker', 'room', 'allowedDocs'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'proker_id'     => 'required|exists:room_prokers,id',
            'title'         => 'required|string|max:255',
            'document_type' => ['required', Rule::in(['proposal', 'lpj', 'layout_bpp', 'spj'])],
            'file'          => 'required|file|mimes:pdf,doc,docx|max:10240',
            'notes'         => 'nullable|string',
        ]);

        $proker = RoomProker::findOrFail($request->proker_id);

        // cek apakah user anggota proker
        if (!$proker->members()->where('user_id', auth()->id())->exists()) {
            abort(403, 'Anda bukan anggota proker ini');
        }

        // Validasi tambahan: Cek apakah dokumen prasyarat sudah di-approve
        if ($request->document_type === 'lpj') {
            $proposalApproved = Document::where('proker_id', $proker->id)
                ->where('document_type', 'proposal')
                ->whereHas('latestStatus', function($query) {
                    $query->where('status', 'approved');
                })
                ->exists();

            if (!$proposalApproved) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Dokumen Proposal harus di-approve terlebih dahulu sebelum mengupload LPJ.');
            }
        }

        if ($request->document_type === 'spj') {
            $layoutBppApproved = Document::where('proker_id', $proker->id)
                ->where('document_type', 'layout_bpp')
                ->whereHas('latestStatus', function($query) {
                    $query->where('status', 'approved');
                })
                ->exists();

            if (!$layoutBppApproved) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Dokumen Layout BPP harus di-approve terlebih dahulu sebelum mengupload SPJ.');
            }
        }

        $path = $request->file('file')->store("documents/room_{$proker->room_id}/proker_{$proker->id}", 'public');

        $document = Document::create([
            'room_id'       => $proker->room_id,
            'proker_id'     => $request->proker_id,
            'title'         => $request->title,
            'document_type' => $request->document_type,
            'file_path'     => $path,
            'submitted_by'  => auth()->id(),
            'notes'         => $request->notes,
            'submitted_at'  => now(),
        ]);

        DocumentStatus::create([
            'document_id' => $document->id,
            'status'      => 'pending',
        ]);

        return redirect()->route('user.documents')
            ->with('success', 'Dokumen berhasil diunggah dan menunggu review.');
    }



    // Lihat detail dokumen
    public function show(Document $document)
    {
        if ($document->submitted_by !== auth()->id()) {
            abort(403);
        }

        $statuses = $document->statuses()->latest()->get();

        return view('user.Document-show', compact('document', 'statuses'));
    }

    // Download dokumen
    public function download(Document $document)
    {
        if ($document->submitted_by !== auth()->id()) {
            abort(403);
        }

        return Storage::disk('public')->download(
            $document->file_path,
            $document->title . '.pdf'
        );
    }

    // Hapus dokumen (hanya pending)
    public function destroy(Document $document)
    {
        if ($document->submitted_by !== auth()->id()) {
            abort(403);
        }

        if (!$document->isPending()) {
            return redirect()->back()->with('error', '❌ Hanya dokumen pending yang bisa dihapus');
        }

        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return redirect()->route('user.documents')->with('success', '✅ Dokumen berhasil dihapus.');
    }
}
