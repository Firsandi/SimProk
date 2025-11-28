@extends('layouts.user')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Kelola dokumen dan program kerja Anda dengan mudah')

@section('content')
    <div class="relative p-8 mb-8 overflow-hidden text-white gradient-teal rounded-xl">
        <div class="relative z-10">
            <h3 class="mb-2 text-3xl font-bold">Selamat Datang, {{ auth()->user()->name }}! 👋</h3>
            <p class="text-teal-100">Kelola dokumen program kerja Anda dengan mudah</p>
        </div>
        <div class="absolute transform -translate-y-1/2 right-8 top-1/2 opacity-20">
            <i class="fas fa-folder-open text-9xl"></i>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        @include('components.user.Stats-card', ['label' => 'Total Proker', 'value' => $totalProkers, 'color' => 'teal', 'icon' => 'fas fa-briefcase'])
        @include('components.user.Stats-card', ['label' => 'Total Dokumen', 'value' => $totalDocs, 'color' => 'blue', 'icon' => 'fas fa-file-alt'])
        @include('components.user.Stats-card', ['label' => 'Pending Review', 'value' => $pending, 'color' => 'yellow', 'icon' => 'fas fa-hourglass-half'])
    </div>

    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">My Prokers</h3>
            <a href="{{ route('user.rooms') }}" class="text-sm font-medium text-teal-600 hover:text-teal-700">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            @foreach($myProkers as $proker)
                @include('components.user.Proker-card', ['proker' => $proker])
            @endforeach
        </div>
    </div>

    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Recent Documents</h3>
            <a href="{{ route('user.documents') }}" class="text-sm font-medium text-teal-600 hover:text-teal-700">Lihat Semua →</a>
        </div>
        <div class="bg-white divide-y shadow-sm rounded-xl">
            @foreach($recentDocs as $doc)
                @include('components.user.DocumentItem', ['document' => $doc])
            @endforeach
        </div>
    </div>
@endsection
