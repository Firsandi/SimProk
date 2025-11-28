<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\RoomProker;
use App\Models\RoomMember;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
    // Menampilkan form upload
    public function create($prokerId)
    {
        $proker = RoomProker::findOrFail($prokerId);
        $room = $proker->room;

        // Ambil role user di room
        $role = RoomMember::where('room_id', $room->id)
            ->where('user_id', auth()->id())
            ->value('role');

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

        return view('user.Document-create', compact('room', 'allowedDocs'));
    }

    // Menyimpan dokumen
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'title' => 'required|string|max:255',
            'document_type' => ['required', Rule::in(['proposal','lpj','layout_bpp','spj'])],
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'notes' => 'nullable|string',
        ]);

        $path = $request->file('file')->store("documents/room_{$request->room_id}", 'public');

        Document::create([
            'room_id' => $request->room_id,
            'proker_id' => $request->proker_id ?? null,
            'title' => $request->title,
            'document_type' => $request->document_type,
            'file_path' => $path,
            'submitted_by' => auth()->id(),
            'notes' => $request->notes,
        ]);

        return redirect()->route('user.documents')->with('success', 'Dokumen berhasil diunggah.');
    }
}
