@extends('layouts.user')

@section('title', 'Notifications')
@section('page-title', 'Notifications')
@section('page-subtitle', 'Pemberitahuan terbaru untuk Anda')

@section('content')
    <div class="bg-white rounded-xl shadow-sm divide-y">
        @foreach($notifications as $notif)
            <div class="p-4">
                <h4 class="font-semibold text-gray-800">{{ $notif->title }}</h4>
                <p class="text-sm text-gray-600">{{ $notif->message }}</p>
                @if($notif->action_url)
                    <a href="{{ $notif->action_url }}" class="text-teal-600 text-sm">Lihat Detail</a>
                @endif
            </div>
        @endforeach
    </div>
@endsection
