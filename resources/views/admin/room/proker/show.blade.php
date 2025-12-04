@extends('layouts.admin')

@section('content')
<div class="max-w-screen-lg px-4 mx-auto sm:px-6 lg:px-8">

    <!-- Header dengan gradient biru -->
    <div class="relative p-8 mb-8 overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center w-12 h-12 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">Detail Program Kerja</h1>
                        <p class="text-sm text-blue-100 mt-0.5">{{ $room->name }}</p>
                    </div>
                </div>
                <p class="text-blue-100">
                    Informasi lengkap program kerja dan daftar anggota
                </p>
            </div>
            
            <a href="{{ route('admin.room.proker.index', $room->id) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-blue-600 transition bg-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Card detail proker -->
    <div class="overflow-hidden bg-white border-0 shadow-lg rounded-2xl">
        <!-- Header Card -->
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center flex-shrink-0 w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600">
                    <svg class="text-white w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold leading-tight text-gray-900">
                        {{ $proker->nama_proker }}
                    </h3>
                    <div class="flex items-center gap-2 mt-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Tahun Pelaksanaan: <span class="font-semibold text-gray-900">{{ $proker->tahun }}</span></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-6 space-y-8">
            <!-- Deskripsi -->
            <div class="p-5 border-2 border-gray-100 rounded-xl bg-gray-50/50">
                <div class="flex items-center gap-2 mb-3">
                    <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold tracking-wider text-gray-700 uppercase">
                        Deskripsi Program Kerja
                    </p>
                </div>
                <p class="text-sm leading-relaxed text-gray-700">
                    {{ $proker->deskripsi ?: 'Belum ada deskripsi untuk program kerja ini.' }}
                </p>
            </div>

            <!-- Anggota Proker -->
            <div class="pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center justify-center w-8 h-8 bg-indigo-100 rounded-lg">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-gray-900">Anggota Program Kerja</h4>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold text-blue-700 bg-blue-50 border-2 border-blue-200 rounded-lg">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        {{ $members->count() }} Anggota
                    </span>
                </div>

                @if($members->isEmpty())
                    <div class="flex flex-col items-center justify-center px-6 py-12 border-2 border-gray-200 border-dashed bg-gray-50 rounded-xl">
                        <div class="flex items-center justify-center w-16 h-16 mb-4 bg-gray-100 rounded-full">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <p class="mb-1 text-sm font-semibold text-gray-900">Belum ada anggota</p>
                        <p class="text-sm text-gray-500">Belum ada anggota yang terdaftar untuk program kerja ini</p>
                    </div>
                @else
                    <div class="grid gap-3">
                        @foreach ($members as $index => $member)
                            <div class="flex items-center gap-3 p-4 transition border-2 border-gray-100 rounded-xl hover:border-blue-200 hover:bg-blue-50/30">
                                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500">
                                    <span class="text-sm font-bold text-white">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ $member->name }}</p>
                                    <p class="text-xs text-gray-500">Anggota #{{ $index + 1 }}</p>
                                </div>
                                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-green-50">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
