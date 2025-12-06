<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentStatus;
use Illuminate\Http\Request;
use App\Models\Room;   

class DocumentAdminController extends Controller
{
    public function index()
    {
        $documents = Document::paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function show(Document $document, Room $room)
    {
        $document->load(['room','proker','statuses','submitter']);

        $documents = Document::where('room_id', $room->id)->get();
        return view('admin.documents.show', compact('document'));
    }

    public function review(Request $request, Document $document)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,revision',
            'notes'  => 'nullable|string',
        ]);

        $document->statuses()->create([
            'status'      => $request->status,
            'reviewed_by' => auth()->id(),
            'notes'       => $request->notes,
            'reviewed_at' => now(),
        ]);

        //  Progress otomatis update karena pakai accessor di Model
        // Tidak perlu panggil updateProgress() lagi

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Status dokumen berhasil diperbarui.');
    }

}
