@extends('layouts.user')

@section('title', $room->name)
@section('page-title', $room->name)
@section('page-subtitle', 'Detail room dan program kerja')

@section('content')
    <div class="mb-6">
        <a href="{{ route('user.rooms') }}" class="font-medium text-teal-600 hover:text-teal-700">
            <i class="mr-2 fas fa-arrow-left"></i> Kembali ke Rooms
        </a>
    </div>

    <div class="p-6 mb-6 bg-white shadow-sm rounded-xl">
        <h3 class="mb-4 text-xl font-bold text-gray-800">Program Kerja</h3>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            @foreach($room->prokers as $proker)
                @include('components.user.Proker-card', ['proker' => $proker])
            @endforeach
        </div>
    </div>
@endsection
