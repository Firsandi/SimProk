@extends('layouts.admin')

@section('content')
<div class="mx-auto max-w-screen-2xl">

    <!-- Header -->
    <div class="flex flex-col justify-between gap-3 mb-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                👥 Daftar Anggota Room: {{ $room->name }}
            </h2>
            <p class="text-sm text-gray-500">
                Kelola anggota, peran, dan akses untuk room ini.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.room.proker.index', ['room' => $room->id]) }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard Room
            </a>
            <a href="{{ route('admin.room.member.create', $room->id) }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700">
                <i class="fas fa-user-plus"></i>
                Tambah Anggota
            </a>
        </div>
    </div>

    <!-- Card Tabel Anggota -->
    <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="flex flex-col gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50/60 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-800">Anggota Room</p>
                <p class="text-xs text-gray-500">
                    Total {{ $members->count() }} anggota terdaftar.
                </p>
            </div>
            {{-- Placeholder search (opsional) --}}
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="text-xs fas fa-search"></i>
                </span>
                <input
                    type="text"
                    class="w-40 pl-8 pr-3 py-1.5 text-xs border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 sm:w-56"
                    placeholder="Cari nama / username">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Username</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($members as $member)
                        @php
                            $role = strtolower($member->pivot->role);
                            $roleColor = match($role) {
                                'admin', 'ketua' => 'bg-purple-100 text-purple-700',
                                'sekretaris' => 'bg-blue-100 text-blue-700',
                                'bendahara' => 'bg-emerald-100 text-emerald-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <tr class="transition hover:bg-gray-50/80">
                            <td class="px-6 py-3 font-medium text-gray-900">
                                {{ $member->name }}
                            </td>
                            <td class="px-6 py-3 text-gray-700">
                                {{ $member->username }}
                            </td>
                            <td class="px-6 py-3 text-gray-700">
                                {{ $member->email }}
                            </td>
                            <td class="px-6 py-3">
                                <span class="inline-flex px-2.5 py-1 text-[11px] font-semibold rounded-full {{ $roleColor }}">
                                    {{ ucfirst($member->pivot->role) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-sm text-center text-gray-500">
                                Belum ada anggota yang terdaftar untuk room ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
