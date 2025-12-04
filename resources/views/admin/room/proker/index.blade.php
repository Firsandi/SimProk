@extends('layouts.admin')

@section('content')
<div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header & actions -->
    <div class="flex flex-col justify-between gap-3 mb-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                📋 Program Kerja {{ $room->name }}
            </h2>
            <p class="text-sm text-gray-500">
                Kelola daftar program kerja, detail, dan penanggung jawab untuk room ini.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a
                href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50"
            >
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>

            <a
                href="{{ route('admin.room.member.index', $room->id) }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700"
            >
                <i class="fas fa-users"></i>
                Lihat Anggota {{ $room->name }}
            </a>

            <a
                href="{{ route('admin.room.proker.create', $room->id) }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700"
            >
                <i class="fas fa-plus"></i>
                Tambah Program Kerja
            </a>
        </div>
    </div>

    @if($prokers->isEmpty())
        <div class="px-5 py-6 text-sm text-center text-gray-500 bg-white border border-dashed border-gray-200 rounded-2xl">
            Belum ada program kerja yang terdaftar untuk {{ $room->name }}.
        </div>
    @else
        <!-- Grid daftar Proker -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($prokers as $proker)
                @php
                    $status = $proker->status ?? null;
                    $statusClasses = match($status) {
                        'active' => 'bg-green-100 text-green-800',
                        'inactive' => 'bg-gray-100 text-gray-700',
                        default => 'bg-blue-100 text-blue-800',
                    };
                @endphp

                <div class="overflow-hidden transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-lg">
                    <!-- Header -->
                    <div class="px-5 py-4 bg-gray-50 border-b border-gray-100">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <a
                                    href="{{ route('admin.room.proker.show', [$room->id, $proker->id]) }}"
                                    class="text-lg font-semibold leading-tight text-gray-900 hover:text-indigo-600 hover:underline line-clamp-2"
                                >
                                    {{ $proker->nama_proker }}
                                </a>
                                <p class="mt-1 text-xs text-gray-500">
                                    Tahun: {{ $proker->tahun }}
                                </p>
                            </div>

                            @if($status)
                                <span class="px-3 py-1 text-[11px] font-semibold rounded-full uppercase tracking-wide {{ $statusClasses }}">
                                    {{ ucfirst($status) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="px-5 py-4 text-sm text-gray-700 bg-white">
                        <p class="text-gray-600 line-clamp-3">
                            {{ $proker->deskripsi ?: 'Belum ada deskripsi untuk program kerja ini.' }}
                        </p>

                        <!-- Tombol aksi -->
                        <div class="flex items-center justify-between pt-4 mt-4 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <a
                                    href="{{ route('admin.room.proker.edit', [$room->id, $proker->id]) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-blue-700 transition bg-blue-50 rounded-lg hover:bg-blue-100"
                                >
                                    <i class="fas fa-edit text-[11px]"></i>
                                    Update
                                </a>
                                <form
                                    action="{{ route('admin.room.proker.destroy', [$room->id, $proker->id]) }}"
                                    method="POST"
                                    onsubmit="return confirmAction(this, {
                                        text: 'Data yang dihapus tidak dapat dikembalikan.',
                                        confirmText: 'Ya, hapus',
                                        icon: 'error',
                                    });"
                                    class="inline"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-red-700 transition bg-red-50 rounded-lg hover:bg-red-100"
                                    >
                                        <i class="fas fa-trash text-[11px]"></i>
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
