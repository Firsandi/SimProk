@extends('layouts.user')

@section('content')
<div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">

    <!-- Flash Messages -->
    @if(session('error'))
        <div class="relative mb-6 overflow-hidden transition-all duration-300 transform border-l-4 shadow-xl animate-slideIn border-red-500 rounded-2xl bg-gradient-to-r from-red-50 to-rose-50 hover:shadow-2xl hover:scale-[1.01]">
            <div class="flex items-start gap-4 p-5">
                <div class="flex items-center justify-center flex-shrink-0 bg-red-100 shadow-md w-11 h-11 rounded-xl">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-red-900">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-400 transition hover:text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Header dengan gradient TEAL -->
    <div class="relative p-8 mb-8 overflow-hidden transition-all duration-500 shadow-2xl bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 rounded-3xl hover:shadow-3xl hover:scale-[1.01]">
        <div class="absolute top-0 right-0 w-64 h-64 transition-transform duration-700 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10 hover:scale-110"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transition-transform duration-700 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10 hover:scale-110"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex items-center justify-center transition-all duration-300 transform bg-white shadow-xl w-14 h-14 rounded-2xl bg-opacity-20 backdrop-blur-sm hover:scale-110 hover:rotate-6">
                        <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-white">Upload Dokumen</h1>
                        <p class="text-sm font-medium text-teal-100 mt-0.5">
                            Unggah dokumen untuk {{ $proker->nama_proker }}
                        </p>
                    </div>
                </div>
                <p class="text-teal-100">
                    <strong>Organisasi:</strong> {{ $room->name }} • <strong>Tahun:</strong> {{ $proker->tahun }}
                </p>
            </div>
            
            <a href="{{ route('user.documents') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-teal-600 transition-all duration-300 transform bg-white shadow-lg rounded-xl hover:shadow-xl hover:scale-105 hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Info Card -->
    <div class="relative p-6 mb-8 overflow-hidden transition-all duration-300 transform border-l-4 shadow-lg border-emerald-500 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl hover:shadow-xl hover:scale-[1.01]">
        <div class="flex items-start gap-4">
            <div class="flex items-center justify-center flex-shrink-0 shadow-md w-14 h-14 rounded-2xl bg-emerald-100">
                <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="mb-2 text-lg font-bold text-emerald-900">Panduan Upload Dokumen</h3>
                <ul class="space-y-1.5 text-sm text-emerald-700">
                    <li class="flex items-center gap-2">
                        <svg class="flex-shrink-0 w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span><strong>Format:</strong> PDF, DOC, atau DOCX</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="flex-shrink-0 w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span><strong>Ukuran:</strong> Maksimal 10MB</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="flex-shrink-0 w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Pastikan nama file dan isi sesuai dengan tipe dokumen</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Upload Form -->
    <form action="{{ route('user.documents.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          onsubmit="return validateFileSize(event)"
          class="overflow-hidden transition-all duration-300 transform bg-white shadow-xl rounded-3xl hover:shadow-2xl">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <input type="hidden" name="proker_id" value="{{ $proker->id }}">

        <!-- Form Header -->
        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-teal-50 via-emerald-50 to-teal-50">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 shadow-sm rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Form Upload Dokumen</h3>
                    <p class="text-xs text-gray-600">Lengkapi informasi dokumen yang akan diupload</p>
                </div>
            </div>
        </div>

        <div class="p-8 space-y-6">
            <!-- Judul Dokumen -->
            <div>
                <label class="flex items-center gap-2 mb-3 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Judul Dokumen
                    <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title') }}"
                    class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500 hover:border-gray-300 @error('title') border-red-300 @enderror" 
                    placeholder="Contoh: Proposal Program Kerja Dies Natalis 2025"
                    required>
                @error('title')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Tipe Dokumen -->
            <div>
                <label class="flex items-center gap-2 mb-3 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    Tipe Dokumen
                    <span class="text-red-500">*</span>
                </label>
                <select 
                    name="document_type" 
                    class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500 hover:border-gray-300 @error('document_type') border-red-300 @enderror" 
                    required>
                    <option value="">-- Pilih Tipe Dokumen --</option>
                    @foreach($allowedDocs as $doc)
                        <option 
                            value="{{ $doc['value'] }}" 
                            {{ !$doc['enabled'] ? 'disabled' : '' }}
                            {{ old('document_type') === $doc['value'] ? 'selected' : '' }}>
                            {{ $doc['label'] }}
                            @if(!$doc['enabled']) (Hanya untuk proker completed) @endif
                        </option>
                    @endforeach
                </select>
                
                @php
                    $unavailableDocs = array_filter($allowedDocs, fn($doc) => !$doc['enabled']);
                @endphp
                @if(count($unavailableDocs) > 0)
                    <div class="flex items-start gap-3 p-4 mt-3 border-l-4 border-yellow-400 rounded-r-xl bg-yellow-50">
                        <svg class="flex-shrink-0 w-5 h-5 mt-0.5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="mb-2 text-sm font-bold text-yellow-900">Dokumen yang belum tersedia:</p>
                            @foreach($unavailableDocs as $doc)
                                <p class="flex items-center gap-1.5 text-xs text-yellow-700">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $doc['label'] }} - Proker harus completed terlebih dahulu
                                </p>
                            @endforeach
                        </div>
                    </div>
                @endif

                @error('document_type')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- File Upload -->
            <div>
                <label class="flex items-center gap-2 mb-3 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    File Dokumen
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="file" 
                        name="file" 
                        id="fileInput"
                        accept=".pdf,.doc,.docx" 
                        class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 border-dashed rounded-xl cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 @error('file') border-red-300 @enderror" 
                        required
                        onchange="updateFileName(this)">
                </div>
                <div class="flex items-start gap-2 p-3 mt-3 border-2 border-teal-100 rounded-xl bg-teal-50">
                    <svg class="flex-shrink-0 w-5 h-5 mt-0.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-xs font-bold text-teal-900">Format yang didukung:</p>
                        <p class="text-xs text-teal-700">PDF, DOC, DOCX (Maksimal <strong>10MB</strong>)</p>
                    </div>
                </div>
                <div id="file-name-display" class="hidden p-3 mt-3 border-2 border-blue-200 rounded-xl bg-blue-50">
                    <p class="flex items-center gap-2 text-sm font-semibold text-blue-900">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span id="file-name"></span>
                    </p>
                </div>
                
                @error('file')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Catatan -->
            <div>
                <label class="flex items-center gap-2 mb-3 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    Catatan (Opsional)
                </label>
                <textarea 
                    name="notes" 
                    rows="4" 
                    class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl resize-none focus:ring-2 focus:ring-teal-500/40 focus:border-teal-500 hover:border-gray-300 @error('notes') border-red-300 @enderror" 
                    placeholder="Tambahkan catatan atau keterangan tambahan untuk dokumen ini (opsional)...">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 px-8 py-6 border-t border-gray-100 bg-gray-50/50">
            <a href="{{ route('user.documents') }}" 
               class="inline-flex items-center justify-center flex-1 gap-2 px-6 py-3 text-sm font-bold text-gray-700 transition-all duration-300 transform bg-gray-100 rounded-xl hover:bg-gray-200 hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </a>
            <button 
                type="submit"
                onclick="event.preventDefault(); confirmAction(this.closest('form'), {
                    title: 'Konfirmasi Upload',
                    text: 'Yakin ingin mengupload dokumen ini?',
                    confirmText: 'Ya, upload',
                    cancelText: 'Batal',
                    icon: 'question'
                    });"
                    class="inline-flex items-center justify-center flex-1 gap-2 px-6 py-3 text-sm font-bold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-green-600 to-emerald-700 rounded-xl hover:shadow-xl hover:scale-105 hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Upload Dokumen
                </button>
        </div>
    </form>
