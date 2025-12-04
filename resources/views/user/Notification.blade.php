@extends('layouts.user')

@section('content')
<div class="max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="relative mb-6 overflow-hidden transition-all duration-300 transform border-l-4 shadow-xl animate-slideIn border-emerald-500 rounded-2xl bg-gradient-to-r from-emerald-50 to-teal-50 hover:shadow-2xl hover:scale-[1.01]">
            <div class="flex items-start gap-4 p-5">
                <div class="flex items-center justify-center flex-shrink-0 shadow-md w-11 h-11 rounded-xl bg-emerald-100">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-emerald-900">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="transition text-emerald-400 hover:text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Header dengan gradient HIJAU + Animasi -->
    <div class="relative p-8 mb-8 overflow-hidden transition-all duration-500 shadow-2xl bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 rounded-3xl hover:shadow-3xl hover:scale-[1.01]">
        <!-- Animated Background Circles -->
        <div class="absolute top-0 right-0 w-64 h-64 transition-transform duration-700 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10 hover:scale-110"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transition-transform duration-700 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10 hover:scale-110"></div>
        <div class="absolute w-32 h-32 transition-transform duration-700 transform bg-white rounded-full opacity-5 top-1/2 left-1/2 hover:scale-125"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex items-center justify-center transition-all duration-300 transform bg-white shadow-xl w-14 h-14 rounded-2xl bg-opacity-20 backdrop-blur-sm hover:scale-110 hover:rotate-6">
                        <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-white">Notifikasi</h1>
                        <p class="text-sm font-medium text-green-100 mt-0.5">
                            @if($unreadCount > 0)
                                <span class="inline-flex items-center gap-1">
                                    <span class="relative flex w-2 h-2">
                                        <span class="absolute inline-flex w-full h-full bg-green-200 rounded-full opacity-75 animate-ping"></span>
                                        <span class="relative inline-flex w-2 h-2 bg-green-300 rounded-full"></span>
                                    </span>
                                    {{ $unreadCount }} notifikasi belum dibaca
                                </span>
                            @else
                                ✅ Tidak ada notifikasi baru
                            @endif
                        </p>
                    </div>
                </div>
                <p class="text-green-100">
                    Semua notifikasi dan pembaruan terkait program kerja Anda
                </p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('user.dashboard') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-green-600 transition-all duration-300 transform bg-white shadow-lg rounded-xl hover:shadow-xl hover:scale-105 hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                
                @if($unreadCount > 0)
                    <form action="{{ route('user.notifications.readAll') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-emerald-600 to-teal-700 rounded-xl hover:shadow-xl hover:scale-105 hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Tandai Semua Dibaca
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="overflow-hidden transition-all duration-300 transform bg-white border-0 shadow-xl rounded-3xl hover:shadow-2xl">
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 shadow-sm rounded-xl bg-gradient-to-br from-green-500 to-emerald-600">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Daftar Notifikasi</p>
                        <p class="text-xs text-gray-600">Total {{ $notifications->total() }} notifikasi</p>
                    </div>
                </div>
                
                @if($notifications->total() > 0)
                    <div class="flex items-center gap-2 px-3 py-1.5 text-xs font-bold text-green-700 bg-green-100 border border-green-200 rounded-full">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        {{ $notifications->total() }}
                    </div>
                @endif
            </div>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse($notifications as $notification)
                @php
                    $isUnread = is_null($notification->read_at);
                    $data = $notification->data;
                    $type = $data['type'] ?? 'default';
                    $icon = $data['icon'] ?? 'bell';
                    $title = $data['title'] ?? 'Notifikasi';
                    $message = $data['message'] ?? '';
                    $actionText = $data['action_text'] ?? '👁️ Lihat';
                    
                    // ✅ Styling berdasarkan type
                    $configs = [
                        'welcome' => [
                            'iconBg' => $isUnread ? 'bg-gradient-to-br from-green-100 to-emerald-100 shadow-md' : 'bg-gray-100',
                            'iconColor' => $isUnread ? 'text-green-600' : 'text-gray-400',
                            'bgColor' => $isUnread ? 'bg-gradient-to-r from-green-50/60 to-emerald-50/40 border-l-4 border-green-400' : 'bg-white',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'buttonColor' => 'from-green-600 to-emerald-700',
                        ],
                        'added_to_proker' => [
                            'iconBg' => $isUnread ? 'bg-gradient-to-br from-blue-100 to-cyan-100 shadow-md' : 'bg-gray-100',
                            'iconColor' => $isUnread ? 'text-blue-600' : 'text-gray-400',
                            'bgColor' => $isUnread ? 'bg-gradient-to-r from-blue-50/60 to-cyan-50/40 border-l-4 border-blue-400' : 'bg-white',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>',
                            'buttonColor' => 'from-blue-600 to-cyan-700',
                        ],
                        'default' => [
                            'iconBg' => $isUnread ? 'bg-green-100 shadow-sm' : 'bg-gray-100',
                            'iconColor' => $isUnread ? 'text-green-600' : 'text-gray-400',
                            'bgColor' => $isUnread ? 'bg-green-50/30 border-l-4 border-green-300' : 'bg-white',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>',
                            'buttonColor' => 'from-green-600 to-emerald-700',
                        ],
                    ];
                    
                    $config = $configs[$type] ?? $configs['default'];
                @endphp
                
                <div class="transition-all duration-300 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-emerald-50/20 {{ $config['bgColor'] }}">
                    <div class="flex items-start gap-4 px-6 py-5">
                        <!-- Icon with Animation -->
                        <div class="flex items-center justify-center flex-shrink-0 transition-all duration-300 transform w-14 h-14 {{ $config['iconBg'] }} rounded-2xl hover:scale-110 hover:rotate-6">
                            <svg class="w-7 h-7 {{ $config['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $config['icon'] !!}
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <h3 class="text-base font-bold text-gray-900">{{ $title }}</h3>
                                        @if($isUnread)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold text-green-700 bg-green-100 border border-green-200 rounded-full shadow-sm animate-pulse">
                                                <span class="relative flex w-1.5 h-1.5">
                                                    <span class="absolute inline-flex w-full h-full bg-green-400 rounded-full opacity-75 animate-ping"></span>
                                                    <span class="relative inline-flex w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                                </span>
                                                Baru
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm leading-relaxed text-gray-600">{{ $message }}</p>
                                    
                                    <!-- ✅ BUTTON AKSI (untuk semua notif unread) -->
                                    @if($isUnread)
                                        <form action="{{ route('user.notifications.read', $notification->id) }}" method="POST" class="mt-4">
                                            @csrf
                                            <button type="submit"
                                                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r {{ $config['buttonColor'] }} rounded-xl hover:shadow-xl hover:scale-105 hover:-translate-y-0.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                                </svg>
                                                {{ $actionText }}
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <p class="flex items-center gap-1.5 mt-3 text-xs text-gray-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $notification->created_at->diffForHumans() }}
                                        <span class="text-gray-300">•</span>
                                        <span class="text-gray-500">{{ $notification->created_at->format('d M Y, H:i') }}</span>
                                    </p>
                                </div>

                                <!-- Delete Button -->
                                <form action="{{ route('user.notifications.destroy', $notification->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus notifikasi ini?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-red-600 transition-all duration-300 transform border-2 border-red-200 bg-red-50 rounded-xl hover:bg-red-100 hover:border-red-300 hover:scale-105 hover:-translate-y-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-16">
                    <div class="flex flex-col items-center justify-center">
                        <div class="flex items-center justify-center w-20 h-20 mb-4 transition-transform duration-300 transform bg-gray-100 rounded-full hover:scale-110">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <p class="mb-1 text-base font-bold text-gray-900">Tidak ada notifikasi</p>
                        <p class="text-sm text-gray-500">Belum ada notifikasi untuk ditampilkan</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gradient-to-r from-gray-50 to-slate-50">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>

<style>
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slideIn {
    animation: slideIn 0.5s ease-out;
}
</style>
@endsection
