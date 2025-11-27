@extends('layouts.user')

@section('title', 'Rooms')
@section('page-title', 'Rooms')
@section('page-subtitle', 'Daftar organisasi dan program kerja Anda')

@section('content')
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($rooms as $room)
            @include('components.user.Room-card', ['room' => $room])
        @endforeach
    </div>
@endsection
