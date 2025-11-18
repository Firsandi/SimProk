@extends('layouts.user')

@section('title', 'Profile')
@section('page-title', 'Profile Saya')
@section('page-subtitle', 'Kelola informasi profil Anda')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md p-8">
        
        <!-- Avatar & Name -->
        <div class="text-center mb-8">
            <div class="w-24 h-24 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-4xl mx-auto mb-4">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
            <p class="text-gray-600 mt-1">{{ auth()->user()->email }}</p>
        </div>

        <!-- Profile Info -->
        <div class="space-y-6">
            <div class="border-t pt-6">
                <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                <p class="mt-2 text-lg text-gray-800">{{ auth()->user()->name }}</p>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Username</label>
                <p class="mt-2 text-lg text-gray-800">{{ auth()->user()->username }}</p>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Email</label>
                <p class="mt-2 text-lg text-gray-800">{{ auth()->user()->email }}</p>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Role</label>
                <p class="mt-2 text-lg text-gray-800">
                    @if(auth()->user()->role == 'sekretaris')
                        Sekretaris
                    @elseif(auth()->user()->role == 'bendahara')
                        Bendahara
                    @elseif(auth()->user()->role == 'anggota')
                        Anggota
                    @else
                        {{ ucfirst(auth()->user()->role) }}
                    @endif
                </p>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Status Akun</label>
                <p class="mt-2">
                    @if(auth()->user()->is_active)
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>Aktif
                        </span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold">
                            <i class="fas fa-times-circle mr-1"></i>Tidak Aktif
                        </span>
                    @endif
                </p>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
                <p class="text-sm text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    Untuk mengubah informasi profil, hubungi administrator.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
