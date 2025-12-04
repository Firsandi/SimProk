@extends('layouts.admin')

@section('content')
<div class="max-w-screen-md px-4 mx-auto sm:px-6 lg:px-8">

    <!-- Header dengan gradient biru -->
    <div class="relative p-8 mb-8 overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 rounded-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center w-12 h-12 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white">Tambah Anggota</h1>
                </div>
                <p class="text-blue-100">
                    Tambahkan anggota baru ke {{ $room->name }}
                </p>
            </div>
            
            <a href="{{ route('admin.room.member.index', $room->id) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-blue-600 transition bg-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Info Alert untuk Role yang sudah penuh -->
    @if(isset($existingRoles['bendahara']) && $existingRoles['bendahara'] >= 1)
    <div class="p-4 mb-6 border-l-4 border-yellow-400 rounded-lg shadow-sm bg-yellow-50">
        <div class="flex items-center gap-3">
            <svg class="flex-shrink-0 w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <p class="text-sm font-semibold text-yellow-800">
                Role <span class="font-bold">Bendahara</span> sudah terisi penuh (1/1). Anda tidak dapat menambahkan Bendahara lagi.
            </p>
        </div>
    </div>
    @endif

    @if(isset($existingRoles['sekretaris']) && $existingRoles['sekretaris'] >= 1)
    <div class="p-4 mb-6 border-l-4 border-yellow-400 rounded-lg shadow-sm bg-yellow-50">
        <div class="flex items-center gap-3">
            <svg class="flex-shrink-0 w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <p class="text-sm font-semibold text-yellow-800">
                Role <span class="font-bold">Sekretaris</span> sudah terisi penuh (1/1). Anda tidak dapat menambahkan Sekretaris lagi.
            </p>
        </div>
    </div>
    @endif

    <!-- Card Form -->
    <div class="overflow-hidden bg-white border-0 shadow-lg rounded-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Form Anggota Baru</h3>
                    <p class="text-xs text-gray-600">Lengkapi data anggota dan tentukan rolenya</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.room.member.store', $room->id) }}" method="POST" 
              onsubmit="return confirmAction(this, {
                  text: 'Pastikan data yang diinput sudah benar.',
                  confirmText: 'Ya, tambahkan',
              });"
              class="px-6 py-6 space-y-6">
            @csrf

            <!-- Nama -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Nama Lengkap
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300 @error('name') border-red-300 @enderror"
                       placeholder="Contoh: Ahmad Fauzi" required>
                @error('name')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Username
                </label>
                <input type="text" name="username" value="{{ old('username') }}"
                       class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300 @error('username') border-red-300 @enderror"
                       placeholder="Contoh: ahmadfauzi" required>
                @error('username')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300 @error('email') border-red-300 @enderror"
                       placeholder="Contoh: ahmad.fauzi@example.com" required>
                @error('email')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Password
                </label>
                <input type="password" name="password"
                       class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300 @error('password') border-red-300 @enderror"
                       placeholder="Minimal 6 karakter" required>
                @error('password')
                    <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label class="flex items-center gap-2 mb-2 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-3 text-sm transition border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 hover:border-gray-300"
                       placeholder="Ketik ulang password" required>
            </div>

            <!-- Role Selection -->
            <div>
                <label class="flex items-center gap-2 mb-3 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    Pilih Role / Jabatan
                </label>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @php
                        $roleConfigs = [
                            'bendahara' => [
                                'label' => 'Bendahara',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>',
                                'limit' => 1
                            ],
                            'sekretaris' => [
                                'label' => 'Sekretaris',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                                'limit' => 1
                            ],
                        ];
                    @endphp

                    @foreach($roleConfigs as $value => $config)
                        @php
                            $isFull = isset($existingRoles[$value]) && $existingRoles[$value] >= $config['limit'];
                            $isOldSelected = old('role') === $value;
                        @endphp

                        <label class="relative flex items-start gap-3 p-4 transition border-2 rounded-xl cursor-pointer
                            {{ $isFull ? 'bg-gray-50 border-gray-200 opacity-60 cursor-not-allowed' : 'border-gray-200 hover:border-blue-300 hover:bg-blue-50/30 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50' }}">
                            
                            <input type="radio" 
                                   name="role" 
                                   value="{{ $value }}" 
                                   {{ $isFull ? 'disabled' : '' }}
                                   {{ $isOldSelected ? 'checked' : '' }}
                                   class="mt-0.5 w-5 h-5 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500 {{ $isFull ? 'cursor-not-allowed' : '' }}"
                                   required>
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <svg class="w-5 h-5 {{ $isFull ? 'text-gray-400' : 'text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $config['icon'] !!}
                                    </svg>
                                    <span class="text-sm font-bold {{ $isFull ? 'text-gray-500' : 'text-gray-900' }}">
                                        {{ $config['label'] }}
                                    </span>
                                </div>
                                
                                @if($isFull)
                                    <div class="flex items-center gap-1 mt-2">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-bold text-red-700 bg-red-50 border border-red-200 rounded-md">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Sudah Terisi ({{ $existingRoles[$value] }}/{{ $config['limit'] }})
                                        </span>
                                    </div>
                                @else
                                    <p class="mt-1 text-xs text-gray-500">
                                        Tersedia: {{ $config['limit'] - ($existingRoles[$value] ?? 0) }}/{{ $config['limit'] }} slot
                                    </p>
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>

                @error('role')
                    <p class="flex items-center gap-1 mt-3 text-sm text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.room.member.index', $room->id) }}"
                   class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-gray-700 transition bg-gray-100 rounded-xl hover:bg-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white transition shadow-lg bg-gradient-to-r from-green-600 to-green-700 rounded-xl hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Tambah Anggota
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
