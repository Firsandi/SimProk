@extends('layouts.user')

@section('title', 'Notifications')
@section('page-title', 'Notifications')
@section('page-subtitle', 'Pemberitahuan terbaru untuk Anda')

@section('content')
    <div class="bg-white shadow-sm rounded-xl">
        @if($notifications->count() > 0)
            <div class="divide-y">
                @foreach($notifications as $notif)
                    <div class="p-4 hover:bg-gray-50 transition {{ is_null($notif->read_at) ? 'bg-blue-50' : '' }}">
                        <div class="flex items-start gap-3">
                            <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-teal-100 rounded-full">
                                <i class="text-teal-600 fas fa-bell"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">{{ $notif->title }}</h4>
                                <p class="mt-1 text-sm text-gray-600">{{ $notif->message }}</p>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="text-xs text-gray-400">{{ $notif->created_at->diffForHumans() }}</span>
                                    @if($notif->action_url)
                                        <a href="{{ $notif->action_url }}" class="text-sm font-medium text-teal-600 hover:text-teal-700">
                                            Lihat Detail →
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center text-gray-500">
                <i class="mb-3 text-4xl opacity-50 fas fa-bell-slash"></i>
                <p class="text-lg">Belum ada notifikasi</p>
                <p class="mt-1 text-sm">Notifikasi akan muncul ketika ada update dokumen atau proker</p>
            </div>
        @endif
    </div>
@endsection
