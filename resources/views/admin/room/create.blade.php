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
                    <h1 class="text-3xl font-bold text-white">Tambah UKM / Ormawa</h1>
                </div>
                <p class="text-blue-100">
                    Buat organisasi baru untuk mengelola dokumen dan program kerja
                </p>
            </div>
            
            <a href="{{ route('admin.room.index') }}"
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
                    <h3 class="text-lg font-bold text-gray-900">Form UKM / Ormawa Baru</h3>
                    <p class="text-xs text-gray-600">Lengkapi informasi dasar organisasi dan periode kepengurusan</p>
                </div>
            </div>
        </div>


        <form
            action="{{ route('admin.room.store') }}"
            method="POST"
            onsubmit="return confirmAction(this, {
                text: 'Pastikan data yang diinput sudah benar.',
                confirmText: 'Ya, simpan',
            });"
            class="px-6 py-6 space-y-6"
        >
            @csrf


            <!-- Nama -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Nama Organisasi
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300"
                    placeholder="Contoh: HIMTI (Himpunan Mahasiswa Teknik Informatika)"
                    required
                >
                @error('name')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <!-- Jenis Organisasi -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Jenis Organisasi
                </label>
                <div class="relative">
                    <select
                        name="organization_type"
                        class="w-full px-4 py-3 text-sm font-semibold transition bg-white border-2 border-gray-200 appearance-none rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300"
                        required
                    >
                        <option value="ukm" {{ old('organization_type') === 'ukm' ? 'selected' : '' }}>
                            Unit Kegiatan Mahasiswa (UKM)
                        </option>
                        <option value="ormawa" {{ old('organization_type') === 'ormawa' ? 'selected' : '' }}>
                            Organisasi Mahasiswa (Ormawa)
                        </option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                @error('organization_type')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <!-- ✅ Periode Kepengurusan (DROPDOWN TAHUN) -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Periode Kepengurusan
                </label>
                <div class="relative">
                    <select
                        name="period"
                        class="w-full px-4 py-3 text-sm font-semibold transition bg-white border-2 border-gray-200 appearance-none rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300"
                        required
                    >
                        <option value="">-- Pilih Tahun Periode --</option>
                        @for ($year = $currentYear; $year <= $currentYear + 5; $year++)
                            <option value="{{ $year }}" {{ old('period') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                <p class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pilih tahun periode kepengurusan (minimal {{ $currentYear }})
                </p>
                @error('period')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <!-- Status -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Status Organisasi
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="relative flex items-center gap-3 p-4 transition border-2 border-gray-200 cursor-pointer rounded-xl hover:border-green-300 hover:bg-green-50/30 has-[:checked]:border-green-500 has-[:checked]:bg-green-50">
                        <input
                            type="radio"
                            name="status"
                            value="active"
                            {{ old('status', 'active') === 'active' ? 'checked' : '' }}
                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-2 focus:ring-green-500"
                            required
                        >
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm font-semibold text-gray-900">Aktif</span>
                        </div>
                    </label>


                    <label class="relative flex items-center gap-3 p-4 transition border-2 border-gray-200 cursor-pointer rounded-xl hover:border-gray-400 hover:bg-gray-50/30 has-[:checked]:border-gray-500 has-[:checked]:bg-gray-50">
                        <input
                            type="radio"
                            name="status"
                            value="inactive"
                            {{ old('status') === 'inactive' ? 'checked' : '' }}
                            class="w-4 h-4 text-gray-600 border-gray-300 focus:ring-2 focus:ring-gray-500"
                        >
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                            <span class="text-sm font-semibold text-gray-900">Nonaktif</span>
                        </div>
                    </label>
                </div>
                @error('status')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <!-- Hidden field -->
            <input type="hidden" name="color" value="blue">


            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a
                    href="{{ route('admin.room.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-gray-700 transition bg-gray-100 rounded-xl hover:bg-gray-200"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white transition shadow-lg bg-gradient-to-r from-green-600 to-green-700 rounded-xl hover:shadow-xl hover:scale-105"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Tambah Organisasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
