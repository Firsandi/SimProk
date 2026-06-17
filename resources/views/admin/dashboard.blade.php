@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@php
    $pageTitle = 'Dashboard';
    $pageSubtitle = 'Kelola dokumen dan aktivitas UKM/Ormawa';
@endphp

@section('content')
<div class="mx-auto max-w-screen-2xl animate-fade-in-up">

    <!-- Welcome Banner -->
    <div class="relative p-8 mb-8 overflow-hidden text-white shadow-xl bg-gradient-to-br from-blue-600 via-indigo-600 to-indigo-800 rounded-3xl group">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="absolute top-0 right-0 w-64 h-64 transition-transform duration-700 transform translate-x-16 -translate-y-16 bg-white rounded-full opacity-10 group-hover:scale-125"></div>
        
        <div class="relative z-10 flex flex-col items-start gap-6 md:flex-row md:items-center">
            <div class="flex items-center justify-center flex-shrink-0 w-20 h-20 shadow-2xl bg-white/20 backdrop-blur-md rounded-2xl ring-1 ring-white/30">
                <i class="text-4xl text-white fas fa-crown drop-shadow-md"></i>
            </div>
            <div>
                <h3 class="mb-2 text-3xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-blue-200">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h3>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold tracking-wide text-blue-900 uppercase bg-blue-200 rounded-full">
                        Administrator
                    </span>
                    <span class="flex items-center text-sm font-medium text-blue-100">
                        <i class="mr-2 fas fa-calendar-day"></i>
                        {{ now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="absolute transform -translate-y-1/2 opacity-5 -right-10 top-1/2 pointer-events-none transition-transform duration-1000 group-hover:rotate-12 group-hover:scale-110">
            <i class="fas fa-shield-alt text-[16rem]"></i>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4 stagger-1">
        <!-- Total UKM -->
        <div class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-xl hover:-translate-y-1 group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 shadow-inner bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl">
                        <i class="text-xl text-white fas fa-building"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 rounded-full shadow-sm">Total</span>
                </div>
                <h4 class="mb-1 text-4xl font-black text-gray-800">{{ $stats['total_ukm'] }}</h4>
                <p class="text-sm font-medium text-gray-500">UKM/Ormawa Terdaftar</p>
            </div>
        </div>

        <!-- Approved -->
        <div class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-xl hover:-translate-y-1 group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-gradient-to-br from-emerald-100 to-green-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 shadow-inner bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl">
                        <i class="text-xl text-white fas fa-check-circle"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-full shadow-sm">Approved</span>
                </div>
                <h4 class="mb-1 text-4xl font-black text-gray-800">{{ $stats['approved'] }}</h4>
                <p class="text-sm font-medium text-gray-500">Dokumen Disetujui</p>
            </div>
        </div>

        <!-- Pending -->
        <div class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-xl hover:-translate-y-1 group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-gradient-to-br from-amber-100 to-yellow-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 shadow-inner bg-gradient-to-br from-amber-500 to-yellow-500 rounded-xl">
                        <i class="text-xl text-white fas fa-hourglass-half"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 rounded-full shadow-sm">Pending</span>
                </div>
                <h4 class="mb-1 text-4xl font-black text-gray-800">{{ $stats['pending'] }}</h4>
                <p class="text-sm font-medium text-gray-500">Menunggu Review</p>
            </div>
        </div>

        <!-- Rejected -->
        <div class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-xl hover:-translate-y-1 group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-gradient-to-br from-rose-100 to-red-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 shadow-inner bg-gradient-to-br from-rose-500 to-red-600 rounded-xl">
                        <i class="text-xl text-white fas fa-times-circle"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-bold text-rose-700 bg-rose-50 border border-rose-200 rounded-full shadow-sm">Rejected</span>
                </div>
                <h4 class="mb-1 text-4xl font-black text-gray-800">{{ $stats['rejected'] }}</h4>
                <p class="text-sm font-medium text-gray-500">Revisi/Ditolak</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 stagger-2">
        <a href="{{ route('admin.room.index') }}" class="flex items-center gap-5 p-6 transition-all duration-300 bg-white border border-transparent shadow-sm rounded-2xl hover:shadow-xl hover:border-indigo-200 group">
            <div class="flex items-center justify-center transition-transform duration-300 shadow-inner bg-gradient-to-br from-indigo-500 to-purple-600 w-16 h-16 rounded-2xl group-hover:scale-110 group-hover:rotate-3">
                <i class="text-2xl text-white fas fa-building"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">Kelola Room</p>
                <p class="text-sm text-gray-500 mt-1">{{ $stats['total_ukm'] }} room aktif dan terdaftar</p>
            </div>
            <i class="fas fa-chevron-right ml-auto text-gray-300 group-hover:text-indigo-500 transition-colors group-hover:translate-x-1 transform duration-300"></i>
        </a>

        <a href="{{ route('admin.dokumen.index') }}" class="flex items-center gap-5 p-6 transition-all duration-300 bg-white border border-transparent shadow-sm rounded-2xl hover:shadow-xl hover:border-emerald-200 group">
            <div class="flex items-center justify-center transition-transform duration-300 shadow-inner bg-gradient-to-br from-emerald-500 to-teal-600 w-16 h-16 rounded-2xl group-hover:scale-110 group-hover:rotate-3">
                <i class="text-2xl text-white fas fa-file-alt"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">Review Dokumen</p>
                <p class="text-sm text-gray-500 mt-1">Periksa dokumen pengajuan terbaru</p>
            </div>
            <i class="fas fa-chevron-right ml-auto text-gray-300 group-hover:text-emerald-500 transition-colors group-hover:translate-x-1 transform duration-300"></i>
        </a>
    </div>

    <!-- Room Cards Section -->
    <div class="mb-8 stagger-3">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-black text-gray-800">Room Aktif Terkini</h3>
            <a href="{{ route('admin.room.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">Lihat Semua &rarr;</a>
        </div>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($rooms as $room)
                <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-2xl hover:shadow-2xl hover:-translate-y-1 group flex flex-col">
                    <!-- Header Card -->
                    <div class="p-6 bg-gradient-to-br from-slate-800 to-slate-900 relative">
                        <div class="absolute inset-0 bg-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <span class="absolute top-4 right-4 text-xs px-3 py-1.5 rounded-lg font-bold uppercase tracking-wider shadow-sm
                            {{ $room['status'] === 'active' ? 'bg-emerald-500 text-white' : 'bg-gray-600 text-gray-200' }}">
                            {{ $room['status'] }}
                        </span>
                        <div class="flex items-center gap-4 mb-2 relative z-10">
                            <div class="flex items-center justify-center w-12 h-12 bg-white/10 backdrop-blur-md rounded-xl ring-1 ring-white/20 shadow-inner group-hover:scale-105 transition-transform duration-300">
                                <i class="text-xl text-blue-300 fas fa-users"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xl font-bold text-white truncate">{{ $room['name'] }}</h4>
                                <p class="text-xs font-medium text-blue-200/70 mt-0.5"><i class="far fa-clock mr-1"></i>Periode: {{ $room['period'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6 flex-1 flex flex-col">
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-3 mb-5">
                            <div class="p-3 text-center rounded-xl bg-emerald-50/50 border border-emerald-100">
                                <p class="text-xl font-black text-emerald-600">{{ $room['approved'] }}</p>
                                <p class="text-[10px] font-bold text-emerald-800 uppercase tracking-wide mt-1">Disetujui</p>
                            </div>
                            <div class="p-3 text-center rounded-xl bg-amber-50/50 border border-amber-100">
                                <p class="text-xl font-black text-amber-600">{{ $room['pending'] }}</p>
                                <p class="text-[10px] font-bold text-amber-800 uppercase tracking-wide mt-1">Pending</p>
                            </div>
                            <div class="p-3 text-center rounded-xl bg-rose-50/50 border border-rose-100">
                                <p class="text-xl font-black text-rose-600">{{ $room['rejected'] }}</p>
                                <p class="text-[10px] font-bold text-rose-800 uppercase tracking-wide mt-1">Ditolak</p>
                            </div>
                        </div>

                        <!-- Notification -->
                        @if($room['has_notification'])
                            <div class="p-3.5 mb-5 border border-blue-200 rounded-xl bg-blue-50/50">
                                <p class="flex items-start text-sm font-medium text-blue-800">
                                    <i class="mt-0.5 mr-2 text-blue-500 fas fa-info-circle animate-pulse"></i>
                                    <span class="leading-relaxed">{{ $room['notification'] }}</span>
                                </p>
                            </div>
                        @endif

                        <!-- Action Button -->
                        <a href="{{ route('admin.room.proker.index', $room['id']) }}"
                           class="mt-auto flex items-center justify-center w-full px-4 py-3 text-sm font-bold text-white transition-all duration-300 shadow-md bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl hover:shadow-lg hover:from-blue-700 hover:to-indigo-700 hover:-translate-y-0.5 focus:ring-4 focus:ring-blue-500/30">
                            <i class="mr-2 fas fa-folder-open"></i>
                            Kelola Dokumen Proker
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
