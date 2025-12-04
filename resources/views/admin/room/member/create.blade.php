@extends('layouts.admin')

@section('content')
<div class="mx-auto max-w-screen-md">

    <!-- Header -->
    <div class="flex flex-col justify-between gap-3 mb-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                ➕ Tambah Anggota Room: {{ $room->name }}
            </h2>
            <p class="text-sm text-gray-500">
                Buat akun anggota baru dan atur perannya untuk room ini.
            </p>
        </div>
        <a
            href="{{ route('admin.room.member.index', $room->id) }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50"
        >
            <i class="fas fa-arrow-left"></i>
            Kembali ke daftar anggota
        </a>
    </div>

    <!-- Card Form -->
    <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/60">
            <h3 class="text-lg font-semibold text-gray-900">Form Anggota Baru</h3>
            <p class="text-xs text-gray-500">
                Lengkapi data anggota dengan benar untuk keperluan sistem dan komunikasi.
            </p>
        </div>

        <form
            action="{{ route('admin.room.member.store', $room->id) }}"
            method="POST"
            onsubmit="return confirmAction(this, {
                text: 'Pastikan data yang diinput sudah benar.',
                confirmText: 'Ya, simpan',
            });"
            class="px-6 py-5 space-y-5"
        >
            @csrf

            <!-- Nama -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Nama
                </label>
                <input
                    type="text"
                    name="name"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama anggota"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Username
                </label>
                <input
                    type="text"
                    name="username"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username unik"
                    required
                >
                @error('username')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email anggota"
                    required
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Password
                </label>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="flex-1 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                        placeholder="Masukkan password (minimum 6 karakter)"
                        required
                    >
                    <button
                        type="button"
                        class="px-4 py-2 text-sm font-semibold text-gray-700 transition bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200"
                        onclick="generatePassword()"
                    >
                        🔄 Generate
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Minimal 6 karakter. Password yang digenerate akan otomatis diisi ke kolom konfirmasi.
                </p>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Konfirmasi Password
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    placeholder="Ulangi password"
                    required
                >
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Role
                </label>
                <select
                    name="role"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    required
                >
                    <option value="">-- Pilih Role --</option>
                    <option value="bendahara" {{ old('role') === 'bendahara' ? 'selected' : '' }}>
                        💰 Bendahara
                    </option>
                    <option value="sekretaris" {{ old('role') === 'sekretaris' ? 'selected' : '' }}>
                        📝 Sekretaris
                    </option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <a
                    href="{{ route('admin.room.member.index', $room->id) }}"
                    class="px-6 py-2 text-sm font-semibold text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200"
                >
                    Batal
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2 text-sm font-semibold text-white transition bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700"
                >
                    <i class="fas fa-check"></i>
                    Tambah
                </button>
            </div>
        </form>
    </div>
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
