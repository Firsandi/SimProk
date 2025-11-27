@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Anggota Room: {{ $room->name }}</h2>

    <form action="{{ route('admin.room.member.store', $room->id) }}" method="POST">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name" class="w-full border px-4 py-2 rounded"
                   value="{{ old('name') }}" placeholder="Masukkan nama anggota">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Username</label>
            <input type="text" name="username" class="w-full border px-4 py-2 rounded"
                   value="{{ old('username') }}" placeholder="Masukkan username unik">
            @error('username')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" class="w-full border px-4 py-2 rounded"
                   value="{{ old('email') }}" placeholder="Masukkan email anggota">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Role</label>
            <select name="role" class="w-full border px-4 py-2 rounded">
                <option value="">-- Pilih Role --</option>
                <option value="bendahara">Bendahara</option>
                <option value="sekretaris">Sekretaris</option>
            </select>
            @error('role')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.room.member.index', $room->id) }}"
               class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
