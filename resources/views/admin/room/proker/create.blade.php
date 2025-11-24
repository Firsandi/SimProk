@extends('layouts.app')

@section('content')
<div class="w-800 max-w-screen-xl mx-auto bg-white shadow rounded px-6 py-8">
    <h2 class="text-2xl font-bold mb-4">Tambah Program Kerja - {{ $room->name }}</h2>

    <form action="{{ route('admin.room.proker.store', $room->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="nama_proker" class="block font-semibold mb-1">Nama Proker</label>
            <input type="text" name="nama_proker" id="nama_proker" value="{{ old('nama_proker') }}"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-indigo-300">
            @error('nama_proker')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tahun" class="block font-semibold mb-1">Tahun</label>
            <input type="number" name="tahun" id="tahun" value="{{ old('tahun', date('Y')) }}"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-indigo-300">
            @error('tahun')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                      class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-indigo-300">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
<a href="{{ route('admin.room.proker.index', $room->id) }}"
   class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 transition focus:outline-none">
    Batal
</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
