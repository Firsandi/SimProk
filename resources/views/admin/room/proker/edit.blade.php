@extends('layouts.admin')

@section('content')
<div class="w-800 max-w-screen-xl mx-auto bg-white shadow rounded px-6 py-8">
    <h2 class="text-2xl font-semibold mb-6">Edit Program Kerja</h2>

    <form action="{{ route('admin.room.proker.update', [$room->id, $proker->id]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-1">Nama Proker</label>
            <input type="text" name="nama_proker"
                   value="{{ old('nama_proker', $proker->nama_proker) }}"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-300" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Tahun</label>
            <input type="number" name="tahun"
                value="{{ old('tahun', $proker->tahun) }}"
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-300" required>
        </div>


        <div>
            <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="5"
                      class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-300">{{ old('deskripsi', $proker->deskripsi) }}</textarea>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.room.proker.index', $room->id) }}"
   class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 transition focus:outline-none">
    Batal
</a>

            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                Update Proker
            </button>
        </div>
    </form>
</div>
@endsection
