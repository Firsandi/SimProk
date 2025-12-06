@extends('layouts.admin')


@section('content')
<div class="px-4 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">


    <!-- Header dengan gradient biru -->
    <div class="relative p-8 mb-8 overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center w-12 h-12 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white">UKM / Ormawa</h1>
                </div>
                <p class="text-blue-100">
                    Kelola organisasi kemahasiswaan, periode kepengurusan, dan status aktif
                </p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-blue-600 transition bg-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('admin.room.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition bg-gradient-to-r from-green-600 to-green-700 rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah UKM / Ormawa
                </a>
            </div>
        </div>
    </div>


    <!-- Stats Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-3">
        <div class="p-6 transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-50">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-blue-600 uppercase bg-blue-50 px-2.5 py-1 rounded-full">
                    @if(request()->hasAny(['period', 'status', 'org_type']))
                        Filtered
                    @else
                        Total
                    @endif
                </span>
            </div>
            <p class="mb-1 text-2xl font-bold text-gray-900">{{ count($rooms) }}</p>
            <p class="text-xs text-gray-500">
                @if(request()->hasAny(['period', 'status', 'org_type']))
                    Hasil Filter
                @else
                    Total Organisasi
                @endif
            </p>
        </div>


        <div class="p-6 transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-green-50">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-600 uppercase bg-green-50 px-2.5 py-1 rounded-full">Active</span>
            </div>
            <p class="mb-1 text-2xl font-bold text-gray-900">
                {{ collect($rooms)->where('status', 'active')->count() }}
            </p>
            <p class="text-xs text-gray-500">Organisasi Aktif</p>
        </div>


        <div class="p-6 transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gray-50">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-gray-600 uppercase bg-gray-50 px-2.5 py-1 rounded-full">Inactive</span>
            </div>
            <p class="mb-1 text-2xl font-bold text-gray-900">
                {{ collect($rooms)->where('status', 'inactive')->count() }}
            </p>
            <p class="text-xs text-gray-500">Organisasi Nonaktif</p>
        </div>
    </div>


    <!-- ✅ FILTER SECTION (BARU) -->
    <div class="p-6 mb-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="flex items-center gap-3 mb-4">
            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-blue-600">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-900">Filter & Pencarian</h3>
                <p class="text-xs text-gray-600">Tampilkan organisasi berdasarkan periode, status, atau jenis</p>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.room.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <!-- Filter Periode -->
                <div>
                    <label class="block mb-2 text-xs font-bold text-gray-700">Periode Kepengurusan</label>
                    <div class="relative">
                        <select name="period" class="w-full px-4 py-2.5 text-sm bg-white border-2 border-gray-200 rounded-xl appearance-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300">
                            <option value="">-- Semua Periode --</option>
                            @foreach($periods as $period)
                                <option value="{{ $period }}" {{ request('period') == $period ? 'selected' : '' }}>
                                    {{ $period }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filter Status -->
                <div>
                    <label class="block mb-2 text-xs font-bold text-gray-700">Status Organisasi</label>
                    <div class="relative">
                        <select name="status" class="w-full px-4 py-2.5 text-sm bg-white border-2 border-gray-200 rounded-xl appearance-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300">
                            <option value="">-- Semua Status --</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filter Jenis Organisasi -->
                <div>
                    <label class="block mb-2 text-xs font-bold text-gray-700">Jenis Organisasi</label>
                    <div class="relative">
                        <select name="org_type" class="w-full px-4 py-2.5 text-sm bg-white border-2 border-gray-200 rounded-xl appearance-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300">
                            <option value="">-- Semua Jenis --</option>
                            <option value="ukm" {{ request('org_type') == 'ukm' ? 'selected' : '' }}>UKM</option>
                            <option value="ormawa" {{ request('org_type') == 'ormawa' ? 'selected' : '' }}>Ormawa</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-bold text-white transition bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter
                    </button>
                    
                    @if(request()->hasAny(['period', 'status', 'org_type']))
                        <a href="{{ route('admin.room.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-bold text-gray-700 transition bg-gray-100 rounded-xl hover:bg-gray-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
            </div>

            <!-- Info Filter Aktif -->
            @if(request()->hasAny(['period', 'status', 'org_type']))
                <div class="flex items-center gap-2 p-3 border-l-4 border-blue-500 rounded-lg bg-blue-50">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1 text-sm">
                        <span class="font-semibold text-blue-900">Filter Aktif:</span>
                        <span class="text-blue-700">
                            @if(request('period'))
                                Periode: <strong>{{ request('period') }}</strong>
                            @endif
                            @if(request('status'))
                                {{ request('period') ? '|' : '' }} Status: <strong>{{ request('status') == 'active' ? 'Aktif' : 'Nonaktif' }}</strong>
                            @endif
                            @if(request('org_type'))
                                {{ request('period') || request('status') ? '|' : '' }} Jenis: <strong>{{ strtoupper(request('org_type')) }}</strong>
                            @endif
                        </span>
                    </div>
                </div>
            @endif
        </form>
    </div>
    <!-- ✅ AKHIR FILTER SECTION -->


    <!-- Grid daftar UKM/Ormawa -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse($rooms as $room)
            @php
                $isActive = $room['status'] === 'active';
                $statusConfig = $isActive
                    ? [
                        'bgClass' => 'bg-green-50',
                        'textClass' => 'text-green-700',
                        'borderClass' => 'border-green-200',
                        'label' => 'Aktif',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                    ]
                    : [
                        'bgClass' => 'bg-gray-50',
                        'textClass' => 'text-gray-700',
                        'borderClass' => 'border-gray-200',
                        'label' => 'Nonaktif',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                    ];
            @endphp


            <div class="overflow-hidden transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-xl hover:border-blue-200 group">
                <!-- Header dengan gradient biru -->
                <div class="relative px-6 py-5 overflow-hidden text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700">
                    <div class="absolute top-0 right-0 w-32 h-32 transform translate-x-16 -translate-y-16 bg-white rounded-full opacity-10"></div>
                    
                    <div class="relative flex items-start justify-between gap-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="flex items-center justify-center w-10 h-10 bg-white rounded-lg bg-opacity-20 backdrop-blur-sm">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold leading-tight line-clamp-2">
                                    {{ $room['name'] }}
                                </h3>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-blue-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Periode: {{ $room['period'] }}</span>
                            </div>
                        </div>
                        
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-lg {{ $statusConfig['bgClass'] }} {{ $statusConfig['textClass'] }} border-2 {{ $statusConfig['borderClass'] }} shadow-sm">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $statusConfig['icon'] !!}
                                </svg>
                                {{ $statusConfig['label'] }}
                            </span>
                        </div>
                    </div>
                </div>


                <!-- Info tambahan (Anggota & Proker) -->
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-2">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Anggota</p>
                                <p class="text-sm font-bold text-gray-900">{{ $room['members_count'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Proker</p>
                                <p class="text-sm font-bold text-gray-900">{{ $room['prokers_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Tombol aksi -->
                <div class="flex items-center justify-between px-6 py-4 bg-gray-50/60">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.room.edit', $room['id']) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-blue-700 transition border-2 border-blue-100 rounded-lg bg-blue-50 hover:bg-blue-100 hover:border-blue-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form
                            action="{{ route('admin.room.destroy', $room['id']) }}"
                            method="POST"
                            onsubmit="return confirmAction(this, {
                                text: 'Data yang dihapus tidak dapat dikembalikan.',
                                confirmText: 'Ya, hapus',
                                icon: 'error',
                            });"
                            class="inline"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-red-700 transition border-2 border-red-100 rounded-lg bg-red-50 hover:bg-red-100 hover:border-red-200"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="flex flex-col items-center justify-center px-6 py-16 bg-white border-2 border-gray-200 border-dashed rounded-2xl">
                    <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gray-50">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <p class="mb-2 text-lg font-semibold text-gray-900">
                        @if(request()->hasAny(['period', 'status', 'org_type']))
                            Tidak Ada Hasil
                        @else
                            Belum Ada UKM / Ormawa
                        @endif
                    </p>
                    <p class="mb-4 text-sm text-gray-500">
                        @if(request()->hasAny(['period', 'status', 'org_type']))
                            Coba ubah filter atau reset pencarian
                        @else
                            Tambahkan organisasi kemahasiswaan pertama Anda
                        @endif
                    </p>
                    @if(request()->hasAny(['period', 'status', 'org_type']))
                        <a href="{{ route('admin.room.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition bg-gradient-to-r from-gray-600 to-gray-700 rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reset Filter
                        </a>
                    @else
                        <a href="{{ route('admin.room.create') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah UKM / Ormawa
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
