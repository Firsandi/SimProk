@extends('layouts.app')

@section('content')
<!-- Kontainer utama -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header tombol aksi -->
    <div class="flex justify-between items-center mb-8 gap-4">
        <!-- Tombol balik ke dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="bg-gray-700 text-white px-5 py-2 rounded-lg shadow hover:bg-gray-800 transition">
            ← Kembali ke Dashboard
        </a>

        <!-- Tombol tambah Proker -->
        <a href="{{ route('admin.room.proker.create', $room->id) }}"
           class="bg-indigo-600 text-white px-5 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
            + Tambah Program Kerja
        </a>
    </div>

    <!-- Grid daftar Proker -->
    @if($prokers->isEmpty())
        <p class="text-gray-500">Belum ada proker.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @foreach($prokers as $proker)
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden border border-gray-100">
                    <!-- Header -->
                    <div class="p-5 bg-gray-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold leading-tight">{{ $proker->nama_proker }}</h3>
                                <span class="block text-xs opacity-90 mt-1">Tahun: {{ $proker->tahun }}</span>
                            </div>
                            <!-- Status badge kalau ada -->
                            @if(isset($proker->status))
                                <span class="ml-2 text-xs px-3 py-1 rounded-full font-bold
                                    {{ $proker->status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }} uppercase tracking-wide">
                                    {{ ucfirst($proker->status) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-5 space-y-3 text-sm text-gray-700 bg-gray-50">
                        <p class="text-gray-600">{{ $proker->deskripsi }}</p>

                        <!-- Tombol aksi -->
                        <div class="flex justify-end items-center space-x-3 pt-4 border-t border-gray-200">
                            <a href="{{ route('admin.room.proker.edit', [$room->id, $proker->id]) }}"
                               class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition focus:outline-none">
                                Update
                            </a>
                            <form action="{{ route('admin.room.proker.destroy', [$room->id, $proker->id]) }}" method="POST"
                                  onsubmit="return confirm('Yakin mau hapus proker ini?')" class="inline">
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
        </div>
    @endif
</div>
@endsection
