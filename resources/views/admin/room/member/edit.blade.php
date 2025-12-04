@extends('layouts.admin')

@section('content')
<div class="max-w-screen-md px-4 mx-auto sm:px-6 lg:px-8">

    <!-- Header dengan gradient biru -->
    <div class="relative p-8 mb-8 overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 rounded-3xl">
        <div class="absolute top-0 right-0 w-64 h-64 transform translate-x-32 -translate-y-32 bg-white rounded-full opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 transform -translate-x-24 translate-y-24 bg-white rounded-full opacity-10"></div>
        
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center justify-center w-12 h-12 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white">Edit Anggota</h1>
                </div>
                <p class="text-blue-100">
                    Edit role untuk {{ $member->name }} di {{ $room->name }}
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
                    <h3 class="text-lg font-bold text-gray-900">Form Edit Role Anggota</h3>
                    <p class="text-xs text-gray-600">Ubah role/jabatan anggota di organisasi</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.room.member.update', [$room->id, $member->id]) }}" 
              method="POST" 
              onsubmit="return confirmAction(this, {
                  text: 'Role anggota akan diubah. Pastikan role yang dipilih sudah benar.',
                  confirmText: 'Ya, update role',
                  icon: 'question'
              });"
              class="px-6 py-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Info Member (Read Only) -->
            <div class="p-4 border-2 border-gray-100 rounded-xl bg-gradient-to-br from-gray-50 to-slate-50">
                <div class="flex items-center gap-4 mb-3">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500">
                        <span class="text-base font-bold text-white">
                            {{ strtoupper(substr($member->name, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $member->name }}</p>
                        <p class="text-xs text-gray-500">{{ '@' . $member->username }}  </p>

                    </div>
                </div>
                <div class="flex items-start gap-2 p-3 mt-3 border-2 border-blue-100 rounded-xl bg-blue-50">
                    <svg class="flex-shrink-0 w-4 h-4 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs leading-relaxed text-blue-700">
                        Role saat ini: <span class="font-bold">{{ ucfirst($memberPivot->pivot->role) }}</span>
                    </p>
                </div>
            </div>

            <!-- Role Selection -->
            <div>
                <label class="flex items-center gap-2 mb-3 text-sm font-bold text-gray-800">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    Pilih Role Baru
                </label>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @php
                        $roleConfigs = [
                            'bendahara' => [
                                'label' => 'Bendahara',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>',
                            ],
                            'sekretaris' => [
                                'label' => 'Sekretaris',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                            ],
                        ];
                    @endphp

                    @foreach($roleConfigs as $value => $config)
                        <label class="relative flex items-start gap-3 p-4 transition border-2 rounded-xl cursor-pointer border-gray-200 hover:border-blue-300 hover:bg-blue-50/30 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                            
                            <input type="radio" 
                                   name="role" 
                                   value="{{ $value }}" 
                                   {{ old('role', $memberPivot->pivot->role) === $value ? 'checked' : '' }}
                                   class="mt-0.5 w-5 h-5 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500"
                                   required>
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $config['icon'] !!}
                                    </svg>
                                    <span class="text-sm font-bold text-gray-900">
                                        {{ $config['label'] }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500">
                                    Role di organisasi {{ $room->name }}
                                </p>
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

            <!-- Warning Box -->
            <div class="flex items-start gap-3 p-4 border-2 border-yellow-200 rounded-xl bg-yellow-50">
                <svg class="flex-shrink-0 w-5 h-5 mt-0.5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <p class="text-sm font-bold text-yellow-900">Perhatian!</p>
                    <p class="mt-1 text-xs leading-relaxed text-yellow-700">
                        Mengubah role anggota akan mempengaruhi hak akses dan tugas mereka di organisasi. 
                        Pastikan perubahan ini sudah sesuai dengan keputusan organisasi.
                    </p>
                </div>
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
                        class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white transition shadow-lg bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl hover:shadow-xl hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Role
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
