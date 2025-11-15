@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div class="sidebar w-64 bg-gray-900 text-white min-h-screen flex flex-col justify-between">
        <div>
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-xl font-bold">SimProk</h1>
                <p class="text-gray-400 text-sm">Admin Dashboard</p>
            </div>
            <nav class="space-y-2 mt-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="menu-item px-4 py-2 flex items-center gap-2 hover:bg-gray-800 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('admin.timeline') }}" 
                   class="menu-item px-4 py-2 flex items-center gap-2 hover:bg-gray-800 rounded {{ request()->routeIs('admin.timeline') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-clock"></i> Timeline
                </a>
            </nav>
        </div>
        <!-- Logout Button -->
        <div class="p-6 border-t border-gray-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 bg-gray-100 min-h-screen">
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold">Dashboard</h2>
                <p class="text-gray-600 text-sm">Kelola semua UKM dan Ormawa</p>
            </div>
            <div class="text-sm text-gray-500">
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </header>

        <div class="p-6">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl p-8 mb-8 text-white shadow">
                <h3 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }} 👋</h3>
                <p class="text-blue-100">Kelola dokumen dan aktivitas UKM/Ormawa dengan mudah</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow border-l-4 border-blue-500">
                    <p class="text-sm text-gray-600">Total UKM/Ormawa</p>
                    <p class="text-3xl font-bold">{{ $stats['total_ukm'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow border-l-4 border-green-500">
                    <p class="text-sm text-gray-600">Disetujui</p>
                    <p class="text-3xl font-bold">{{ $stats['approved'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-600">Menunggu Review</p>
                    <p class="text-3xl font-bold">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow border-l-4 border-red-500">
                    <p class="text-sm text-gray-600">Revisi/Ditolak</p>
                    <p class="text-3xl font-bold">{{ $stats['rejected'] }}</p>
                </div>
            </div>

            <!-- Room Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rooms as $room)
                    <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition">
                        <div class="p-6 bg-{{ $room['color'] }}-600 relative">
                            <span class="absolute top-4 right-4 text-xs px-3 py-1 rounded-full font-semibold 
                                {{ $room['status'] === 'active' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                {{ ucfirst($room['status']) }}
                            </span>
                            <h4 class="text-white font-bold text-lg">{{ $room['name'] }}</h4>
                            <p class="text-sm text-blue-100">Periode: {{ $room['period'] }}</p>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-600">Disetujui: <strong>{{ $room['approved'] }}</strong></p>
                            <p class="text-sm text-gray-600">Menunggu: <strong>{{ $room['pending'] }}</strong></p>
                            <p class="text-sm text-gray-600">Ditolak: <strong>{{ $room['rejected'] }}</strong></p>
                            <div class="mt-4 text-xs px-3 py-2 rounded-lg font-medium 
                                {{ $room['has_notification'] ? 'bg-blue-50 text-blue-700' : 'bg-gray-100 text-gray-600' }}">
                                <i class="fas fa-info-circle mr-1"></i>{{ $room['notification'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
