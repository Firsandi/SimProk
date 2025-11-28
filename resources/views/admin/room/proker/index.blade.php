@extends('layouts.admin')

@section('content')
<div class="max-w-6xl px-4 py-6 mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Program Kerja {{ $room->name }}</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.dashboard') }}"
               class="px-4 py-2 text-white transition bg-gray-600 rounded-lg shadow hover:bg-gray-800">
                ← Kembali ke Dashboard
            </a>

            <a href="{{ route('admin.room.proker.create', $room->id) }}"
               class="px-4 py-2 text-white transition bg-indigo-600 rounded-lg shadow hover:bg-indigo-700">
                + Tambah Program Kerja
            </a>

            <a href="{{ route('admin.room.member.index', $room->id) }}"
               class="px-4 py-2 text-white transition bg-green-600 rounded-lg shadow hover:bg-green-700">
                Lihat Anggota {{ $room->name }}
            </a>
        </div>
    </div>
    <!-- Grid daftar Proker -->
    @if($prokers->isEmpty())
        <p class="text-gray-500">Belum ada proker.</p>
    @else
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
            @foreach($prokers as $proker)
                <div class="overflow-hidden transition bg-white border border-gray-100 shadow rounded-2xl hover:shadow-xl">
                    <!-- Header -->
                    <div class="p-5 bg-gray-100">
                        <div class="flex items-start justify-between">
                            <div>
                                <a href="{{ route('admin.room.proker.show', [$room->id, $proker->id]) }}"
                                class="text-lg font-bold leading-tight text-grey-700 hover:underline">
                                    {{ $proker->nama_proker }}
                                </a>
                                <span class="block mt-1 text-xs opacity-90">Tahun: {{ $proker->tahun }}</span>
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
                        <div class="flex items-center justify-end pt-4 space-x-3 border-t border-gray-200">
                            <a href="{{ route('admin.room.proker.edit', [$room->id, $proker->id]) }}"
                               class="px-4 py-2 text-white transition bg-blue-700 rounded-lg hover:bg-indigo-700 focus:outline-none">
                                Update
                            </a>
                            <form action="{{ route('admin.room.proker.destroy', [$room->id, $proker->id]) }}" method="POST"
                                  onsubmit="return confirm('Yakin mau hapus proker ini?')" class="inline">
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
        </div>
    @endif
</div>
@endsection