</div>

<style>
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slideIn {
    animation: slideIn 0.5s ease-out;
}
</style>

<!-- ✅ SWEETALERT ERROR VALIDATION (dari Laravel) -->
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal Upload Dokumen!',
        html: `
            <ul style="text-align: left; padding-left: 20px; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li style="margin-bottom: 8px;">{{ $error }}</li>
                @endforeach
            </ul>
        `,
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'OK, Saya Mengerti'
    });
</script>
@endif

<!-- ✅ SWEETALERT ERROR FROM SESSION -->
@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Tidak Dapat Upload!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'OK'
    });
</script>
@endif

<!-- ✅ VALIDASI FRONTEND (JavaScript) -->
<script>
    // Update file name display
    function updateFileName(input) {
        const fileName = input.files[0]?.name;
        const fileNameDisplay = document.getElementById('file-name-display');
        const fileNameText = document.getElementById('file-name');
        
        if (fileName) {
            fileNameText.textContent = 'File terpilih: ' + fileName;
            fileNameDisplay.classList.remove('hidden');
        } else {
            fileNameDisplay.classList.add('hidden');
        }
    }

    // Validate file size before submit
    function validateFileSize(event) {
        const fileInput = document.getElementById('fileInput');
        const file = fileInput.files[0];
        
        if (file) {
            const maxSize = 10 * 1024 * 1024; // 10MB dalam bytes
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            
            if (file.size > maxSize) {
                event.preventDefault(); // Stop form submit
                
                Swal.fire({
                    icon: 'error',
                    title: 'File Terlalu Besar!',
                    html: `
                        <div style="text-align: left; padding: 10px;">
                            <p style="margin-bottom: 10px;">📁 <strong>Ukuran file yang Anda pilih:</strong> ${fileSizeMB} MB</p>
                            <p style="margin-bottom: 10px;">⚠️ <strong>Maksimal ukuran file:</strong> 10 MB</p>
                            <hr style="margin: 15px 0; border-color: #e5e7eb;">
                            <p style="font-size: 14px; color: #6b7280;">
                                💡 <strong>Solusi:</strong><br>
                                • Kompres file PDF Anda menggunakan tools online seperti 
                                  <a href="https://www.ilovepdf.com/compress_pdf" target="_blank" style="color: #0d9488; text-decoration: underline;">ILovePDF</a><br>
                                • Atau pilih file lain yang lebih kecil
                            </p>
                        </div>
                    `,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK, Saya Mengerti',
                    width: '600px'
                });
                
                return false;
            }
        }
        
        return true;
    }
</script>
@endsection
