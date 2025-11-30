@extends('layouts.user')

@section('title', 'Upload Document')
@section('page-title', 'Upload Document')
@section('page-subtitle', 'Unggah dokumen untuk room: ' . $room->name)

@section('content')
<div class="max-w-3xl mx-auto">
    
    <!-- Info Card Header -->
    <div class="p-5 mb-6 border-l-4 border-teal-500 bg-teal-50 rounded-xl">
        <div class="flex items-start gap-4">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-teal-100 rounded-full">
                <i class="text-xl text-teal-600 fas fa-upload"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-teal-900">Upload Dokumen</h3>
                <p class="text-sm text-teal-700">
                    <strong>Room:</strong> {{ $room->name }} | 
                    <strong>Proker:</strong> {{ $proker->name }}
                </p>
                <p class="mt-1 text-xs text-teal-600">
                    <i class="fas fa-info-circle"></i> Pastikan file dalam format PDF, DOC, atau DOCX (maks 10MB)
                </p>
            </div>
        </div>
    </div>

    <!-- Upload Form -->
    <form action="{{ route('user.documents.store') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white shadow-lg rounded-xl">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <input type="hidden" name="proker_id" value="{{ $proker->id }}">

        <!-- Judul Dokumen -->
        <div class="mb-6">
            <label class="flex items-center mb-2 text-sm font-semibold text-gray-700">
                <i class="mr-2 text-teal-500 fas fa-file-signature"></i>
                Judul Dokumen
                <span class="ml-1 text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title') }}"
                class="block w-full px-4 py-3 transition border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-2 focus:ring-teal-200" 
                placeholder="Contoh: Proposal Dies Natalis 2025"
                required>
            @error('title')
                <p class="flex items-center mt-2 text-sm text-red-600">
                    <i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Tipe Dokumen -->
        <div class="mb-6">
            <label class="flex items-center mb-2 text-sm font-semibold text-gray-700">
                <i class="mr-2 text-teal-500 fas fa-folder-open"></i>
                Tipe Dokumen
                <span class="ml-1 text-red-500">*</span>
            </label>
            <select 
                name="document_type" 
                class="block w-full px-4 py-3 transition border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-2 focus:ring-teal-200" 
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
            
            <!-- Info Dokumen yang Tidak Tersedia -->
            @php
                $unavailableDocs = array_filter($allowedDocs, fn($doc) => !$doc['enabled']);
            @endphp
            @if(count($unavailableDocs) > 0)
                <div class="p-3 mt-3 border-l-4 border-yellow-400 rounded-r-lg bg-yellow-50">
                    <p class="mb-1 text-xs font-semibold text-yellow-800">
                        <i class="fas fa-info-circle"></i> Dokumen yang belum tersedia:
                    </p>
                    @foreach($unavailableDocs as $doc)
                        <p class="text-xs text-yellow-700">• {{ $doc['label'] }} - Proker harus completed terlebih dahulu</p>
                    @endforeach
                </div>
            @endif

            @error('document_type')
                <p class="flex items-center mt-2 text-sm text-red-600">
                    <i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- File Upload with Drag & Drop Style -->
        <div class="mb-6">
            <label class="flex items-center mb-2 text-sm font-semibold text-gray-700">
                <i class="mr-2 text-teal-500 fas fa-cloud-upload-alt"></i>
                File Dokumen
                <span class="ml-1 text-red-500">*</span>
            </label>
            <div class="relative">
                <input 
                    type="file" 
                    name="file" 
                    id="file-input"
                    accept=".pdf,.doc,.docx" 
                    class="block w-full px-4 py-3 transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 focus:border-teal-500 focus:ring-2 focus:ring-teal-200" 
                    required
                    onchange="updateFileName(this)">
            </div>
            <p class="flex items-center mt-2 text-xs text-gray-500">
                <i class="mr-1 fas fa-check-circle text-emerald-500"></i>
                Format yang didukung: <strong class="ml-1">PDF, DOC, DOCX</strong> (Maksimal 10MB)
            </p>
            <p id="file-name" class="hidden mt-2 text-sm font-semibold text-teal-600"></p>
            
            @error('file')
                <p class="flex items-center mt-2 text-sm text-red-600">
                    <i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Catatan -->
        <div class="mb-8">
            <label class="flex items-center mb-2 text-sm font-semibold text-gray-700">
                <i class="mr-2 text-teal-500 fas fa-sticky-note"></i>
                Catatan (Opsional)
            </label>
            <textarea 
                name="notes" 
                rows="4" 
                class="block w-full px-4 py-3 transition border-gray-300 rounded-lg shadow-sm resize-none focus:border-teal-500 focus:ring-2 focus:ring-teal-200" 
                placeholder="Tambahkan catatan atau keterangan tambahan untuk dokumen ini...">{{ old('notes') }}</textarea>
            @error('notes')
                <p class="flex items-center mt-2 text-sm text-red-600">
                    <i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 pt-6 border-t">
            <a href="{{ route('user.myprokers') }}" 
               class="flex items-center justify-center flex-1 px-6 py-3 font-semibold text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                <i class="mr-2 fas fa-arrow-left"></i>
                Batal
            </a>
            <button 
                type="submit" 
                class="flex items-center justify-center flex-1 px-6 py-3 font-semibold text-white transition bg-teal-600 rounded-lg shadow-md hover:bg-teal-700 hover:shadow-lg">
                <i class="mr-2 fas fa-upload"></i>
                Upload Dokumen
            </button>
        </div>
    </form>

</div>

@push('scripts')
<script>
function updateFileName(input) {
    const fileName = input.files[0]?.name;
    const fileNameDisplay = document.getElementById('file-name');
    
    if (fileName) {
        fileNameDisplay.textContent = '📄 File terpilih: ' + fileName;
        fileNameDisplay.classList.remove('hidden');
    } else {
        fileNameDisplay.classList.add('hidden');
    }
}
</script>
@endpush
@endsection
