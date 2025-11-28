@extends('layouts.admin')

@section('content')
<div class="max-w-3xl p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-2 text-2xl font-bold text-indigo-700">{{ $proker->nama_proker }}</h2>
    <p class="mb-4 text-sm text-gray-600">Tahun: {{ $proker->tahun }}</p>
    <p class="mb-6">{{ $proker->deskripsi }}</p>

    <h3 class="mb-2 text-lg font-semibold">Anggota Proker</h3>
    <ul class="space-y-2">
        @forelse ($members as $member)
            <li>{{ $member->name }}</li>
        @empty
            <li class="text-gray-500">Belum ada anggota.</li>
        @endforelse
    </ul>

    <div class="mt-6">
        <a href="{{ route('admin.room.proker.index', $room->id) }}"
           class="text-indigo-600 hover:underline">← Kembali ke daftar proker</a>
    </div>
</div>
@endsection
