@extends('layouts.user')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Kelola dokumen dan program kerja Anda dengan mudah')

@section('content')
    <!-- Welcome Banner with Gradient -->
    <div class="relative p-8 mb-8 overflow-hidden text-white shadow-xl bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 -mt-32 -mr-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 -mb-24 -ml-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-4">
                <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                    </svg>
                </div>
                <div>
                    <h3 class="mb-1 text-3xl font-black text-white">Selamat Datang, {{ auth()->user()->name }}!</h3>
                    <div class="flex items-center gap-3 text-teal-100">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold text-white bg-white/20 rounded-full backdrop-blur-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                        </span>
                    </div>
                </div>
            </div>
            <p class="text-lg font-medium text-teal-50">Kelola dokumen program kerja Anda dengan mudah dan efisien</p>
        </div>
    </div>

    <!-- Stats Cards with Animation -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <!-- Total Rooms -->
        <div class="relative p-6 overflow-hidden transition bg-white border-2 border-transparent shadow-sm group rounded-2xl hover:shadow-xl hover:border-teal-200">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-teal-100 rounded-full opacity-30 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center shadow-lg w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-xl">
                        <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1.5 text-xs font-bold text-teal-700 bg-teal-50 rounded-full border-2 border-teal-200">Room</span>
                </div>
                <h4 class="mb-2 text-4xl font-black text-gray-900">{{ $totalRooms }}</h4>
                <p class="text-sm font-medium text-gray-600">Total Room Tergabung</p>
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-xs font-semibold text-teal-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Aktif berpartisipasi
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Documents -->
        <div class="relative p-6 overflow-hidden transition bg-white border-2 border-transparent shadow-sm group rounded-2xl hover:shadow-xl hover:border-blue-200">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-blue-100 rounded-full opacity-30 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center shadow-lg w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl">
                        <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1.5 text-xs font-bold text-blue-700 bg-blue-50 rounded-full border-2 border-blue-200">Dokumen</span>
                </div>
                <h4 class="mb-2 text-4xl font-black text-gray-900">{{ $totalDocs }}</h4>
                <p class="text-sm font-medium text-gray-600">Dokumen Terupload</p>
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-xs font-semibold text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Terupload dengan sukses
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="relative p-6 overflow-hidden transition bg-white border-2 border-transparent shadow-sm group rounded-2xl hover:shadow-xl hover:border-yellow-200">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-yellow-100 rounded-full opacity-30 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center shadow-lg w-14 h-14 bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl">
                        <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1.5 text-xs font-bold text-yellow-700 bg-yellow-50 rounded-full border-2 border-yellow-200">Review</span>
                </div>
                <h4 class="mb-2 text-4xl font-black text-gray-900">{{ $pendingDocs }}</h4>
                <p class="text-sm font-medium text-gray-600">Menunggu Review</p>
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-xs font-semibold text-yellow-600">
                        <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Sedang dalam proses review
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2 lg:grid-cols-4">
        <a href="{{ route('user.myprokers') }}" class="flex items-center gap-4 p-5 transition bg-white border-2 border-transparent shadow-sm group rounded-xl hover:shadow-lg hover:bg-teal-50 hover:border-teal-200">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition shadow-md rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600 group-hover:scale-110">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-gray-900">My Prokers</p>
                <p class="text-xs text-gray-500">Lihat semua proker</p>
            </div>
        </a>

        <a href="{{ route('user.documents') }}" class="flex items-center gap-4 p-5 transition bg-white border-2 border-transparent shadow-sm group rounded-xl hover:shadow-lg hover:bg-blue-50 hover:border-blue-200">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition shadow-md rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 group-hover:scale-110">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-gray-900">Dokumen Saya</p>
                <p class="text-xs text-gray-500">Kelola dokumen</p>
            </div>
        </a>

        <a href="{{ route('user.notifications') }}" class="flex items-center gap-4 p-5 transition bg-white border-2 border-transparent shadow-sm group rounded-xl hover:shadow-lg hover:bg-purple-50 hover:border-purple-200">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition shadow-md rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 group-hover:scale-110">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-gray-900">Notifikasi</p>
                <p class="text-xs text-gray-500">Lihat pemberitahuan</p>
            </div>
        </a>

        <a href="{{ route('user.profile') }}" class="flex items-center gap-4 p-5 transition bg-white border-2 border-transparent shadow-sm group rounded-xl hover:shadow-lg hover:bg-gray-50 hover:border-gray-200">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition shadow-md rounded-xl bg-gradient-to-br from-gray-500 to-gray-700 group-hover:scale-110">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-gray-900">Profil</p>
                <p class="text-xs text-gray-500">Lihat profil saya</p>
            </div>
        </a>
    </div>

    <!-- My Prokers Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-teal-500 to-emerald-600">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-gray-900">My Prokers</h3>
                    <p class="text-sm text-gray-500">Program kerja yang sedang Anda ikuti</p>
                </div>
            </div>
            <a href="{{ route('user.myprokers') }}" class="flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white transition shadow-lg bg-gradient-to-r from-teal-600 to-emerald-600 rounded-xl hover:shadow-xl hover:scale-105">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        @if($myProkers->count() > 0)
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($myProkers as $proker)
                    @php
                        $colors = [
                            ['border' => 'border-teal-500', 'bg' => 'bg-teal-50', 'text' => 'text-teal-600', 'gradient' => 'from-teal-500 to-emerald-600'],
                            ['border' => 'border-blue-500', 'bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'gradient' => 'from-blue-500 to-indigo-600'],
                            ['border' => 'border-purple-500', 'bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'gradient' => 'from-purple-500 to-pink-600'],
                            ['border' => 'border-pink-500', 'bg' => 'bg-pink-50', 'text' => 'text-pink-600', 'gradient' => 'from-pink-500 to-rose-600']
                        ];
                        $color = $colors[$loop->index % 4];
                    @endphp
                    <div class="p-6 transition bg-white border-l-4 shadow-sm {{ $color['border'] }} rounded-2xl hover:shadow-xl group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="mb-2 text-lg font-black text-gray-900 group-hover:{{ $color['text'] }} transition-colors">{{ $proker->name }}</h4>
                                <p class="flex items-center gap-1.5 text-sm text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $proker->room->name }}
                                </p>
                            </div>
                            @if($proker->status === 'completed')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-green-700 border-2 border-green-200 rounded-lg bg-green-50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-yellow-700 border-2 border-yellow-200 rounded-lg bg-yellow-50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Berjalan
                                </span>
                            @endif
                        </div>

                        <p class="mb-4 text-sm leading-relaxed text-gray-600 line-clamp-2">
                            {{ $proker->description ?? 'Tidak ada deskripsi' }}
                        </p>

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

                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 pb-4 mb-4 text-xs text-gray-500 border-b border-gray-100">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $proker->period }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $proker->documents->count() }} Dokumen
                            </span>
                        </div>

                        <a href="{{ route('user.documents.create', $proker->id) }}" 
                           class="flex items-center justify-center w-full px-4 py-3 text-sm font-bold text-white transition shadow-lg bg-gradient-to-r {{ $color['gradient'] }} rounded-xl hover:shadow-xl hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Upload Dokumen
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center text-gray-500 bg-white border-2 border-gray-200 border-dashed rounded-2xl">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gray-50">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h4 class="mb-2 text-lg font-bold text-gray-900">Belum Ada Proker</h4>
                <p class="text-sm text-gray-500">Anda belum tergabung dalam program kerja apapun</p>
            </div>
        @endif
    </div>

    <!-- Recent Documents Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-teal-500 to-emerald-600">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-gray-900">Recent Documents</h3>
                    <p class="text-sm text-gray-500">Dokumen yang baru saja Anda upload</p>
                </div>
            </div>
            <a href="{{ route('user.documents') }}" class="flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white transition shadow-lg bg-gradient-to-r from-teal-600 to-emerald-600 rounded-xl hover:shadow-xl hover:scale-105">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        @if($recentDocs->count() > 0)
            <div class="bg-white divide-y divide-gray-100 shadow-lg rounded-2xl">
                @foreach($recentDocs as $doc)
                    <div class="flex items-center justify-between p-5 transition group hover:bg-teal-50/30">
                        <div class="flex items-center flex-1 gap-4">
                            <div class="flex items-center justify-center flex-shrink-0 transition shadow-md w-14 h-14 rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600 group-hover:scale-110">
                                <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="mb-1 font-bold text-gray-900 truncate transition-colors group-hover:text-teal-600">{{ $doc->title }}</h4>
                                <div class="flex items-center gap-3 text-xs text-gray-500">
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        {{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}
                                    </span>
                                    <span>•</span>
                                    <span class="inline-flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $doc->submitted_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @if ($doc->latestStatus)
                                @if($doc->latestStatus->status === 'approved')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-green-700 border-2 border-green-200 rounded-lg bg-green-50 whitespace-nowrap">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Approved
                                    </span>
                                @elseif($doc->latestStatus->status === 'rejected')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-red-700 border-2 border-red-200 rounded-lg bg-red-50 whitespace-nowrap">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Rejected
                                    </span>
                                @elseif($doc->latestStatus->status === 'revision')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-blue-700 border-2 border-blue-200 rounded-lg bg-blue-50 whitespace-nowrap">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        Revision
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-yellow-700 border-2 border-yellow-200 rounded-lg bg-yellow-50 whitespace-nowrap">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ ucfirst($doc->latestStatus->status) }}
                                    </span>
                                @endif
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-yellow-700 border-2 border-yellow-200 rounded-lg bg-yellow-50 whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Pending
                                </span>
                            @endif
                            <a href="{{ route('user.documents.show', $doc->id) }}" 
                               class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-teal-600 transition border-2 border-teal-200 rounded-lg bg-teal-50 hover:bg-teal-100">
                                Lihat
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h4 class="mb-2 text-lg font-bold text-gray-900">Belum Ada Dokumen</h4>
                <p class="mb-4 text-sm text-gray-500">Mulai upload dokumen untuk proker Anda</p>
                <a href="{{ route('user.myprokers') }}" 
                   class="inline-flex items-center px-5 py-2.5 font-bold text-white transition shadow-lg bg-gradient-to-r from-teal-600 to-emerald-600 rounded-xl hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Upload Dokumen
                </a>
            </div>
        @endif
    </div>
@endsection
