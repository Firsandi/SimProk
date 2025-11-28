@extends('layouts.admin')

@section('content')
<div class="max-w-screen-xl px-6 py-8 mx-auto bg-white rounded shadow w-800">
    <h2 class="mb-4 text-2xl font-bold">Tambah Program Kerja - {{ $room->name }}</h2>

    <form action="{{ route('admin.room.proker.store', $room->id) }}" method="POST" class="p-6 bg-white rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="nama_proker" class="block mb-1 font-semibold">Nama Proker</label>
            <input type="text" name="nama_proker" id="nama_proker" value="{{ old('nama_proker') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-300">
            @error('nama_proker')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tahun" class="block mb-1 font-semibold">Tahun</label>
            <input type="number" name="tahun" id="tahun" value="{{ old('tahun', date('Y')) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-300">
            @error('tahun')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-indigo-300">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
<a href="{{ route('admin.room.proker.index', $room->id) }}"
   class="px-4 py-2 text-white transition bg-gray-500 rounded shadow hover:bg-gray-600 focus:outline-none">
    Batal
</a>
            <button type="submit" class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
