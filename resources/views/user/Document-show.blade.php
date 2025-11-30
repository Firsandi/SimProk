@extends('layouts.user')

@section('title', 'Detail Document')
@section('page-title', 'Detail Document')
@section('page-subtitle', 'Lihat detail dan status dokumen')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('user.documents') }}" class="inline-flex items-center text-sm font-semibold text-teal-600 hover:text-teal-700">
            <i class="mr-2 fas fa-arrow-left"></i>
            Kembali ke Daftar Dokumen
        </a>
    </div>

    <!-- Document Header -->
    <div class="p-6 mb-6 bg-white shadow-sm rounded-xl">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-teal-100 rounded-xl">
                    <i class="text-3xl text-teal-600 fas fa-file-pdf"></i>
                </div>
                <div>
                    <h2 class="mb-2 text-2xl font-bold text-gray-900">{{ $document->title }}</h2>
                    <div class="flex flex-wrap gap-3 text-sm text-gray-600">
                        <span class="flex items-center">
                            <i class="mr-1 text-teal-500 fas fa-building"></i>
                            {{ $document->room->name }}
                        </span>
                        <span class="flex items-center">
                            <i class="mr-1 text-teal-500 fas fa-briefcase"></i>
                            {{ $document->proker->name ?? '-' }}
                        </span>
                        <span class="flex items-center">
                            <i class="mr-1 text-teal-500 fas fa-user"></i>
                            {{ $document->submitter->name }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Status Badge -->
            @if ($document->latestStatus)
                <span class="px-4 py-2 text-sm font-semibold rounded-lg
                    @if ($document->latestStatus->status === 'approved') bg-green-100 text-green-800
                    @elseif ($document->latestStatus->status === 'revision') bg-blue-100 text-blue-800
                    @elseif ($document->latestStatus->status === 'rejected') bg-red-100 text-red-800
                    @else bg-yellow-100 text-yellow-800
                    @endif">
                    {{ $document->latestStatus->getStatusIcon() }} {{ ucfirst($document->latestStatus->status) }}
                </span>
            @else
                <span class="px-4 py-2 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-lg">
                    ⏳ Pending Review
                </span>
            @endif
        </div>
    </div>

    <!-- Document Info -->
    <div class="p-6 mb-6 bg-white shadow-sm rounded-xl">
        <h3 class="mb-4 text-lg font-bold text-gray-800">📋 Informasi Dokumen</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="mb-1 text-sm font-semibold text-gray-500">Tipe Dokumen</p>
                <p class="font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $document->document_type) }}</p>
            </div>
            <div>
                <p class="mb-1 text-sm font-semibold text-gray-500">Tanggal Upload</p>
                <p class="font-semibold text-gray-900">{{ $document->submitted_at->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="mb-1 text-sm font-semibold text-gray-500">Diupload Oleh</p>
                <p class="font-semibold text-gray-900">{{ $document->submitter->name }}</p>
            </div>
            <div>
                <p class="mb-1 text-sm font-semibold text-gray-500">Ukuran File</p>
                <p class="font-semibold text-gray-900">
                    {{ number_format(\Illuminate\Support\Facades\Storage::disk('public')->size($document->file_path) / 1024, 2) }} KB
                </p>
            </div>
        </div>

        @if ($document->notes)
            <div class="pt-4 mt-4 border-t">
                <p class="mb-2 text-sm font-semibold text-gray-500">📌 Catatan Pembuat</p>
                <p class="text-gray-700">{{ $document->notes }}</p>
            </div>
        @endif
    </div>

    <!-- Review History -->
    @if ($document->latestStatus && $document->latestStatus->notes)
        <div class="p-6 mb-6 border-l-4 border-blue-500 shadow-sm bg-blue-50 rounded-r-xl">
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full">
                    <i class="text-xl text-blue-600 fas fa-comment-alt"></i>
                </div>
                <div class="flex-1">
                    <h3 class="mb-2 text-lg font-bold text-blue-900">💬 Catatan Review dari Admin</h3>
                    <p class="mb-3 text-blue-900">{{ $document->latestStatus->notes }}</p>
                    <div class="flex items-center gap-4 text-sm text-blue-700">
                        <span class="flex items-center">
                            <i class="mr-1 fas fa-user"></i>
                            <strong>{{ $document->latestStatus->reviewer->name ?? 'Admin' }}</strong>
                        </span>
                        <span class="flex items-center">
                            <i class="mr-1 fas fa-clock"></i>
                            {{ $document->latestStatus->reviewed_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- All Status History -->
    @if ($statuses->count() > 1)
        <div class="p-6 mb-6 bg-white shadow-sm rounded-xl">
            <h3 class="mb-4 text-lg font-bold text-gray-800">📜 Riwayat Review</h3>
            <div class="space-y-3">
                @foreach ($statuses as $status)
                    <div class="flex items-start gap-3 p-4 border rounded-lg {{ $loop->first ? 'bg-gray-50 border-gray-300' : 'bg-white border-gray-200' }}">
                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-full
                            @if ($status->status === 'approved') bg-green-100 text-green-600
                            @elseif ($status->status === 'revision') bg-blue-100 text-blue-600
                            @elseif ($status->status === 'rejected') bg-red-100 text-red-600
                            @else bg-yellow-100 text-yellow-600
                            @endif">
                            {{ $status->getStatusIcon() }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-semibold text-gray-900 capitalize">{{ $status->status }}</span>
                                <span class="text-xs text-gray-500">{{ $status->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            @if ($status->notes)
                                <p class="text-sm text-gray-600">{{ $status->notes }}</p>
                            @endif
                            @if ($status->reviewer)
                                <p class="mt-1 text-xs text-gray-500">Oleh: {{ $status->reviewer->name }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex gap-3">
        <a href="{{ route('user.documents.download', $document->id) }}" 
           class="flex items-center justify-center flex-1 px-6 py-3 font-semibold text-white transition bg-blue-600 rounded-lg shadow-md hover:bg-blue-700">
            <i class="mr-2 fas fa-download"></i>
            Download Dokumen
        </a>

        @if (auth()->id() === $document->submitted_by && $document->isPending())
            <form action="{{ route('user.documents.destroy', $document->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="flex items-center justify-center w-full px-6 py-3 font-semibold text-white transition bg-red-600 rounded-lg shadow-md hover:bg-red-700">
                    <i class="mr-2 fas fa-trash"></i>
                    Hapus Dokumen
                </button>
            </form>
        @endif
    </div>

</div>
@endsection
