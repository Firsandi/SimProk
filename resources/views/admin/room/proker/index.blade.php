@extends('layouts.app')

@section('content')
<div class="px-6 py-6">
    <h2 class="text-2xl font-bold mb-2">Proker - {{ $room->name }}</h2>
    <p class="text-gray-600 mb-6">Periode: {{ $room->period }}</p>

    <a href="{{ route('admin.room.proker.create', $room->id) }}" 
       class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 mb-6">
        + Tambah Program Kerja
    </a>

    @if($prokers->isEmpty())
        <p class="text-gray-500">Belum ada proker.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($prokers as $proker)
                <div class="bg-white rounded shadow p-4">
                    <h4 class="font-bold text-lg">{{ $proker->nama_proker }}</h4>
                    <p class="text-sm text-gray-600">{{ $proker->deskripsi }}</p>
                    <p class="text-xs text-gray-400 mt-2">Tahun: {{ $proker->tahun }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
