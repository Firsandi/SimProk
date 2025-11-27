@extends('layouts.user')

@section('title', 'Upload Document')
@section('page-title', 'Upload Document')
@section('page-subtitle', 'Unggah dokumen untuk room: ' . $room->name)

@section('content')
    <form action="{{ route('user.document.store') }}" method="POST" enctype="multipart/form-data" class="p-6 bg-white shadow-sm rounded-xl">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Judul Dokumen</label>
            <input type="text" name="title" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" required>
            @error('title')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Jenis Dokumen</label>
            <select name="document_type" required class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                <option value="">Pilih jenis dokumen</option>
                @foreach($allowedDocs as $doc)
                    <option value="{{ $doc['value'] }}" {{ $doc['enabled'] ? '' : 'disabled' }}>
                        {{ $doc['label'] }} {{ $doc['enabled'] ? '' : '(tidak tersedia)' }}
                    </option>
                @endforeach
            </select>
            @foreach($allowedDocs as $doc)
                @if(!$doc['enabled'])
                    <p class="mt-1 text-xs text-gray-500">• {{ $doc['label'] }}: {{ $doc['reason'] ?? 'Tidak tersedia' }}</p>
                @endif
            @endforeach
            @error('document_type')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">File Dokumen</label>
            <input type="file" name="file" accept=".pdf,.doc,.docx" required class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm">
            <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX. Maks 10MB</p>
            @error('file')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
            <textarea name="notes" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm"></textarea>
            @error('notes')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700">
            Unggah Dokumen
        </button>
    </form>
@endsection
