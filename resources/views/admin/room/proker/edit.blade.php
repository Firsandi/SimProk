@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Program Kerja</h2>

    <form action="{{ route('admin.room.proker.update', [$room->id, $proker->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Proker -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Nama Proker</label>
            <input type="text" name="nama_proker" value="{{ old('nama_proker', $proker->nama_proker) }}"
                   class="w-full border px-4 py-2 rounded">
        </div>

        <!-- Tahun -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tahun</label>
            <input type="number" name="tahun" value="{{ old('tahun', $proker->tahun) }}"
                   class="w-full border px-4 py-2 rounded">
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Deskripsi Proker</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full border px-4 py-2 rounded">{{ old('deskripsi', $proker->deskripsi) }}</textarea>
        </div>

        <!-- Dropdown Anggota -->
        <div class="mb-4">
            <label class="block font-semibold">Pilih Anggota Proker</label>
            <select name="member_id" class="border rounded w-full">
                <option value="">-- Pilih Anggota --</option>
                @foreach($anggotaRoom as $user)
                    <option value="{{ $user->id }}"
                        {{ $proker->members->contains($user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-4 mt-6">
            <a href="{{ route('admin.room.proker.index', $room->id) }}"
               class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
