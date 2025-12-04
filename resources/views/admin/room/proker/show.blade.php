@extends('layouts.admin')

@section('content')
<div class="max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="relative mb-6 overflow-hidden transition-all duration-300 border-l-4 shadow-lg border-emerald-500 rounded-2xl bg-gradient-to-r from-emerald-50 to-teal-50 hover:shadow-xl">
            <div class="flex items-start gap-4 p-5">
                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-xl bg-emerald-100">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-emerald-900">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="relative mb-6 overflow-hidden transition-all duration-300 border-l-4 border-red-500 shadow-lg rounded-2xl bg-gradient-to-r from-red-50 to-rose-50 hover:shadow-xl">
            <div class="flex items-start gap-4 p-5">
                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-red-100 rounded-xl">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-red-900">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Header dengan gradient biru -->
    <div class="relative p-8 mb-8 overflow-hidden shadow-xl bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 rounded-3xl">
        <div class="absolute top-0 right-0 w-64 h-64 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex items-center justify-center bg-white shadow-lg w-14 h-14 rounded-2xl bg-opacity-20 backdrop-blur-sm">
                        <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-white">Detail Program Kerja</h1>
                        <p class="text-sm font-medium text-blue-100 mt-0.5">{{ $room->name }}</p>
                    </div>
                </div>
                <p class="text-blue-100">
                    Informasi lengkap program kerja dan manajemen anggota tim
                </p>
            </div>
            
            <a href="{{ route('admin.room.proker.index', $room->id) }}"
               class="inline-flex items-center gap-2 px-5 py-3 text-sm font-bold text-blue-600 transition-all duration-200 bg-white shadow-lg rounded-2xl hover:shadow-2xl hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        
        <!-- Left Column: Info Proker -->
        <div class="space-y-8 lg:col-span-2">
            
            <!-- Card Info Proker -->
            <div class="overflow-hidden transition-all duration-300 bg-white border-0 shadow-lg rounded-2xl hover:shadow-2xl">
                <!-- Header Card -->
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center flex-shrink-0 shadow-md w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600">
                            <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-black leading-tight text-gray-900">
                                {{ $proker->nama_proker }}
                            </h3>
                            <div class="flex items-center gap-2 mt-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Tahun Pelaksanaan: <span class="font-bold text-gray-900">{{ $proker->tahun }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-6 space-y-6">
                    <!-- Deskripsi -->
                    <div class="p-5 transition-all duration-200 border-2 border-gray-100 rounded-2xl bg-gradient-to-br from-gray-50 to-slate-50 hover:border-gray-200">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold tracking-wider text-gray-700 uppercase">
                                Deskripsi Program Kerja
                            </p>
                        </div>
                        <p class="text-sm leading-relaxed text-gray-700">
                            {{ $proker->deskripsi ?: 'Belum ada deskripsi untuk program kerja ini.' }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.room.proker.edit', [$room->id, $proker->id]) }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white transition-all duration-200 shadow-md bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl hover:scale-105 hover:shadow-xl">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Proker
                        </a>
                        <form action="{{ route('admin.room.proker.destroy', [$room->id, $proker->id]) }}"
                              method="POST"
                              onsubmit="return confirmAction(this, {text: 'Data yang dihapus tidak dapat dikembalikan.', confirmText: 'Ya, hapus', icon: 'error'});"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-red-600 transition-all duration-200 border-2 border-red-200 shadow-sm bg-red-50 rounded-xl hover:bg-red-100 hover:border-red-300 hover:scale-105">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List Anggota Proker -->
            <div class="overflow-hidden transition-all duration-300 bg-white border-0 shadow-lg rounded-2xl hover:shadow-2xl">
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-indigo-100 rounded-xl">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-black text-gray-900">Anggota Program Kerja</h4>
                                <p class="text-xs text-gray-500">Tim yang bertanggung jawab</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-indigo-700 border-2 border-indigo-200 rounded-xl bg-indigo-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            {{ $members->count() }} Anggota
                        </span>
                    </div>
                </div>

                <div class="px-6 py-6">
                    @if($members->isEmpty())
                        <div class="flex flex-col items-center justify-center px-6 py-12 border-2 border-gray-200 border-dashed bg-gray-50 rounded-2xl">
                            <div class="flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-gradient-to-br from-gray-100 to-gray-200">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <p class="mb-1 text-sm font-bold text-gray-900">Belum ada anggota</p>
                            <p class="text-sm text-gray-500">Belum ada anggota yang terdaftar untuk program kerja ini</p>
                        </div>
                    @else
                        <div class="grid gap-3">
                            @foreach ($members as $index => $member)
                                <div class="flex items-center gap-4 p-4 transition-all duration-200 border-2 border-gray-100 group rounded-2xl hover:border-indigo-200 hover:shadow-md hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50">
                                    <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition-transform duration-200 shadow-md rounded-xl bg-gradient-to-br from-blue-400 to-indigo-500 group-hover:scale-110">
                                        <span class="text-base font-bold text-white">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-gray-900">{{ $member->name }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold text-teal-700 bg-teal-50 border-2 border-teal-200 rounded-lg">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                {{ ucfirst($member->pivot->role ?? 'Anggota') }}
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Remove Button dengan SweetAlert -->
                                    <form action="{{ route('admin.room.proker.removeMember', [$room->id, $proker->id]) }}" 
                                        method="POST" 
                                        onsubmit="return confirmAction(this, {
                                            text: 'Anggota {{ $member->name }} akan dihapus dari proker ini. Tindakan ini tidak dapat dibatalkan.',
                                            confirmText: 'Ya, hapus anggota',
                                            icon: 'warning'
                                        });"
                                        class="inline">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $member->id }}">
                                        <button type="submit" 
                                                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-red-600 transition-all duration-200 border-2 border-red-200 shadow-sm opacity-0 bg-red-50 rounded-xl hover:bg-red-100 hover:border-red-300 group-hover:opacity-100 hover:scale-105">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Right Column: Form Tambah Anggota -->
        <div class="lg:col-span-1">
            <div class="sticky overflow-hidden transition-all duration-300 bg-white border-0 shadow-xl top-6 rounded-2xl hover:shadow-2xl">
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-br from-teal-50 via-emerald-50 to-cyan-50">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-12 h-12 shadow-md rounded-2xl bg-gradient-to-br from-teal-500 to-emerald-600">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900">Tambah Anggota</h4>
                            <p class="text-xs text-gray-500">Assign member ke proker</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-6">
                    @if(isset($availableMembers) && $availableMembers->count() > 0)
                        <form action="{{ route('admin.room.proker.addMember', [$room->id, $proker->id]) }}" 
                              method="POST" 
                              class="space-y-5">
                            @csrf
                            
                            <!-- ✅ HANYA SELECT USER - Role otomatis dari users.role -->
                            <div>
                                <label class="flex items-center gap-2 mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Pilih Anggota Organisasi
                                    <span class="text-red-500">*</span>
                                </label>
                                <select name="user_id" 
                                        class="w-full px-4 py-3 text-sm font-medium transition-all duration-200 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 hover:border-gray-300" 
                                        required>
                                    <option value="" class="text-gray-400">Pilih anggota...</option>
                                    @foreach($availableMembers as $member)
                                        <option value="{{ $member->id }}" class="font-medium">
                                            {{ $member->name }} ({{ ucfirst($member->role) }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="flex items-start gap-2 p-3 mt-3 border-2 border-blue-100 rounded-xl bg-blue-50">
                                    <svg class="flex-shrink-0 w-4 h-4 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-xs leading-relaxed text-blue-700">
                                        Role akan otomatis diambil dari data user. 
                                        Setiap proker hanya boleh memiliki <span class="font-bold">1 Sekretaris</span> dan <span class="font-bold">1 Bendahara</span>.
                                    </p>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    class="relative w-full py-4 overflow-hidden text-sm font-bold text-white transition-all duration-300 shadow-xl group bg-gradient-to-r from-teal-600 via-emerald-600 to-cyan-600 rounded-2xl hover:scale-105 hover:shadow-2xl">
                                <div class="absolute inset-0 w-0 transition-all duration-300 bg-white opacity-20 group-hover:w-full"></div>
                                <span class="relative flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                    Tambah & Kirim Notifikasi
                                </span>
                            </button>
                        </form>
                    @else
                        <div class="p-6 text-center border-2 border-gray-200 border-dashed rounded-2xl bg-gradient-to-br from-gray-50 to-slate-50">
                            <div class="inline-flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-gray-100 to-gray-200">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-gray-900">Semua Anggota Sudah Ditambahkan</p>
                            <p class="mt-1 text-xs text-gray-500">Tidak ada anggota organisasi yang tersedia untuk ditambahkan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
