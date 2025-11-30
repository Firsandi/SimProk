@extends('layouts.user')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900">My Program Kerja</h1>
        <p class="mt-1 text-gray-500">Daftar program kerja yang Anda ikuti</p>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Proker Cards Grid -->
    @if($myProkers->count() > 0)
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($myProkers as $proker)
                @php
                    $colors = ['border-blue-500', 'border-purple-500', 'border-pink-500', 'border-orange-500'];
                    $colorClass = $colors[$loop->index % count($colors)];
                @endphp
                
                <div class="p-6 transition bg-white border-l-4 shadow-sm rounded-xl hover:shadow-md {{ $colorClass }}">
                    
                    <!-- Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800">{{ $proker->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $proker->room->name }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full">
                            {{ ucfirst($proker->user_role ?? 'Anggota') }}
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="mb-4 text-sm text-gray-600">
                        {{ Str::limit($proker->description ?? '-', 80) }}
                    </p>

                    <!-- Meta Info -->
                    <div class="pb-4 mb-4 space-y-2 text-sm border-b">
                        <div class="flex items-center text-gray-600">
                            <i class="w-6 text-center text-teal-500 fas fa-calendar"></i>
                            <span>{{ $proker->period ?? date('Y') }}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="w-6 text-center text-teal-500 fas fa-file-alt"></i>
                            <span>{{ $proker->documents->count() }} Dokumen</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-5">
                        <div class="flex justify-between mb-1 text-xs">
                            <span class="text-gray-500">Progress</span>
                            <span class="font-bold text-gray-700">{{ $proker->progress ?? 0 }}%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div class="h-2 bg-teal-500 rounded-full" style="width: {{ $proker->progress ?? 0 }}%"></div>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            {{ $proker->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $proker->status === 'completed' ? '✅ Completed' : '⏳ Ongoing' }}
                        </span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <a href="{{ route('user.documents.create', $proker->id) }}" 
                           class="flex-1 px-4 py-2 text-sm font-semibold text-center text-white transition bg-teal-600 rounded-lg hover:bg-teal-700">
                            <i class="fas fa-upload"></i> Upload
                        </a>
                        <a href="{{ route('user.documents') }}" 
                           class="px-4 py-2 text-sm text-gray-600 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-12 text-center text-gray-500 bg-white border-2 border-gray-300 border-dashed rounded-xl">
            <i class="mb-3 text-4xl text-gray-300 fas fa-folder-open"></i>
            <p class="text-lg">Belum ada program kerja yang diikuti</p>
            <p class="mt-1 text-sm">Hubungi admin untuk ditambahkan ke room</p>
        </div>
    @endif

</div>
@endsection
