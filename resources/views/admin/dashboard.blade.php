@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@php
    $pageTitle = 'Dashboard';
    $pageSubtitle = 'Kelola dokumen dan aktivitas UKM/Ormawa';
@endphp

@section('content')
<div class="mx-auto max-w-screen-2xl">

    <!-- Welcome Banner -->
    <div class="relative p-8 mb-8 overflow-hidden text-white shadow-lg bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-700 rounded-2xl">
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 backdrop-blur-sm rounded-xl">
                    <span class="text-4xl">👑</span>
                </div>
                <div>
                    <h3 class="text-3xl font-bold">Selamat Datang, {{ auth()->user()->name }}!</h3>
                    <p class="text-blue-100">Administrator • {{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
            <p class="text-lg text-blue-50">Kelola dokumen dan aktivitas UKM/Ormawa dengan mudah dan efisien</p>
        </div>
        <div class="absolute transform -translate-y-1/2 -right-8 top-1/2 opacity-10">
            <i class="fas fa-shield-alt" style="font-size: 15rem;"></i>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total UKM -->
        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm rounded-xl hover:shadow-lg group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-300 transform translate-x-16 -translate-y-16 bg-blue-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg">
                        <i class="text-2xl text-blue-600 fas fa-building"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">Total</span>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">{{ $stats['total_ukm'] }}</h4>
                <p class="text-sm text-gray-600">Total UKM/Ormawa</p>
            </div>
        </div>

        <!-- Approved -->
        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm rounded-xl hover:shadow-lg group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-300 transform translate-x-16 -translate-y-16 bg-green-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg">
                        <i class="text-2xl text-green-600 fas fa-check-circle"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Approved</span>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">{{ $stats['approved'] }}</h4>
                <p class="text-sm text-gray-600">Dokumen Disetujui</p>
            </div>
        </div>

        <!-- Pending -->
        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm rounded-xl hover:shadow-lg group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-300 transform translate-x-16 -translate-y-16 bg-yellow-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-lg">
                        <i class="text-2xl text-yellow-600 fas fa-hourglass-half"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">{{ $stats['pending'] }}</h4>
                <p class="text-sm text-gray-600">Menunggu Review</p>
            </div>
        </div>

        <!-- Rejected -->
        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm rounded-xl hover:shadow-lg group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-300 transform translate-x-16 -translate-y-16 bg-red-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-lg">
                        <i class="text-2xl text-red-600 fas fa-times-circle"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Rejected</span>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">{{ $stats['rejected'] }}</h4>
                <p class="text-sm text-gray-600">Revisi/Ditolak</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2">
        <a href="{{ route('admin.room.index') }}" class="flex items-center gap-4 p-5 transition bg-white shadow-sm rounded-xl hover:shadow-md group">
            <div class="flex items-center justify-center transition bg-purple-100 w-14 h-14 rounded-xl group-hover:bg-purple-200">
                <i class="text-2xl text-purple-600 fas fa-building"></i>
            </div>
            <div>
                <p class="text-lg font-bold text-gray-900">Kelola Room</p>
                <p class="text-sm text-gray-500">{{ $stats['total_ukm'] }} room aktif</p>
            </div>
        </a>

        <a href="{{ route('admin.timeline') }}" class="flex items-center gap-4 p-5 transition bg-white shadow-sm rounded-xl hover:shadow-md group">
            <div class="flex items-center justify-center transition bg-green-100 w-14 h-14 rounded-xl group-hover:bg-green-200">
                <i class="text-2xl text-green-600 fas fa-clock"></i>
            </div>
            <div>
                <p class="text-lg font-bold text-gray-900">Timeline</p>
                <p class="text-sm text-gray-500">Lihat aktivitas terbaru</p>
            </div>
        </a>
    </div>

    <!-- Room Cards Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">🏢 Daftar UKM/Ormawa</h3>
                <p class="text-sm text-gray-500">Kelola room dan program kerja</p>
            </div>
            <a href="{{ route('admin.room.create') }}" class="flex items-center gap-2 px-5 py-2 font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                <i class="fas fa-plus"></i>
                Tambah Room
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($rooms as $room)
                @php
                    $colors = ['blue', 'purple', 'pink', 'indigo', 'teal', 'green'];
                    $color = $colors[$loop->index % count($colors)];
                @endphp
                <div class="overflow-hidden transition bg-white shadow-sm rounded-xl hover:shadow-lg group">
                    <!-- Header Card -->
                    <div class="p-6 bg-{{ $color }}-600 relative">
                        <span class="absolute top-4 right-4 text-xs px-3 py-1 rounded-full font-semibold
                            {{ $room['status'] === 'active' ? 'bg-white text-' . $color . '-600' : 'bg-gray-700 text-white' }}">
                            {{ ucfirst($room['status']) }}
                        </span>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="flex items-center justify-center w-12 h-12 bg-white rounded-lg bg-opacity-20">
                                <i class="text-2xl text-white fas fa-building"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-white">{{ $room['name'] }}</h4>
                                <p class="text-sm text-white text-opacity-80">Periode: {{ $room['period'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Body Card -->
                    <div class="p-6">
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-3 mb-4">
                            <div class="p-3 text-center rounded-lg bg-green-50">
                                <p class="text-2xl font-bold text-green-600">{{ $room['approved'] }}</p>
                                <p class="text-xs text-gray-600">Disetujui</p>
                            </div>
                            <div class="p-3 text-center rounded-lg bg-yellow-50">
                                <p class="text-2xl font-bold text-yellow-600">{{ $room['pending'] }}</p>
                                <p class="text-xs text-gray-600">Pending</p>
                            </div>
                            <div class="p-3 text-center rounded-lg bg-red-50">
                                <p class="text-2xl font-bold text-red-600">{{ $room['rejected'] }}</p>
                                <p class="text-xs text-gray-600">Ditolak</p>
                            </div>
                        </div>

                        <!-- Notification -->
                        @if($room['has_notification'])
                            <div class="p-3 mb-4 border-l-4 border-blue-500 rounded-r-lg bg-blue-50">
                                <p class="flex items-center text-sm text-blue-800">
                                    <i class="mr-2 fas fa-info-circle"></i>
                                    {{ $room['notification'] }}
                                </p>
                            </div>
                        @endif

                        <!-- Action Button -->
                        <a href="{{ route('admin.room.proker.index', $room['id']) }}"
                           class="flex items-center justify-center w-full px-4 py-3 text-white bg-{{ $color }}-600 rounded-lg hover:bg-{{ $color }}-700 transition font-semibold">
                            <i class="mr-2 fas fa-eye"></i>
                            Lihat Program Kerja
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
