@extends('layouts.admin')

@section('title', 'Review Dokumen')

@section('content')
<div class="max-w-screen-xl mx-auto">

    <!-- Header dengan gradient biru -->
    <div class="relative p-8 mb-8 overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center w-12 h-12 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white">Review Dokumen</h1>
                </div>
                <p class="text-blue-100">
                    Tinjau detail dan tentukan status persetujuan dokumen
                </p>
            </div>
            
            <a href="{{ route('admin.dokumen.index') }}"
               class="inline-flex items-center gap-2 px-5 py-3 text-sm font-semibold text-blue-600 transition bg-white shadow-lg rounded-xl hover:shadow-xl hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-3">
        <!-- Kolom Kiri: Detail Dokumen -->
        <div class="space-y-6 lg:col-span-2">
            <!-- Card Info Dokumen -->
            <div class="overflow-hidden bg-white border-0 shadow-lg rounded-2xl">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Informasi Dokumen</h3>
                            <p class="text-xs text-gray-600">Detail lengkap dokumen yang diajukan</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    <!-- Judul -->
                    <div class="p-4 border-l-4 border-blue-500 rounded-r-lg bg-blue-50/50">
                        <p class="mb-1 text-xs font-bold tracking-wider text-blue-600 uppercase">Judul Dokumen</p>
                        <p class="text-lg font-bold text-gray-900">{{ $document->title }}</p>
                    </div>

                    <!-- Grid Info -->
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="p-4 transition border border-gray-100 rounded-xl hover:border-blue-200 hover:bg-blue-50/30">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <p class="text-xs font-bold tracking-wider text-gray-500 uppercase">Tipe Dokumen</p>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-lg bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-sm">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ strtoupper($document->document_type) }}
                            </span>
                        </div>

                        <div class="p-4 transition border border-gray-100 rounded-xl hover:border-indigo-200 hover:bg-indigo-50/30">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="flex items-center justify-center w-8 h-8 bg-indigo-100 rounded-lg">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <p class="text-xs font-bold tracking-wider text-gray-500 uppercase">Organisasi</p>
                            </div>
                            <p class="font-bold text-gray-900">{{ $document->room->name }}</p>
                        </div>

                        <div class="p-4 transition border border-gray-100 rounded-xl hover:border-blue-200 hover:bg-blue-50/30">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <p class="text-xs font-bold tracking-wider text-gray-500 uppercase">Program Kerja</p>
                            </div>
                            <p class="font-semibold text-gray-900">{{ $document->proker->nama_proker ?? '-' }}</p>
                        </div>

                        <div class="p-4 transition border border-gray-100 rounded-xl hover:border-indigo-200 hover:bg-indigo-50/30">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="flex items-center justify-center w-8 h-8 bg-indigo-100 rounded-lg">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <p class="text-xs font-bold tracking-wider text-gray-500 uppercase">Pengunggah</p>
                            </div>
                            <p class="font-semibold text-gray-900">{{ $document->submitter->name }}</p>
                        </div>

                        <div class="p-4 transition border border-gray-100 rounded-xl hover:border-blue-200 hover:bg-blue-50/30">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-xs font-bold tracking-wider text-gray-500 uppercase">Tanggal Upload</p>
                            </div>
                            <p class="font-semibold text-gray-900">
                                {{ $document->submitted_at->format('d M Y') }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $document->submitted_at->format('H:i') }} WIB</p>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="p-5 border-t border-gray-200 border-dashed bg-gray-50/50 rounded-xl">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="flex items-center justify-center w-8 h-8 bg-gray-200 rounded-lg">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold tracking-wider text-gray-700 uppercase">Catatan Pengunggah</p>
                        </div>
                        <p class="text-sm leading-relaxed text-gray-700">
                            {{ $document->notes ?: 'Tidak ada catatan tambahan dari pengunggah.' }}
                        </p>
                    </div>

                    <!-- Download Button -->
                    <div class="pt-4">
                        <a href="{{ Storage::url($document->file_path) }}"
                           target="_blank"
                           class="inline-flex items-center gap-3 px-6 py-3 text-sm font-bold text-white transition-all duration-200 shadow-lg bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl hover:shadow-xl hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Unduh / Lihat Dokumen
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form Review -->
        <div class="lg:col-span-1">
            <div class="sticky overflow-hidden bg-white border-0 shadow-lg rounded-2xl top-6">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Form Review</h3>
                            <p class="text-xs text-gray-600">Berikan penilaian Anda</p>
                        </div>
                    </div>
                </div>

                <form method="POST"
                      action="{{ route('admin.dokumen.review', $document->id) }}"
                      onsubmit="return confirmAction(this, {
                        text: 'Pastikan keputusan Anda sudah tepat.',
                        confirmText: 'Ya, Simpan Review',
                    });"
                      class="p-6 space-y-5">
                    @csrf

                    <!-- Status -->
                    <div>
                        <label for="status" class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Status Review
                        </label>
                        
                        <div class="relative">
                            <select
                                id="status"
                                name="status"
                                class="block w-full px-4 py-3 text-sm font-semibold transition border-2 border-gray-200 appearance-none rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300">
                                <option value="approved">Setujui Dokumen</option>
                                <option value="revision">Minta Revisi</option>
                                <option value="rejected">Tolak Dokumen</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Visual indicator untuk selected status -->
                        <div class="p-3 mt-3 transition-all duration-200 border-2 rounded-lg" id="status-indicator">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-lg" id="status-icon-container">
                                    <svg class="w-5 h-5 text-green-600" id="status-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase">Status yang dipilih</p>
                                    <p class="text-sm font-bold text-gray-900" id="status-text">Setujui Dokumen</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Komentar -->
                    <div>
                        <label for="notes" class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Komentar / Catatan
                        </label>
                        <textarea
                            id="notes"
                            name="notes"
                            rows="5"
                            class="block w-full px-4 py-3 text-sm transition border-2 border-gray-200 resize-none rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300"
                            placeholder="Berikan alasan atau saran perbaikan untuk pengaju dokumen..."></textarea>
                        <p class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Catatan ini akan dilihat oleh pengunggah dokumen
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="pt-3 space-y-3">
                        <button type="submit"
                                class="flex items-center justify-center w-full gap-2 px-6 py-3 text-sm font-bold text-white transition-all duration-200 shadow-lg bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl hover:shadow-xl hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Kirim Review
                        </button>
                        
                        <a href="{{ route('admin.dokumen.index') }}"
                           class="flex items-center justify-center w-full gap-2 px-6 py-3 text-sm font-bold text-gray-700 transition bg-gray-100 rounded-xl hover:bg-gray-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('status');
    const statusIndicator = document.getElementById('status-indicator');
    const statusIconContainer = document.getElementById('status-icon-container');
    const statusIcon = document.getElementById('status-icon');
    const statusText = document.getElementById('status-text');
    
    const statusConfig = {
        approved: {
            text: 'Setujui Dokumen',
            borderColor: 'border-green-200',
            bgColor: 'bg-green-50',
            iconBg: 'bg-green-100',
            iconColor: 'text-green-600',
            icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>'
        },
        revision: {
            text: 'Minta Revisi',
            borderColor: 'border-orange-200',
            bgColor: 'bg-orange-50',
            iconBg: 'bg-orange-100',
            iconColor: 'text-orange-600',
            icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>'
        },
        rejected: {
            text: 'Tolak Dokumen',
            borderColor: 'border-red-200',
            bgColor: 'bg-red-50',
            iconBg: 'bg-red-100',
            iconColor: 'text-red-600',
            icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>'
        }
    };
    
    function updateStatusIndicator(status) {
        const config = statusConfig[status];
        
        // Reset classes
        statusIndicator.className = 'mt-3 p-3 rounded-lg border-2 transition-all duration-200';
        statusIconContainer.className = 'flex items-center justify-center w-10 h-10 rounded-lg';
        statusIcon.className = 'w-5 h-5';
        
        // Apply new classes
        statusIndicator.classList.add(config.borderColor, config.bgColor);
        statusIconContainer.classList.add(config.iconBg);
        statusIcon.classList.add(config.iconColor);
        
        // Update icon and text
        statusIcon.innerHTML = config.icon;
        statusText.textContent = config.text;
    }
    
    statusSelect.addEventListener('change', function() {
        updateStatusIndicator(this.value);
    });
    
    // Initialize
    updateStatusIndicator(statusSelect.value);
});
</script>
@endsection
