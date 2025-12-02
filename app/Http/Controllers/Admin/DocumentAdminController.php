<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentStatus;
use Illuminate\Http\Request;

class DocumentAdminController extends Controller
{
    public function index()
    {
        $documents = Document::with(['room','proker','latestStatus','submitter'])
            ->latest()
            ->paginate(15);

        return view('admin.documents.index', compact('documents'));
    }

    public function show(Document $document)
    {
        $document->load(['room','proker','statuses','submitter']);

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

        return redirect()->route('admin.dokumen.index')->with('success', '✅ Status dokumen berhasil diperbarui.');
    }
}
