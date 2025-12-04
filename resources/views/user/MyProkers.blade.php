@extends('layouts.user')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <!-- Header with Icon -->
    <div class="relative p-8 mb-8 overflow-hidden text-white shadow-xl bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 -mt-32 -mr-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 -mb-24 -ml-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-3">
                <div class="flex items-center justify-center bg-white w-14 h-14 rounded-xl bg-opacity-20 backdrop-blur-sm">
                    <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-white">My Program Kerja</h1>
                    <p class="text-teal-100">Daftar program kerja yang Anda ikuti</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="flex items-start gap-3 p-4 mb-6 text-green-800 border-l-4 border-green-500 shadow-sm rounded-xl bg-green-50">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Proker Cards Grid -->
    @if($myProkers->count() > 0)
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($myProkers as $proker)
                @php
                    $colors = [
                        ['border' => 'border-teal-500', 'bg' => 'bg-teal-50', 'text' => 'text-teal-600', 'gradient' => 'from-teal-500 to-emerald-600', 'icon' => 'text-teal-500'],
                        ['border' => 'border-blue-500', 'bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'gradient' => 'from-blue-500 to-indigo-600', 'icon' => 'text-blue-500'],
                        ['border' => 'border-purple-500', 'bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'gradient' => 'from-purple-500 to-pink-600', 'icon' => 'text-purple-500'],
                        ['border' => 'border-pink-500', 'bg' => 'bg-pink-50', 'text' => 'text-pink-600', 'gradient' => 'from-pink-500 to-rose-600', 'icon' => 'text-pink-500']
                    ];
                    $color = $colors[$loop->index % 4];
                @endphp
                
                <div class="p-6 transition bg-white border-l-4 shadow-sm {{ $color['border'] }} rounded-2xl hover:shadow-xl group">
                    
                    <!-- Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="mb-1 text-lg font-black text-gray-900 group-hover:{{ $color['text'] }} transition-colors">{{ $proker->name }}</h3>
                            <p class="flex items-center gap-1.5 text-sm text-gray-600">
                                <svg class="w-4 h-4 {{ $color['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                {{ $proker->room->name }}
                            </p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-gray-700 border-2 border-gray-200 rounded-lg bg-gray-50">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ ucfirst($proker->user_role ?? 'Anggota') }}
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="mb-4 text-sm leading-relaxed text-gray-600 line-clamp-2">
                        {{ $proker->description ?? 'Tidak ada deskripsi' }}
                    </p>

                    <!-- Meta Info -->
                    <div class="pb-4 mb-4 space-y-2.5 text-sm border-b border-gray-100">
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-4 h-4 {{ $color['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium">{{ $proker->period ?? date('Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-4 h-4 {{ $color['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="font-medium">{{ $proker->documents->count() }} Dokumen</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between mb-2 text-xs font-bold">
                            <span class="text-gray-600">Progress</span>
                            <span class="{{ $color['text'] }}">{{ $proker->progress ?? 0 }}%</span>
                        </div>
                        <div class="w-full h-3 overflow-hidden bg-gray-200 rounded-full">
                            <div class="h-full bg-gradient-to-r {{ $color['gradient'] }} transition-all duration-500 rounded-full shadow-inner" 
                                 style="width: {{ $proker->progress ?? 0 }}%"></div>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="mb-4">
                        @if($proker->status === 'completed')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-green-700 border-2 border-green-200 rounded-lg bg-green-50">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Completed
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-yellow-700 border-2 border-yellow-200 rounded-lg bg-yellow-50">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Ongoing
                            </span>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <a href="{{ route('user.documents.create', $proker->id) }}" 
                           class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-white transition shadow-lg bg-gradient-to-r {{ $color['gradient'] }} rounded-xl hover:shadow-xl hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Upload
                        </a>
                        <a href="{{ route('user.documents') }}" 
                           class="flex items-center justify-center px-4 py-3 text-sm font-bold text-gray-700 transition border-2 border-gray-200 rounded-xl bg-gray-50 hover:bg-gray-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-12 text-center text-gray-500 bg-white border-2 border-gray-200 border-dashed rounded-2xl">
            <div class="inline-flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gray-50">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
            </div>
            <h4 class="mb-2 text-lg font-bold text-gray-900">Belum Ada Program Kerja</h4>
            <p class="text-sm text-gray-500">Anda belum tergabung dalam program kerja apapun</p>
            <p class="mt-1 text-sm text-gray-400">Hubungi admin untuk ditambahkan ke room</p>
        </div>
    @endif

</div>
@endsection
