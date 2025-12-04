@extends('layouts.admin')

@section('content')
<div class="px-4 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">

    <!-- Header dengan gradient biru -->
    <div class="relative p-8 mb-8 overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center w-12 h-12 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">Program Kerja</h1>
                        <p class="text-sm text-blue-100 mt-0.5">{{ $room->name }}</p>
                    </div>
                </div>
                <p class="text-blue-100">
                    Kelola daftar program kerja, detail, dan penanggung jawab
                </p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-blue-600 transition bg-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.room.member.index', $room->id) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white transition bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Anggota
                </a>

                <a href="{{ route('admin.room.proker.create', $room->id) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Proker
                </a>
            </div>
        </div>
    </div>

    @if($prokers->isEmpty())
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center px-6 py-16 bg-white border-2 border-gray-200 border-dashed rounded-2xl">
            <div class="flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gray-50">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <p class="mb-2 text-lg font-semibold text-gray-900">Belum Ada Program Kerja</p>
            <p class="mb-4 text-sm text-gray-500">Belum ada program kerja yang terdaftar untuk {{ $room->name }}</p>
            <a href="{{ route('admin.room.proker.create', $room->id) }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white transition bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Program Kerja
            </a>
        </div>
    @else
        <!-- Grid daftar Proker -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($prokers as $proker)
                @php
                    $status = $proker->status ?? null;
                    $statusConfig = match($status) {
                        'active' => [
                            'class' => 'bg-green-50 text-green-700 border-green-200',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                        ],
                        'inactive' => [
                            'class' => 'bg-gray-50 text-gray-700 border-gray-200',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>'
                        ],
                        default => [
                            'class' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                        ]
                    };
                @endphp

                <div class="overflow-hidden transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-xl hover:border-blue-200 group">
                    <!-- Header dengan gradient -->
                    <div class="relative px-6 py-5 overflow-hidden text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700">
                        <div class="absolute top-0 right-0 w-32 h-32 transform translate-x-16 -translate-y-16 bg-white rounded-full opacity-10"></div>
                        
                        <div class="relative flex items-start justify-between gap-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="flex items-center justify-center w-10 h-10 bg-white rounded-lg bg-opacity-20 backdrop-blur-sm">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                        </svg>
                                    </div>
                                    <a href="{{ route('admin.room.proker.show', [$room->id, $proker->id]) }}"
                                       class="text-lg font-bold leading-tight text-white hover:underline line-clamp-2">
                                        {{ $proker->nama_proker }}
                                    </a>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-blue-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Tahun: {{ $proker->tahun }}</span>
                                </div>
                            </div>

                            @if($status)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-lg border-2 {{ $statusConfig['class'] }} shadow-sm">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $statusConfig['icon'] !!}
                                    </svg>
                                    {{ ucfirst($status) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="px-6 py-5">
                        <div class="mb-4">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                                <span class="text-xs font-bold tracking-wide text-gray-500 uppercase">Deskripsi</span>
                            </div>
                            <p class="text-sm leading-relaxed text-gray-600 line-clamp-3">
                                {{ $proker->deskripsi ?: 'Belum ada deskripsi untuk program kerja ini.' }}
                            </p>
                        </div>

                        <!-- Tombol aksi -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.room.proker.edit', [$room->id, $proker->id]) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-blue-700 transition border-2 border-blue-100 rounded-lg bg-blue-50 hover:bg-blue-100 hover:border-blue-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.room.proker.destroy', [$room->id, $proker->id]) }}"
                                      method="POST"
                                      onsubmit="return confirmAction(this, {
                                          text: 'Data yang dihapus tidak dapat dikembalikan.',
                                          confirmText: 'Ya, hapus',
                                          icon: 'error',
                                      });"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-red-700 transition border-2 border-red-100 rounded-lg bg-red-50 hover:bg-red-100 hover:border-red-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
