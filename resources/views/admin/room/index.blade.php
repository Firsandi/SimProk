@extends('layouts.app')

@section('content')
<!-- Kontainer utama -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header tombol aksi -->
    <div class="flex justify-between items-center mb-8">
        <!-- Tombol balik ke dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="bg-gray-700 text-white px-5 py-2 rounded-lg shadow hover:bg-gray-800 transition">
            ← Kembali ke Dashboard
        </a>

        <!-- Tombol tambah UKM/Ormawa -->
        <a href="{{ route('admin.room.create') }}"
           class="bg-green-500 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition">
            + Tambah UKM / Ormawa
        </a>
    </div>

<!-- Grid daftar UKM/Ormawa -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        {{-- @foreach($rooms as $room) --}}
        @foreach($rooms as $room)
            <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden border border-gray-100">
                <!-- Header -->
                <div class="p-5 bg-{{ $room['color'] }}-700 text-black">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-bold leading-tight">{{ $room['name'] }}</h3>
                            <span class="block text-xs opacity-90 mt-1">Periode: {{ $room['period'] }}</span>
                        </div>
                        <span class="ml-2 text-xs px-3 py-1 rounded-full font-bold
                            {{ $room['status'] === 'active' ? 'bg-green-500' : 'bg-gray-400' }} uppercase tracking-wide">
                            {{ ucfirst($room['status']) }}
                        </span>
                    </div>
                </div>

                <!-- Body -->
                <div class="p-5 space-y-3 text-sm text-gray-700 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <span>Disetujui:</span>
                        <span class="font-bold text-green-700">{{ $room['approved'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Menunggu:</span>
                        <span class="font-bold text-yellow-600">{{ $room['pending'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Ditolak:</span>
                        <span class="font-bold text-red-700">{{ $room['rejected'] }}</span>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex justify-end items-center space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.room.edit', $room->id) }}"
                           class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition focus:outline-none">
                            Update
                        </a>
                        <form action="{{ route('admin.room.destroy', $room->id) }}" method="POST"
                              onsubmit="return confirm('Yakin mau hapus?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition focus:outline-none">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    {{-- </div> --}}
</div>
@endsection
