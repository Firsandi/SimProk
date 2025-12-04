@extends('layouts.admin')

@section('content')
<div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8">

    <!-- Header & actions -->
    <div class="flex flex-col justify-between gap-3 mb-8 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">UKM / Ormawa</h2>
            <p class="text-sm text-gray-500">
                Kelola room, periode kepengurusan, dan status aktif/nonaktif.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
            <a href="{{ route('admin.room.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition bg-green-600 rounded-lg shadow-sm hover:bg-green-700">
                <i class="fas fa-plus"></i>
                Tambah UKM / Ormawa
            </a>
        </div>
    </div>

    <!-- Grid daftar UKM/Ormawa -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse($rooms as $room)
            @php
                $isActive = $room['status'] === 'active';
                $statusClasses = $isActive
                    ? 'bg-green-100 text-green-800'
                    : 'bg-gray-100 text-gray-700';
            @endphp

            <div class="overflow-hidden transition bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-lg">
                <!-- Header -->
                <div class="px-5 py-4 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h3 class="text-lg font-bold leading-tight line-clamp-2">
                                {{ $room['name'] }}
                            </h3>
                            <p class="mt-1 text-xs text-slate-200/80">
                                Periode: {{ $room['period'] }}
                            </p>
                        </div>
                        <span class="px-3 py-1 text-[11px] font-semibold rounded-full uppercase tracking-wide {{ $statusClasses }} bg-opacity-90">
                            {{ ucfirst($room['status']) }}
                        </span>
                    </div>
                </div>

                <!-- Tombol aksi -->
                <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100 bg-gray-50/60">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.room.edit', $room['id']) }}"
                           class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-blue-700 transition bg-blue-50 rounded-lg hover:bg-blue-100">
                            <i class="fas fa-edit text-[11px]"></i>
                            Update
                        </a>
                        <form
                            action="{{ route('admin.room.destroy', $room['id']) }}"
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
        @empty
            <div class="col-span-full">
                <div class="px-5 py-6 text-sm text-center text-gray-500 bg-white border border-dashed border-gray-200 rounded-2xl">
                    Belum ada UKM / Ormawa yang terdaftar.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
