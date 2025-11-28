@extends('layouts.admin')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="fixed top-0 left-0 z-50 justify-between hidden h-screen text-white bg-gray-900 md:flex md:flex-col md:w-64">
        <div>
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-xl font-bold">SimProk</h1>
                <p class="text-sm text-gray-400">Admin Dashboard</p>
            </div>
            <a href="{{ route('admin.timeline') }}"
               class="menu-item px-4 py-2 flex items-center gap-2 hover:bg-gray-800 rounded {{ request()->routeIs('admin.timeline') ? 'bg-gray-800' : '' }}">
                <i class="fas fa-clock"></i> Timeline
            </a>
            <a href="{{ route('admin.room.index') }}"
               class="menu-item px-4 py-2 flex items-center gap-2 hover:bg-gray-800 rounded {{ request()->routeIs('admin.ukm.index') ? 'bg-gray-800' : '' }}">
                <i class="fas fa-plus-circle"></i> Kelola UKM/ORMAWA
            </a>
        </div>
        <!-- Logout Button -->
        <div class="p-6 border-t border-gray-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="flex items-center justify-center w-full gap-2 px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 min-h-screen bg-gray-100 md:ml-64">
        <header class="flex items-center justify-between px-6 py-4 bg-white shadow">
            <div>
                <h2 class="text-2xl font-bold">Dashboard</h2>
                <p class="text-sm text-gray-600">Kelola semua UKM dan Ormawa</p>
            </div>
            <div class="text-sm text-gray-500">
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </header>

        <div class="p-6 mx-auto max-w-screen-2xl">
            <!-- Welcome Banner -->
            <div class="p-8 mb-8 text-white shadow bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl">
                <h3 class="mb-2 text-3xl font-bold">Selamat Datang, {{ auth()->user()->name }} 👋</h3>
                <p class="text-blue-100">Kelola dokumen dan aktivitas UKM/Ormawa dengan mudah</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-6 bg-white border-l-4 border-blue-500 shadow rounded-xl">
                    <p class="text-sm text-gray-600">Total UKM/Ormawa</p>
                    <p class="text-3xl font-bold">{{ $stats['total_ukm'] }}</p>
                </div>
                <div class="p-6 bg-white border-l-4 border-green-500 shadow rounded-xl">
                    <p class="text-sm text-gray-600">Disetujui</p>
                    <p class="text-3xl font-bold">{{ $stats['approved'] }}</p>
                </div>
                <div class="p-6 bg-white border-l-4 border-yellow-500 shadow rounded-xl">
                    <p class="text-sm text-gray-600">Menunggu Review</p>
                    <p class="text-3xl font-bold">{{ $stats['pending'] }}</p>
                </div>
                <div class="p-6 bg-white border-l-4 border-red-500 shadow rounded-xl">
                    <p class="text-sm text-gray-600">Revisi/Ditolak</p>
                    <p class="text-3xl font-bold">{{ $stats['rejected'] }}</p>
                </div>
            </div>

            <!-- Room Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($rooms as $room)
                    <div class="overflow-hidden transition bg-white shadow rounded-xl hover:shadow-lg">
                        <div class="p-6 bg-{{ $room['color'] }}-600 relative">
                            <span class="absolute top-4 right-4 text-xs px-3 py-1 rounded-full font-semibold
                                {{ $room['status'] === 'active' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                {{ ucfirst($room['status']) }}
                            </span>
                            <h4 class="text-lg font-bold text-white">{{ $room['name'] }}</h4>
                            <p class="text-sm text-blue-100">Periode: {{ $room['period'] }}</p>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-600">Disetujui: <strong>{{ $room['approved'] }}</strong></p>
                            <p class="text-sm text-gray-600">Menunggu: <strong>{{ $room['pending'] }}</strong></p>
                            <p class="text-sm text-gray-600">Ditolak: <strong>{{ $room['rejected'] }}</strong></p>
                            <div class="mt-4 text-xs px-3 py-2 rounded-lg font-medium
                                {{ $room['has_notification'] ? 'bg-blue-50 text-blue-700' : 'bg-gray-100 text-gray-600' }}">
                                <i class="mr-1 fas fa-info-circle"></i>{{ $room['notification'] }}
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.room.proker.index', $room['id']) }}"
                                   class="inline-block px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">
                                   Lihat Program Kerja
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
