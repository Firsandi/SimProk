@extends('layouts.admin')

@section('content')
<div class="mx-auto max-w-screen-md px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="flex flex-col justify-between gap-3 mb-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                ➕ Tambah Program Kerja - {{ $room->name }}
            </h2>
            <p class="text-sm text-gray-500">
                Buat program kerja baru untuk periode dan UKM/Ormawa terkait.
            </p>
        </div>
        <a
            href="{{ route('admin.room.proker.index', $room->id) }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50"
        >
            <i class="fas fa-arrow-left"></i>
            Kembali ke daftar proker
        </a>
    </div>

    <!-- Card Form -->
    <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/60">
            <h3 class="text-lg font-semibold text-gray-900">Form Program Kerja Baru</h3>
            <p class="text-xs text-gray-500">
                Lengkapi nama proker, tahun pelaksanaan, dan deskripsi singkat kegiatan.
            </p>
        </div>

        <form
            action="{{ route('admin.room.proker.store', $room->id) }}"
            method="POST"
            onsubmit="return confirmAction(this, {
                text: 'Pastikan data yang diinput sudah benar.',
                confirmText: 'Ya, simpan',
            });"
            class="px-6 py-5 space-y-5"
        >
            @csrf

            <!-- Nama Proker -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Nama Proker
                </label>
                <input
                    type="text"
                    name="nama_proker"
                    value="{{ old('nama_proker') }}"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    placeholder="Contoh: Seminar Kewirausahaan Nasional"
                    required
                >
                @error('nama_proker')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tahun -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Tahun
                </label>
                <input
                    type="number"
                    name="tahun"
                    value="{{ old('tahun', date('Y')) }}"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    placeholder="Masukkan tahun pelaksanaan"
                    required
                >
                @error('tahun')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Deskripsi
                </label>
                <textarea
                    name="deskripsi"
                    rows="4"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg resize-y focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    placeholder="Tuliskan gambaran singkat tujuan, sasaran, dan bentuk kegiatan..."
                >{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <a
                    href="{{ route('admin.room.proker.index', $room->id) }}"
                    class="px-6 py-2 text-sm font-semibold text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200"
                >
                    Batal
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2 text-sm font-semibold text-white transition bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700"
                >
                    <i class="fas fa-check"></i>
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
