@extends('layouts.user')

@section('content')
<div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="relative mb-6 overflow-hidden transition-all duration-300 transform border-l-4 shadow-xl animate-slideIn border-emerald-500 rounded-2xl bg-gradient-to-r from-emerald-50 to-teal-50 hover:shadow-2xl hover:scale-[1.01]">
            <div class="flex items-start gap-4 p-5">
                <div class="flex items-center justify-center flex-shrink-0 shadow-md w-11 h-11 rounded-xl bg-emerald-100">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-emerald-900">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="transition text-emerald-400 hover:text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Header dengan gradient HIJAU -->
    <div class="relative p-8 mb-8 overflow-hidden transition-all duration-500 shadow-2xl bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 rounded-3xl hover:shadow-3xl hover:scale-[1.01]">
        <div class="absolute top-0 right-0 w-64 h-64 transition-transform duration-700 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10 hover:scale-110"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transition-transform duration-700 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10 hover:scale-110"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
            <div class="flex-1">
                <div class="flex items-start gap-4 mb-3">
                    <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 transition-all duration-300 transform bg-white shadow-xl rounded-2xl bg-opacity-20 backdrop-blur-sm hover:scale-110 hover:rotate-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="mb-2 text-3xl font-black text-white">{{ $document->title }}</h1>
                        <div class="flex flex-wrap gap-3 text-sm text-green-100">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                {{ $document->room->name }}
                            </span>
                            <span class="text-green-200">•</span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $document->proker->nama_proker ?? '-' }}
                            </span>
                            <span class="text-green-200">•</span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $document->submitter->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-wrap items-start gap-3">
                <!-- Status Badge -->
                @if ($document->latestStatus)
                    @php
                        $statusConfig = [
                            'approved' => [
                                'bg' => 'bg-gradient-to-r from-green-100 to-emerald-100', 
                                'text' => 'text-green-800', 
                                'border' => 'border-green-300',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                            ],
                            'revision' => [
                                'bg' => 'bg-gradient-to-r from-blue-100 to-cyan-100', 
                                'text' => 'text-blue-800', 
                                'border' => 'border-blue-300',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>'
                            ],
                            'rejected' => [
                                'bg' => 'bg-gradient-to-r from-red-100 to-rose-100', 
                                'text' => 'text-red-800', 
                                'border' => 'border-red-300',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                            ],
                        ];
                        $status = $document->latestStatus->status;
                        $config = $statusConfig[$status] ?? [
                            'bg' => 'bg-gradient-to-r from-yellow-100 to-amber-100', 
                            'text' => 'text-yellow-800', 
                            'border' => 'border-yellow-300',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                        ];
                    @endphp
                    <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold border-2 shadow-lg {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }} rounded-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $config['icon'] !!}
                        </svg>
                        <span class="capitalize">{{ $status }}</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-yellow-800 border-2 border-yellow-300 shadow-lg bg-gradient-to-r from-yellow-100 to-amber-100 rounded-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Pending Review</span>
                    </span>
                @endif

                <a href="{{ route('user.documents') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-green-600 transition-all duration-300 transform bg-white shadow-lg rounded-xl hover:shadow-xl hover:scale-105 hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Left Column -->
        <div class="space-y-6 lg:col-span-2">
            <!-- Document Info Card -->
            <div class="overflow-hidden transition-all duration-300 transform bg-white shadow-xl rounded-3xl hover:shadow-2xl">
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 shadow-sm rounded-xl bg-gradient-to-br from-green-500 to-emerald-600">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Informasi Dokumen</h3>
                            <p class="text-xs text-gray-600">Detail lengkap tentang dokumen ini</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="p-4 transition-all duration-200 border-2 border-gray-100 rounded-xl hover:border-green-200 hover:bg-green-50/30">
                            <p class="mb-1 text-xs font-semibold tracking-wider text-gray-500 uppercase">Tipe Dokumen</p>
                            <p class="text-sm font-bold text-gray-900 capitalize">{{ str_replace('_', ' ', $document->document_type) }}</p>
                        </div>
                        <div class="p-4 transition-all duration-200 border-2 border-gray-100 rounded-xl hover:border-green-200 hover:bg-green-50/30">
                            <p class="mb-1 text-xs font-semibold tracking-wider text-gray-500 uppercase">Tanggal Upload</p>
                            <p class="text-sm font-bold text-gray-900">{{ $document->submitted_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="p-4 transition-all duration-200 border-2 border-gray-100 rounded-xl hover:border-green-200 hover:bg-green-50/30">
                            <p class="mb-1 text-xs font-semibold tracking-wider text-gray-500 uppercase">Diupload Oleh</p>
                            <p class="text-sm font-bold text-gray-900">{{ $document->submitter->name }}</p>
                        </div>
                        <div class="p-4 transition-all duration-200 border-2 border-gray-100 rounded-xl hover:border-green-200 hover:bg-green-50/30">
                            <p class="mb-1 text-xs font-semibold tracking-wider text-gray-500 uppercase">Ukuran File</p>
                            <p class="text-sm font-bold text-gray-900">
                                {{ number_format(\Illuminate\Support\Facades\Storage::disk('public')->size($document->file_path) / 1024, 2) }} KB
                            </p>
                        </div>
                    </div>

                    @if ($document->notes)
                        <div class="flex items-start gap-3 p-4 mt-6 border-l-4 border-blue-400 rounded-r-xl bg-gradient-to-r from-blue-50 to-cyan-50">
                            <svg class="flex-shrink-0 w-5 h-5 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <p class="text-sm font-bold text-blue-900">Catatan Pembuat</p>
                                </div>
                                <p class="text-sm text-blue-700">{{ $document->notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Review from Admin -->
            @if ($document->latestStatus && $document->latestStatus->notes)
                <div class="overflow-hidden transition-all duration-300 transform border-l-4 shadow-xl border-blue-400 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-3xl hover:shadow-2xl hover:scale-[1.01]">
                    <div class="p-6">
                        <div class="flex items-start gap-4">
                            <div class="flex items-center justify-center flex-shrink-0 transition-all duration-300 transform shadow-md w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-cyan-100 hover:scale-110 hover:rotate-6">
                                <svg class="text-blue-600 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                    <h3 class="text-lg font-bold text-blue-900">Catatan Review dari Admin</h3>
                                </div>
                                <p class="mb-3 text-sm leading-relaxed text-blue-800">{{ $document->latestStatus->notes }}</p>
                                <div class="flex items-center gap-4 text-xs text-blue-700">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <strong>{{ $document->latestStatus->reviewer->name ?? 'Admin' }}</strong>
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $document->latestStatus->reviewed_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column - History -->
        <div class="lg:col-span-1">
            <div class="overflow-hidden transition-all duration-300 transform bg-white shadow-xl rounded-3xl hover:shadow-2xl">
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 via-pink-50 to-rose-50">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 shadow-sm rounded-xl bg-gradient-to-br from-purple-500 to-pink-600">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Riwayat Review</h3>
                            <p class="text-xs text-gray-600">{{ $statuses->count() }} aktivitas</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if($statuses->isEmpty())
                        <div class="py-8 text-center">
                            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-3 transition-transform duration-300 transform bg-gray-100 rounded-full hover:scale-110">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-900">Belum ada riwayat</p>
                            <p class="text-xs text-gray-500">Menunggu review dari admin</p>
                        </div>
                    @else
                        <div class="relative space-y-4">
                            <!-- Timeline Line -->
                            <div class="absolute top-0 bottom-0 w-0.5 bg-gradient-to-b from-purple-200 via-pink-200 to-rose-200 left-4"></div>
                            
                            @foreach ($statuses as $status)
                                @php
                                    $statusConfigs = [
                                        'approved' => [
                                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>', 
                                            'bg' => 'bg-green-100', 
                                            'text' => 'text-green-700', 
                                            'ring' => 'ring-green-200'
                                        ],
                                        'revision' => [
                                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>', 
                                            'bg' => 'bg-blue-100', 
                                            'text' => 'text-blue-700', 
                                            'ring' => 'ring-blue-200'
                                        ],
                                        'rejected' => [
                                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>', 
                                            'bg' => 'bg-red-100', 
                                            'text' => 'text-red-700', 
                                            'ring' => 'ring-red-200'
                                        ],
                                    ];
                                    $cfg = $statusConfigs[$status->status] ?? [
                                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>', 
                                        'bg' => 'bg-yellow-100', 
                                        'text' => 'text-yellow-700', 
                                        'ring' => 'ring-yellow-200'
                                    ];
                                @endphp
                                
                                <div class="relative flex items-start gap-3">
                                    <div class="relative z-10 flex items-center justify-center flex-shrink-0 w-8 h-8 transition-all duration-300 transform shadow-md {{ $cfg['bg'] }} {{ $cfg['text'] }} rounded-full ring-4 ring-white {{ $cfg['ring'] }} hover:scale-110">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            {!! $cfg['icon'] !!}
                                        </svg>
                                    </div>
                                    <div class="flex-1 pb-4">
                                        <div class="p-3 transition-all duration-200 border-2 border-gray-100 rounded-xl {{ $loop->first ? 'bg-purple-50/50 border-purple-200' : 'bg-white' }} hover:border-purple-200 hover:shadow-md">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="text-xs font-bold text-gray-900 capitalize">{{ $status->status }}</span>
                                                <span class="text-xs text-gray-400">{{ $status->created_at->format('d M, H:i') }}</span>
                                            </div>
                                            @if ($status->notes)
                                                <p class="mb-1 text-xs text-gray-600">{{ $status->notes }}</p>
                                            @endif
                                            @if ($status->reviewer)
                                                <p class="flex items-center gap-1 text-xs text-gray-500">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    {{ $status->reviewer->name }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-4 mt-8">
        <a href="{{ route('user.documents.download', $document->id) }}" 
           class="inline-flex items-center justify-center flex-1 gap-2 px-6 py-3 text-sm font-bold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-blue-600 to-cyan-700 rounded-xl hover:shadow-xl hover:scale-105 hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Download Dokumen
        </a>

        @if (auth()->id() === $document->submitted_by && $document->isPending())
            <form action="{{ route('user.documents.destroy', $document->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center justify-center w-full gap-2 px-6 py-3 text-sm font-bold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-red-600 to-rose-700 rounded-xl hover:shadow-xl hover:scale-105 hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Dokumen
                </button>
            </form>
        @endif
    </div>
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
@endsection
