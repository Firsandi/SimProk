@extends('layouts.admin')

@section('content')
<!-- Kontainer utama -->
<div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!-- Header tombol aksi -->
    <div class="flex items-center justify-between mb-8">
        <!-- Tombol balik ke dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="px-5 py-2 text-white transition bg-gray-700 rounded-lg shadow hover:bg-gray-800">
            ← Kembali ke Dashboard
        </a>

        <!-- Tombol tambah UKM/Ormawa -->
        <a href="{{ route('admin.room.create') }}"
           class="px-5 py-2 text-white transition bg-green-500 rounded-lg shadow hover:bg-green-700">
            + Tambah UKM / Ormawa
        </a>
    </div>


<!-- Grid daftar UKM/Ormawa -->
<div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
        {{-- @foreach($rooms as $room) --}}
        @foreach($rooms as $room)
            <div class="overflow-hidden transition bg-white border border-gray-100 shadow rounded-2xl hover:shadow-xl">
                <!-- Header -->
                <div class="p-5 bg-{{ $room['color'] }}-700 text-black">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-bold leading-tight">{{ $room['name'] }}</h3>
                            <span class="block mt-1 text-xs opacity-90">Periode: {{ $room['period'] }}</span>
                        </div>
                        <span class="ml-2 text-xs px-3 py-1 rounded-full font-bold
                            {{ $room['status'] === 'active' ? 'bg-green-500' : 'bg-gray-400' }} uppercase tracking-wide">
                            {{ ucfirst($room['status']) }}
                        </span>
                    </div>
                </div>

                <!-- Body -->
                <div class="p-5 space-y-3 text-sm text-gray-700 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <span>Disetujui:</span>
                        <span class="font-bold text-green-700">{{ $room['approved'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Menunggu:</span>
                        <span class="font-bold text-yellow-600">{{ $room['pending'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Ditolak:</span>
                        <span class="font-bold text-red-700">{{ $room['rejected'] }}</span>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex items-center justify-end pt-4 space-x-3 border-t border-gray-200">
                        <a href="{{ route('admin.room.edit', $room->id) }}"
                           class="px-4 py-2 text-white transition bg-blue-700 rounded-lg hover:bg-indigo-700 focus:outline-none">
                            Update
                        </a>
                        <form action="{{ route('admin.room.destroy', $room->id) }}" method="POST"
                              onsubmit="return confirm('Yakin mau hapus?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 text-white transition bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none">
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
