@extends('layouts.user')

@section('title', 'Dashboard User')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Kelola dokumen dan program kerja Anda dengan mudah')

@section('content')

<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-blue-100 text-lg">
                @if(auth()->user()->role == 'sekretaris')
                    Anda berperan sebagai Sekretaris. Kelola proposal dan LPJ program kerja.
                @elseif(auth()->user()->role == 'bendahara')
                    Anda berperan sebagai Bendahara. Kelola dokumen keuangan dan SPJ.
                @else
                    Anda adalah anggota aktif. Ikuti perkembangan program kerja.
                @endif
            </p>
        </div>
        <div class="hidden md:block text-blue-200">
            <i class="fas fa-chart-pie text-6xl opacity-50"></i>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Stats cards here... sama seperti sebelumnya -->
</div>

<!-- My Rooms -->
<div class="mb-8">
    <!-- Rooms grid here... sama seperti sebelumnya -->
</div>

@endsection

@push('scripts')
<script>
    console.log('Dashboard loaded!');
</script>
@endpush
