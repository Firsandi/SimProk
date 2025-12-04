@extends('layouts.admin')

@section('content')
<div class="max-w-screen-md px-4 mx-auto sm:px-6 lg:px-8">

    <!-- Header dengan gradient biru -->
    <div class="relative p-8 mb-8 overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center w-12 h-12 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">Tambah Program Kerja</h1>
                        <p class="text-sm text-blue-100 mt-0.5">{{ $room->name }}</p>
                    </div>
                </div>
                <p class="text-blue-100">
                    Buat program kerja baru untuk periode dan organisasi terkait
                </p>
            </div>
            
            <a href="{{ route('admin.room.proker.index', $room->id) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-blue-600 transition bg-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Card Form -->
    <div class="overflow-hidden bg-white border-0 shadow-lg rounded-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Form Program Kerja Baru</h3>
                    <p class="text-xs text-gray-600">Lengkapi nama proker, tahun pelaksanaan, dan deskripsi kegiatan</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.room.proker.store', $room->id) }}"
              method="POST"
              onsubmit="return confirmAction(this, {
                  text: 'Pastikan data yang diinput sudah benar.',
                  confirmText: 'Ya, simpan',
              });"
              class="px-6 py-6 space-y-6">
            @csrf

            <!-- Nama Proker -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    Nama Program Kerja
                </label>
                <input type="text"
                       name="nama_proker"
                       value="{{ old('nama_proker') }}"
                       class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300 @error('nama_proker') border-red-300 @enderror"
                       placeholder="Contoh: Seminar Kewirausahaan Nasional"
                       required>
                <p class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Masukkan nama program kerja yang jelas dan deskriptif
                </p>
                @error('nama_proker')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Tahun -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Tahun Pelaksanaan
                </label>
                <input type="number"
                       name="tahun"
                       value="{{ old('tahun', date('Y')) }}"
                       class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300 @error('tahun') border-red-300 @enderror"
                       placeholder="Contoh: {{ date('Y') }}"
                       min="2000"
                       max="2099"
                       required>
                <p class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Tahun dilaksanakannya program kerja ini
                </p>
                @error('tahun')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Deskripsi Program Kerja
                </label>
                <textarea name="deskripsi"
                          rows="5"
                          class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl resize-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300 @error('deskripsi') border-red-300 @enderror"
                          placeholder="Tuliskan gambaran singkat tujuan, sasaran, dan bentuk kegiatan...">{{ old('deskripsi') }}</textarea>
                <p class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Jelaskan tujuan, target peserta, dan output yang diharapkan
                </p>
                @error('deskripsi')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.room.proker.index', $room->id) }}"
                   class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-gray-700 transition bg-gray-100 rounded-xl hover:bg-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white transition shadow-lg bg-gradient-to-r from-green-600 to-green-700 rounded-xl hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Tambah Program Kerja
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
