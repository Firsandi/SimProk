@extends('layouts.user')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Kelola dokumen dan program kerja Anda dengan mudah')

@section('content')
<div class="mx-auto max-w-screen-2xl animate-fade-in-up">
    <!-- Welcome Banner with Gradient -->
    <div class="relative p-8 mb-8 overflow-hidden text-white shadow-xl bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-700 rounded-3xl group">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
        <div class="absolute top-0 right-0 w-64 h-64 transition-transform duration-700 transform translate-x-16 -translate-y-16 bg-white rounded-full opacity-10 group-hover:scale-125"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transition-transform duration-700 transform -translate-x-16 translate-y-16 bg-white rounded-full opacity-10 group-hover:scale-125"></div>
        
        <div class="relative z-10 flex flex-col items-start gap-6 md:flex-row md:items-center">
            <div class="flex items-center justify-center flex-shrink-0 w-20 h-20 shadow-2xl bg-white/20 backdrop-blur-md rounded-2xl ring-1 ring-white/30">
                <i class="text-4xl text-white fas fa-home drop-shadow-md"></i>
            </div>
            <div>
                <h3 class="mb-2 text-3xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-teal-100">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h3>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold tracking-wide text-teal-900 uppercase bg-teal-200 rounded-full">
                        {{ auth()->user()->role ?? 'User' }}
                    </span>
                    <span class="flex items-center text-sm font-medium text-teal-100">
                        <i class="mr-2 fas fa-calendar-day"></i>
                        {{ now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="absolute transform -translate-y-1/2 opacity-5 -right-4 top-1/2 pointer-events-none transition-transform duration-1000 group-hover:rotate-12 group-hover:scale-110">
            <i class="fas fa-rocket text-[16rem]"></i>
        </div>
    </div>

    <!-- Stats Cards with Animation -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3 stagger-1">
        <!-- Total Rooms -->
        <div class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-xl hover:-translate-y-1 group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-gradient-to-br from-teal-100 to-emerald-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 shadow-inner bg-gradient-to-br from-teal-500 to-emerald-600 rounded-xl">
                        <i class="text-xl text-white fas fa-building"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-bold text-teal-700 bg-teal-50 border border-teal-200 rounded-full shadow-sm">Room</span>
                </div>
                <h4 class="mb-1 text-4xl font-black text-gray-800">{{ $totalRooms }}</h4>
                <p class="text-sm font-medium text-gray-500">Room Tergabung</p>
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-xs font-bold text-teal-600 uppercase tracking-wider">
                        <i class="fas fa-chart-line"></i> Aktif Berpartisipasi
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Documents -->
        <div class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-xl hover:-translate-y-1 group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 shadow-inner bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl">
                        <i class="text-xl text-white fas fa-file-alt"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 rounded-full shadow-sm">Dokumen</span>
                </div>
                <h4 class="mb-1 text-4xl font-black text-gray-800">{{ $totalDocs }}</h4>
                <p class="text-sm font-medium text-gray-500">Dokumen Terupload</p>
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-xs font-bold text-blue-600 uppercase tracking-wider">
                        <i class="fas fa-check-circle"></i> Berhasil Diupload
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-xl hover:-translate-y-1 group">
            <div class="absolute top-0 right-0 w-32 h-32 transition-all duration-500 transform translate-x-16 -translate-y-16 bg-gradient-to-br from-amber-100 to-yellow-100 rounded-full opacity-50 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 shadow-inner bg-gradient-to-br from-amber-500 to-yellow-500 rounded-xl">
                        <i class="text-xl text-white fas fa-hourglass-half"></i>
                    </div>
                    <span class="px-3 py-1 text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200 rounded-full shadow-sm">Review</span>
                </div>
                <h4 class="mb-1 text-4xl font-black text-gray-800">{{ $pendingDocs }}</h4>
                <p class="text-sm font-medium text-gray-500">Menunggu Review</p>
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-xs font-bold text-amber-600 uppercase tracking-wider">
                        <i class="fas fa-sync-alt animate-spin-slow"></i> Sedang Diproses
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 gap-5 mb-8 md:grid-cols-2 lg:grid-cols-4 stagger-2">
        <a href="{{ route('user.myprokers') }}" class="flex items-center gap-4 p-5 transition-all duration-300 bg-white border border-transparent shadow-sm rounded-2xl hover:shadow-xl hover:border-teal-200 hover:-translate-y-1 group">
            <div class="flex items-center justify-center w-14 h-14 transition-transform duration-300 shadow-inner bg-gradient-to-br from-teal-500 to-emerald-600 rounded-xl group-hover:scale-110 group-hover:-rotate-3">
                <i class="text-2xl text-white fas fa-briefcase"></i>
            </div>
            <div>
                <p class="font-bold text-gray-900 group-hover:text-teal-600 transition-colors">My Prokers</p>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Kelola proker Anda</p>
            </div>
        </a>

        <a href="{{ route('user.documents') }}" class="flex items-center gap-4 p-5 transition-all duration-300 bg-white border border-transparent shadow-sm rounded-2xl hover:shadow-xl hover:border-blue-200 hover:-translate-y-1 group">
            <div class="flex items-center justify-center w-14 h-14 transition-transform duration-300 shadow-inner bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl group-hover:scale-110 group-hover:rotate-3">
                <i class="text-2xl text-white fas fa-file-invoice"></i>
            </div>
            <div>
                <p class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Dokumen</p>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Semua file dokumen</p>
            </div>
        </a>

        <a href="{{ route('user.notifications') }}" class="flex items-center gap-4 p-5 transition-all duration-300 bg-white border border-transparent shadow-sm rounded-2xl hover:shadow-xl hover:border-purple-200 hover:-translate-y-1 group">
            <div class="flex items-center justify-center w-14 h-14 transition-transform duration-300 shadow-inner bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl group-hover:scale-110 group-hover:-rotate-3">
                <i class="text-2xl text-white fas fa-bell"></i>
            </div>
            <div>
                <p class="font-bold text-gray-900 group-hover:text-purple-600 transition-colors">Notifikasi</p>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Pembaruan terkini</p>
            </div>
        </a>

        <a href="{{ route('user.profile') }}" class="flex items-center gap-4 p-5 transition-all duration-300 bg-white border border-transparent shadow-sm rounded-2xl hover:shadow-xl hover:border-slate-300 hover:-translate-y-1 group">
            <div class="flex items-center justify-center w-14 h-14 transition-transform duration-300 shadow-inner bg-gradient-to-br from-slate-600 to-slate-800 rounded-xl group-hover:scale-110 group-hover:rotate-3">
                <i class="text-2xl text-white fas fa-user-cog"></i>
            </div>
            <div>
                <p class="font-bold text-gray-900 group-hover:text-slate-700 transition-colors">Profil</p>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Pengaturan akun</p>
            </div>
        </a>
    </div>

    <!-- My Prokers Section -->
    <div class="mb-10 stagger-3">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-black text-gray-800">My Prokers</h3>
            <a href="{{ route('user.myprokers') }}" class="text-sm font-bold text-teal-600 hover:text-teal-800 transition-colors">Lihat Semua &rarr;</a>
        </div>

        @if($myProkers->count() > 0)
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($myProkers as $proker)
                    @php
                        $colors = [
                            ['border' => 'border-teal-500', 'bg' => 'bg-teal-50', 'text' => 'text-teal-600', 'gradient' => 'from-teal-500 to-emerald-600', 'shadow' => 'shadow-teal-500/20'],
                            ['border' => 'border-blue-500', 'bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'gradient' => 'from-blue-500 to-indigo-600', 'shadow' => 'shadow-blue-500/20'],
                            ['border' => 'border-purple-500', 'bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'gradient' => 'from-purple-500 to-fuchsia-600', 'shadow' => 'shadow-purple-500/20'],
                            ['border' => 'border-rose-500', 'bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'gradient' => 'from-rose-500 to-red-600', 'shadow' => 'shadow-rose-500/20']
                        ];
                        $color = $colors[$loop->index % 4];
                    @endphp
                    <div class="flex flex-col p-6 transition-all duration-300 bg-white border-l-4 shadow-md {{ $color['border'] }} rounded-2xl hover:shadow-2xl hover:-translate-y-1 group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1 min-w-0 pr-4">
                                <h4 class="mb-1.5 text-lg font-bold text-gray-900 group-hover:{{ $color['text'] }} transition-colors truncate" title="{{ $proker->name }}">{{ $proker->name }}</h4>
                                <p class="flex items-center gap-1.5 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-building"></i> {{ $proker->room->name }}
                                </p>
                            </div>
                            @if($proker->status === 'completed')
                                <span class="flex-shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 text-[10px] font-black text-emerald-700 uppercase tracking-wider border border-emerald-200 rounded-lg bg-emerald-50">
                                    <i class="fas fa-check-circle"></i> Selesai
                                </span>
                            @else
                                <span class="flex-shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 text-[10px] font-black text-amber-700 uppercase tracking-wider border border-amber-200 rounded-lg bg-amber-50">
                                    <i class="fas fa-spinner fa-spin"></i> Berjalan
                                </span>
                            @endif
                        </div>

                        <p class="mb-5 text-sm leading-relaxed text-gray-600 line-clamp-2">
                            {{ $proker->description ?? 'Tidak ada deskripsi' }}
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-5">
                            <div class="flex justify-between mb-2 text-xs font-bold uppercase tracking-wider">
                                <span class="text-gray-500">Progress</span>
                                <span class="{{ $color['text'] }}">{{ $proker->progress ?? 0 }}%</span>
                            </div>
                            <div class="w-full h-2.5 overflow-hidden bg-gray-100 rounded-full shadow-inner">
                                <div class="h-full bg-gradient-to-r {{ $color['gradient'] }} transition-all duration-1000 ease-out rounded-full shadow-[inset_0_-1px_2px_rgba(0,0,0,0.2)]" 
                                     style="width: {{ $proker->progress ?? 0 }}%"></div>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <!-- Meta Info -->
                            <div class="flex items-center gap-4 pb-4 mb-4 text-xs font-medium text-gray-500 border-b border-gray-100">
                                <span class="flex items-center gap-1.5">
                                    <i class="far fa-calendar-alt"></i> {{ $proker->period }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <i class="far fa-file-alt"></i> {{ $proker->documents->count() }} Dokumen
                                </span>
                            </div>

                            <a href="{{ route('user.documents.create', $proker->id) }}" 
                               class="flex items-center justify-center w-full px-4 py-3 text-sm font-bold text-white transition-all duration-300 shadow-md bg-gradient-to-r {{ $color['gradient'] }} rounded-xl hover:shadow-lg hover:{{ $color['shadow'] }} hover:-translate-y-0.5 focus:ring-4 focus:ring-opacity-50">
                                <i class="mr-2 fas fa-cloud-upload-alt"></i> Upload Dokumen
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-16 text-center transition-all duration-300 bg-white border-2 border-gray-200 border-dashed shadow-sm rounded-3xl hover:border-teal-300 hover:bg-teal-50/30">
                <div class="inline-flex items-center justify-center w-24 h-24 mb-5 shadow-inner bg-slate-50 rounded-2xl">
                    <i class="text-5xl text-slate-300 fas fa-folder-open"></i>
                </div>
                <h4 class="mb-2 text-xl font-bold text-gray-800">Belum Ada Proker</h4>
                <p class="text-sm font-medium text-gray-500">Anda belum tergabung dalam program kerja apapun saat ini.</p>
            </div>
        @endif
    </div>

    <!-- Recent Documents Section -->
    <div class="mb-8 stagger-4">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-black text-gray-800">Recent Documents</h3>
            <a href="{{ route('user.documents') }}" class="text-sm font-bold text-teal-600 hover:text-teal-800 transition-colors">Lihat Semua &rarr;</a>
        </div>

        @if($recentDocs->count() > 0)
            <div class="bg-white border border-gray-100 shadow-lg rounded-2xl overflow-hidden">
                <div class="divide-y divide-gray-100">
                    @foreach($recentDocs as $doc)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-5 transition-all duration-300 group hover:bg-slate-50 gap-4">
                            <div class="flex items-center flex-1 min-w-0 gap-4">
                                <div class="flex items-center justify-center flex-shrink-0 transition-transform duration-300 shadow-inner w-14 h-14 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 group-hover:scale-110">
                                    <i class="text-2xl text-slate-500 fas fa-file-pdf"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="mb-1 font-bold text-gray-900 truncate transition-colors group-hover:text-teal-600">{{ $doc->title }}</h4>
                                    <div class="flex flex-wrap items-center gap-3 text-xs font-medium text-gray-500">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 rounded-md">
                                            <i class="fas fa-tag"></i> {{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}
                                        </span>
                                        <span class="hidden sm:inline text-gray-300">•</span>
                                        <span class="inline-flex items-center gap-1.5">
                                            <i class="far fa-clock"></i> {{ $doc->submitted_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-4 justify-between sm:justify-end">
                                @if ($doc->latestStatus)
                                    @if($doc->latestStatus->status === 'approved')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-black text-emerald-700 uppercase tracking-wider border border-emerald-200 rounded-lg bg-emerald-50 whitespace-nowrap">
                                            <i class="fas fa-check-circle"></i> Approved
                                        </span>
                                    @elseif($doc->latestStatus->status === 'rejected')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-black text-rose-700 uppercase tracking-wider border border-rose-200 rounded-lg bg-rose-50 whitespace-nowrap">
                                            <i class="fas fa-times-circle"></i> Rejected
                                        </span>
                                    @elseif($doc->latestStatus->status === 'revision')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-black text-blue-700 uppercase tracking-wider border border-blue-200 rounded-lg bg-blue-50 whitespace-nowrap">
                                            <i class="fas fa-edit"></i> Revision
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-black text-amber-700 uppercase tracking-wider border border-amber-200 rounded-lg bg-amber-50 whitespace-nowrap">
                                            <i class="fas fa-spinner fa-spin"></i> {{ ucfirst($doc->latestStatus->status) }}
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-black text-amber-700 uppercase tracking-wider border border-amber-200 rounded-lg bg-amber-50 whitespace-nowrap">
                                        <i class="fas fa-spinner fa-spin"></i> Pending
                                    </span>
                                @endif
                                
                                <a href="{{ route('user.documents.show', $doc->id) }}" 
                                   class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-teal-700 transition-all duration-200 border border-teal-200 rounded-xl bg-teal-50 hover:bg-teal-500 hover:text-white hover:shadow-md hover:border-transparent">
                                    Lihat <i class="fas fa-chevron-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="p-16 text-center transition-all duration-300 bg-white border-2 border-gray-200 border-dashed shadow-sm rounded-3xl hover:border-teal-300 hover:bg-teal-50/30">
                <div class="inline-flex items-center justify-center w-24 h-24 mb-5 shadow-inner bg-slate-50 rounded-2xl">
                    <i class="text-5xl text-slate-300 fas fa-file-invoice"></i>
                </div>
                <h4 class="mb-2 text-xl font-bold text-gray-800">Belum Ada Dokumen</h4>
                <p class="mb-6 text-sm font-medium text-gray-500">Mulai upload dokumen untuk proker Anda agar tercatat dalam sistem.</p>
                <a href="{{ route('user.myprokers') }}" 
                   class="inline-flex items-center px-6 py-3 font-bold text-white transition-all duration-300 shadow-lg bg-gradient-to-r from-teal-500 to-emerald-600 rounded-xl hover:shadow-xl hover:scale-105 hover:from-teal-600 hover:to-emerald-700">
                    <i class="mr-2 fas fa-cloud-upload-alt"></i> Upload Dokumen Baru
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
