@extends('layouts.admin')

@section('content')
<div class="max-w-md p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-4 text-2xl font-bold text-indigo-700">Edit Program Kerja</h2>

    <form action="{{ route('admin.room.proker.update', [$room->id, $proker->id]) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Proker --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold">Nama Proker</label>
            <input
                type="text"
                name="nama_proker"
                class="w-full px-3 py-2 border rounded"
                value="{{ old('nama_proker', $proker->nama_proker) }}"
                required
            >
            @error('nama_proker')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tahun --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold">Tahun</label>
            <input
                type="number"
                name="tahun"
                class="w-full px-3 py-2 border rounded"
                value="{{ old('tahun', $proker->tahun) }}"
                required
            >
            @error('tahun')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-semibold">Deskripsi Proker</label>
            <textarea
                name="deskripsi"
                rows="4"
                class="w-full px-3 py-2 border rounded"
            >{{ old('deskripsi', $proker->deskripsi) }}</textarea>
            @error('deskripsi')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Pilih Anggota Proker (satu orang, opsional) --}}
        <div class="mb-6">
            <label class="block mb-1 text-sm font-semibold">Pilih Anggota Proker</label>
            <select name="member_id" class="w-full px-3 py-2 border rounded">
                <option value="">-- Pilih Anggota --</option>
                @foreach ($anggotaRoom as $user)
                    <option value="{{ $user->id }}"
                        {{ old('member_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.room.proker.index', $room->id) }}"
               class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-indigo-600 rounded hover:bg-indigo-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
