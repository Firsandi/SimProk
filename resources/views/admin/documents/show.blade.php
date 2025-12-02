@extends('layouts.admin')

@section('title', 'Review Dokumen')

@section('content')
<div class="max-w-screen-md mx-auto">
    <h2 class="text-2xl font-bold mb-4">📄 Review Dokumen</h2>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Judul:</strong> {{ $document->title }}</p>
        <p><strong>Tipe:</strong> {{ strtoupper($document->document_type) }}</p>
        <p><strong>UKM/Ormawa:</strong> {{ $document->room->name }}</p>
        <p><strong>Proker:</strong> {{ $document->proker->nama_proker ?? '-' }}</p>
        <p><strong>Upload oleh:</strong> {{ $document->submitter->name }}</p>
        <p><strong>Tanggal:</strong> {{ $document->submitted_at->format('d M Y H:i') }}</p>
        <p><strong>Catatan:</strong> {{ $document->notes ?? '-' }}</p>

        <div class="mt-4">
            <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="text-indigo-600 hover:underline">📥 Lihat / Unduh Dokumen</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.dokumen.review', $document->id) }}" class="mt-6 bg-white p-6 rounded shadow">
        @csrf
        <label class="block mb-2 font-semibold">Status Review</label>
        <select name="status" class="w-full mb-4 border rounded p-2">
            <option value="approved">✅ Setujui</option>
            <option value="revision">✏️ Revisi</option>
            <option value="rejected">❌ Tolak</option>
        </select>

        <label class="block mb-2 font-semibold">Komentar / Catatan</label>
        <textarea name="notes" rows="4" class="w-full border rounded p-2 mb-4"></textarea>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan Review</button>
    </form>
</div>
@endsection
