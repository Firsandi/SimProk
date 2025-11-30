@extends('layouts.user')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Kelola dokumen dan program kerja Anda dengan mudah')

@section('content')
    <!-- Welcome Banner with Gradient -->
    <div class="relative p-8 mb-8 overflow-hidden text-white shadow-lg bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 rounded-2xl">
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 backdrop-blur-sm rounded-xl">
                    <span class="text-3xl">👋</span>
                </div>
                <div>
                    <h3 class="text-3xl font-bold">Selamat Datang, {{ auth()->user()->name }}!</h3>
                    <p class="text-teal-100">{{ ucfirst(auth()->user()->role) }} • {{ now()->format('l, d F Y') }}</p>
                </div>
            </div>
            <p class="text-lg text-teal-50">Kelola dokumen program kerja Anda dengan mudah dan efisien</p>
        </div>
        <div class="absolute transform -translate-y-1/2 -right-8 top-1/2 opacity-10">
            <i class="fas fa-rocket" style="font-size: 15rem;"></i>
        </div>
    </div>

    <!-- Stats Cards with Animation -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <!-- Total Rooms -->
        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm group rounded-xl hover:shadow-lg">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-300 transform translate-x-16 -translate-y-16 bg-teal-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-teal-100 rounded-lg">
                        <i class="text-2xl text-teal-600 fas fa-building"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-teal-800 bg-teal-100 rounded-full">Room</span>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">{{ $totalRooms }}</h4>
                <p class="text-sm text-gray-600">Total Room Tergabung</p>
            </div>
        </div>

        <!-- Total Documents -->
        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm group rounded-xl hover:shadow-lg">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-300 transform translate-x-16 -translate-y-16 bg-blue-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg">
                        <i class="text-2xl text-blue-600 fas fa-file-alt"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">Dokumen</span>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">{{ $totalDocs }}</h4>
                <p class="text-sm text-gray-600">Dokumen Terupload</p>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm group rounded-xl hover:shadow-lg">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-300 transform translate-x-16 -translate-y-16 bg-yellow-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-lg">
                        <i class="text-2xl text-yellow-600 fas fa-hourglass-half"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Review</span>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">{{ $pendingDocs }}</h4>
                <p class="text-sm text-gray-600">Menunggu Review</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2 lg:grid-cols-4">
        <a href="{{ route('user.myprokers') }}" class="flex items-center gap-4 p-4 transition bg-white shadow-sm group rounded-xl hover:shadow-md hover:bg-teal-50">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition bg-teal-100 rounded-lg group-hover:bg-teal-200">
                <i class="text-xl text-teal-600 fas fa-briefcase"></i>
            </div>
            <div>
                <p class="font-semibold text-gray-900">My Prokers</p>
                <p class="text-xs text-gray-500">Lihat semua proker</p>
            </div>
        </a>

        <a href="{{ route('user.documents') }}" class="flex items-center gap-4 p-4 transition bg-white shadow-sm group rounded-xl hover:shadow-md hover:bg-blue-50">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition bg-blue-100 rounded-lg group-hover:bg-blue-200">
                <i class="text-xl text-blue-600 fas fa-folder"></i>
            </div>
            <div>
                <p class="font-semibold text-gray-900">Dokumen Saya</p>
                <p class="text-xs text-gray-500">Kelola dokumen</p>
            </div>
        </a>

        <a href="{{ route('user.notifications') }}" class="flex items-center gap-4 p-4 transition bg-white shadow-sm group rounded-xl hover:shadow-md hover:bg-purple-50">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition bg-purple-100 rounded-lg group-hover:bg-purple-200">
                <i class="text-xl text-purple-600 fas fa-bell"></i>
            </div>
            <div>
                <p class="font-semibold text-gray-900">Notifikasi</p>
                <p class="text-xs text-gray-500">Lihat pemberitahuan</p>
            </div>
        </a>

        <a href="{{ route('user.profile') }}" class="flex items-center gap-4 p-4 transition bg-white shadow-sm group rounded-xl hover:shadow-md hover:bg-gray-50">
            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition bg-gray-100 rounded-lg group-hover:bg-gray-200">
                <i class="text-xl text-gray-600 fas fa-user"></i>
            </div>
            <div>
                <p class="font-semibold text-gray-900">Profil</p>
                <p class="text-xs text-gray-500">Lihat profil saya</p>
            </div>
        </a>
    </div>

    <!-- My Prokers Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">📋 My Prokers</h3>
                <p class="text-sm text-gray-500">Program kerja yang sedang Anda ikuti</p>
            </div>
            <a href="{{ route('user.myprokers') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-teal-600 transition rounded-lg bg-teal-50 hover:bg-teal-100">
                Lihat Semua
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        @if($myProkers->count() > 0)
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($myProkers as $proker)
                    @php
                        $borderColors = ['border-teal-500', 'border-blue-500', 'border-purple-500', 'border-pink-500'];
                        $bgColors = ['bg-teal-50', 'bg-blue-50', 'bg-purple-50', 'bg-pink-50'];
                        $colorIndex = $loop->index % 4;
                    @endphp
                    <div class="p-5 transition bg-white border-l-4 shadow-sm {{ $borderColors[$colorIndex] }} rounded-xl hover:shadow-lg group">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="mb-1 text-lg font-bold text-gray-800 group-hover:text-teal-600">{{ $proker->name }}</h4>
                                <p class="text-sm text-gray-500">
                                    <i class="mr-1 fas fa-building"></i>{{ $proker->room->name }}
                                </p>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $proker->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $proker->status === 'completed' ? '✅ Selesai' : '⏳ Berjalan' }}
                            </span>
                        </div>

                        <p class="mb-4 text-sm text-gray-600 line-clamp-2">
                            {{ $proker->description ?? 'Tidak ada deskripsi' }}
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="flex justify-between mb-2 text-xs">
                                <span class="text-gray-600">Progress</span>
                                <span class="font-bold text-gray-800">{{ $proker->progress ?? 0 }}%</span>
                            </div>
                            <div class="w-full h-2 overflow-hidden bg-gray-200 rounded-full">
                                <div class="h-full {{ $bgColors[$colorIndex] }} transition-all duration-500" 
                                     style="width: {{ $proker->progress ?? 0 }}%"></div>
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 mb-4 text-xs text-gray-500">
                            <span><i class="mr-1 fas fa-calendar"></i>{{ $proker->period }}</span>
                            <span><i class="mr-1 fas fa-file"></i>{{ $proker->documents->count() }} Dokumen</span>
                        </div>

                        <a href="{{ route('user.documents.create', $proker->id) }}" 
                           class="flex items-center justify-center w-full px-4 py-2 text-sm font-semibold text-white transition bg-teal-600 rounded-lg hover:bg-teal-700">
                            <i class="mr-2 fas fa-upload"></i>
                            Upload Dokumen
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center text-gray-500 bg-white border-2 border-gray-200 border-dashed rounded-xl">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-4 bg-gray-100 rounded-full">
                    <i class="text-4xl text-gray-400 fas fa-briefcase"></i>
                </div>
                <h4 class="mb-2 text-lg font-semibold text-gray-700">Belum Ada Proker</h4>
                <p class="text-sm text-gray-500">Anda belum tergabung dalam program kerja apapun</p>
            </div>
        @endif
    </div>

    <!-- Recent Documents Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">📄 Recent Documents</h3>
                <p class="text-sm text-gray-500">Dokumen yang baru saja Anda upload</p>
            </div>
            <a href="{{ route('user.documents') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-teal-600 transition rounded-lg bg-teal-50 hover:bg-teal-100">
                Lihat Semua
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        @if($recentDocs->count() > 0)
            <div class="bg-white divide-y shadow-sm rounded-xl">
                @foreach($recentDocs as $doc)
                    <div class="flex items-center justify-between p-5 transition group hover:bg-gray-50">
                        <div class="flex items-center flex-1 gap-4">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 transition bg-teal-100 rounded-lg group-hover:bg-teal-200">
                                <i class="text-xl text-teal-600 fas fa-file-pdf"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-800 truncate group-hover:text-teal-600">{{ $doc->title }}</h4>
                                <p class="text-sm text-gray-500">
                                    <span class="inline-flex items-center">
                                        <i class="mr-1 text-xs fas fa-tag"></i>
                                        {{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span class="inline-flex items-center">
                                        <i class="mr-1 text-xs fas fa-clock"></i>
                                        {{ $doc->submitted_at->diffForHumans() }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @if ($doc->latestStatus)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full whitespace-nowrap
                                    {{ $doc->latestStatus->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                       ($doc->latestStatus->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                       ($doc->latestStatus->status === 'revision' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                    {{ $doc->latestStatus->getStatusIcon() }} {{ ucfirst($doc->latestStatus->status) }}
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full whitespace-nowrap">
                                    ⏳ Pending
                                </span>
                            @endif
                            <a href="{{ route('user.documents.show', $doc->id) }}" 
                               class="flex items-center gap-1 px-3 py-2 text-sm font-semibold text-teal-600 transition rounded-lg bg-teal-50 hover:bg-teal-100">
                                Lihat
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center text-gray-500 bg-white border-2 border-gray-200 border-dashed rounded-xl">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-4 bg-gray-100 rounded-full">
                    <i class="text-4xl text-gray-400 fas fa-file-alt"></i>
                </div>
                <h4 class="mb-2 text-lg font-semibold text-gray-700">Belum Ada Dokumen</h4>
                <p class="mb-4 text-sm text-gray-500">Mulai upload dokumen untuk proker Anda</p>
                <a href="{{ route('user.myprokers') }}" 
                   class="inline-flex items-center px-5 py-2 font-semibold text-white transition bg-teal-600 rounded-lg hover:bg-teal-700">
                    <i class="mr-2 fas fa-plus"></i>
                    Upload Dokumen
                </a>
            </div>
        @endif
    </div>
@endsection
