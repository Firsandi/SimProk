@extends('layouts.admin')

@section('content')
<div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
    <h2 class="mb-6 text-2xl font-bold text-gray-900">Tambah Anggota Room: {{ $room->name }}</h2>

    <form action="{{ route('admin.room.member.store', $room->id) }}" method="POST" class="space-y-5">
        @csrf

        <!-- NAMA -->
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Nama</label>
            <input 
                type="text" 
                name="name" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-200"
                value="{{ old('name') }}" 
                placeholder="Masukkan nama anggota"
                required>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- USERNAME -->
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Username</label>
            <input 
                type="text" 
                name="username" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-200"
                value="{{ old('username') }}" 
                placeholder="Masukkan username unik"
                required>
            @error('username')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- EMAIL -->
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
            <input 
                type="email" 
                name="email" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-200"
                value="{{ old('email') }}" 
                placeholder="Masukkan email anggota"
                required>
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Password</label>
            <div class="flex gap-2">
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-200"
                    placeholder="Masukkan password (minimum 6 karakter)"
                    required>
                <button 
                    type="button" 
                    class="px-4 py-2 font-semibold text-gray-700 bg-gray-300 rounded-lg hover:bg-gray-400"
                    onclick="generatePassword()">
                    🔄 Generate
                </button>
            </div>
            <p class="mt-1 text-xs text-gray-500">Minimal 6 karakter</p>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- PASSWORD CONFIRMATION -->
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Konfirmasi Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-200"
                placeholder="Ulangi password"
                required>
            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- ROLE -->
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-700">Role</label>
            <select 
                name="role" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-200"
                required>
                <option value="">-- Pilih Role --</option>
                <option value="bendahara" {{ old('role') === 'bendahara' ? 'selected' : '' }}>💰 Bendahara</option>
                <option value="sekretaris" {{ old('role') === 'sekretaris' ? 'selected' : '' }}>📝 Sekretaris</option>
            </select>
            @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- BUTTONS -->
        <div class="flex justify-end gap-3 pt-4">
            <a 
                href="{{ route('admin.room.member.index', $room->id) }}"
                class="px-6 py-2 font-semibold text-gray-700 transition bg-gray-200 rounded-lg hover:bg-gray-300">
                Batal
            </a>
            <button 
                type="submit"
                class="px-6 py-2 font-semibold text-white transition bg-teal-600 rounded-lg hover:bg-teal-700">
                ✓ Simpan
            </button>
        </div>
    </form>
</div>

<script>
function generatePassword() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%';
    let password = '';
    for (let i = 0; i < 12; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById('password').value = password;
    document.getElementById('password_confirmation').value = password;
}
</script>
@endsection
