<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
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
        $room = $proker->room;

        // Ambil role user di room
        $role = RoomMember::where('room_id', $room->id)
            ->where('user_id', auth()->id())
            ->value('role');

        if (!$role) {
            abort(403, 'Anda bukan member di room ini');
        }

        // Tentukan dokumen yang boleh diunggah
        $allowedDocs = [];
        if ($role === 'bendahara') {
            $allowedDocs[] = ['value' => 'layout_bpp', 'label' => 'Layout BPP', 'enabled' => true];
            $allowedDocs[] = ['value' => 'spj', 'label' => 'SPJ', 'enabled' => $proker->status === 'completed'];
        }
        if ($role === 'sekretaris') {
            $allowedDocs[] = ['value' => 'proposal', 'label' => 'Proposal', 'enabled' => true];
            $allowedDocs[] = ['value' => 'lpj', 'label' => 'LPJ', 'enabled' => $proker->status === 'completed'];
        }

        return view('user.Document-create', compact('proker', 'room', 'allowedDocs'));
    }

    // Simpan dokumen
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
        $path = $request->file('file')->store("documents/room_{$proker->room_id}/proker_{$proker->id}", 'public');

        Document::create([
            'room_id'       => $proker->room_id,
            'proker_id'     => $request->proker_id,
            'title'         => $request->title,
            'document_type' => $request->document_type,
            'file_path'     => $path,
            'submitted_by'  => auth()->id(),
            'notes'         => $request->notes,
        ]);

        return redirect()->route('user.documents')->with('success', '✅ Dokumen berhasil diunggah.');
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
