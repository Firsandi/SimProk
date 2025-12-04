@extends('layouts.admin')

@section('content')
<div class="mx-auto max-w-screen-lg px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header & back -->
    <div class="flex flex-col justify-between gap-3 mb-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                📋 Detail Program Kerja
            </h2>
            <p class="text-sm text-gray-500">
                Informasi lengkap program kerja untuk {{ $room->name }}.
            </p>
        </div>
        <a
            href="{{ route('admin.room.proker.index', $room->id) }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50"
        >
            <i class="fas fa-arrow-left"></i>
            Kembali ke daftar proker
        </a>
    </div>

    <!-- Card detail proker -->
    <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/60">
            <h3 class="text-xl font-semibold text-gray-900">
                {{ $proker->nama_proker }}
            </h3>
            <p class="text-xs text-gray-500">
                Tahun pelaksanaan: {{ $proker->tahun }}
            </p>
        </div>

        <div class="px-6 py-5 space-y-6">
            <!-- Deskripsi -->
            <div>
                <p class="text-xs font-semibold tracking-wide text-gray-500 uppercase">
                    Deskripsi Program Kerja
                </p>
                <p class="mt-1 text-sm text-gray-700">
                    {{ $proker->deskripsi ?: 'Belum ada deskripsi untuk program kerja ini.' }}
                </p>
            </div>

            <!-- Anggota Proker -->
            <div class="pt-4 border-t border-gray-100">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-semibold text-gray-800">
                        Anggota Proker
                    </p>
                    <span class="text-xs text-gray-500">
                        Total: {{ $members->count() }}
                    </span>
                </div>

                @if($members->isEmpty())
                    <p class="text-sm text-gray-500">
                        Belum ada anggota yang terdaftar untuk program kerja ini.
                    </p>
                @else
                    <ul class="divide-y divide-gray-100 rounded-lg border border-gray-100 bg-gray-50/60">
                        @foreach ($members as $member)
                            <li class="px-4 py-2 text-sm text-gray-800">
                                {{ $member->name }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
