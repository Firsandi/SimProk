@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-2 text-indigo-700">{{ $proker->nama_proker }}</h2>
    <p class="text-sm text-gray-600 mb-4">Tahun: {{ $proker->tahun }}</p>
    <p class="mb-6">{{ $proker->deskripsi }}</p>

    <h3 class="text-lg font-semibold mb-2">Anggota Proker</h3>
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
