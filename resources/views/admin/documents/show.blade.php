@extends('layouts.admin')

@section('title', 'Review Dokumen')

@section('content')
<div class="mx-auto max-w-screen-lg">

    <!-- Header -->
    <div class="flex flex-col justify-between gap-3 mb-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">📄 Review Dokumen</h2>
            <p class="text-sm text-gray-500">
                Tinjau detail dokumen dan tentukan status persetujuan.
            </p>
        </div>
        <a href="{{ route('admin.dokumen.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 transition bg-white border border-gray-200 rounded-lg hover:bg-gray-50 shadow-sm">
            <i class="fas fa-arrow-left"></i>
            Kembali ke daftar
        </a>
    </div>

    <!-- Detail Dokumen -->
    <div class="mb-6 overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/60">
            <h3 class="text-lg font-semibold text-gray-900">Detail Dokumen</h3>
            <p class="text-xs text-gray-500">
                Informasi lengkap dokumen dari UKM/Ormawa terkait.
            </p>
        </div>

        <div class="px-6 py-5 space-y-3 text-sm text-gray-700">
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Judul</p>
                    <p class="mt-0.5 font-medium text-gray-900">{{ $document->title }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Tipe Dokumen</p>
                    <p class="mt-0.5">
                        <span class="inline-flex px-2.5 py-1 text-[11px] font-semibold rounded-full bg-blue-50 text-blue-700">
                            {{ strtoupper($document->document_type) }}
                        </span>
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">UKM / Ormawa</p>
                    <p class="mt-0.5 font-medium text-gray-900">{{ $document->room->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Program Kerja</p>
                    <p class="mt-0.5">{{ $document->proker->nama_proker ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Upload oleh</p>
                    <p class="mt-0.5">{{ $document->submitter->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Tanggal Upload</p>
                    <p class="mt-0.5">
                        {{ $document->submitted_at->format('d M Y H:i') }}
                    </p>
                </div>
            </div>

            <div class="pt-3 mt-3 border-t border-dashed border-gray-200">
                <p class="text-xs font-semibold text-gray-500 uppercase">Catatan dari pengunggah</p>
                <p class="mt-1 text-sm text-gray-700">
                    {{ $document->notes ?: '-' }}
                </p>
            </div>

            <div class="pt-4 mt-2">
                <a href="{{ Storage::url($document->file_path) }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm">
                    <i class="fas fa-download"></i>
                    Lihat / Unduh Dokumen
                </a>
            </div>
        </div>
    </div>

    <!-- Form Review -->
    <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/60">
            <h3 class="text-lg font-semibold text-gray-900">Form Review</h3>
            <p class="text-xs text-gray-500">
                Tentukan status dokumen dan berikan catatan jika diperlukan.
            </p>
        </div>

        <form method="POST"
              action="{{ route('admin.dokumen.review', $document->id) }}"
              onsubmit="return confirmAction(this, {
                text: 'Perubahan akan menggantikan data sebelumnya.',
                confirmText: 'Ya, update',
            });"
              class="px-6 py-5 space-y-4">
            @csrf

            <div>
                <label for="status" class="block mb-1 text-sm font-semibold text-gray-800">
                    Status Review
                </label>
                <select
                    id="status"
                    name="status"
                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">
                    <option value="approved">✅ Setujui</option>
                    <option value="revision">✏️ Revisi</option>
                    <option value="rejected">❌ Tolak</option>
                </select>
            </div>

            <div>
                <label for="notes" class="block mb-1 text-sm font-semibold text-gray-800">
                    Komentar / Catatan
                </label>
                <textarea
                    id="notes"
                    name="notes"
                    rows="4"
                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg resize-y focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500"
                    placeholder="Tuliskan alasan persetujuan, revisi, atau penolakan dokumen di sini..."></textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.dokumen.index') }}"
                   class="px-4 py-2 text-sm font-semibold text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm">
                    <i class="fas fa-save"></i>
                    Simpan Review
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
