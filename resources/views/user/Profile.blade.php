@extends('layouts.user')

@section('title', 'Profile')
@section('page-title', 'Profile')
@section('page-subtitle', 'Kelola informasi profil Anda')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="p-4 mb-6 border-l-4 border-green-500 rounded-r-lg bg-green-50">
            <p class="flex items-center font-semibold text-green-900">
                <i class="mr-2 fas fa-check-circle"></i>
                {{ session('success') }}
            </p>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 mb-6 border-l-4 border-red-500 rounded-r-lg bg-red-50">
            <p class="flex items-center mb-2 font-semibold text-red-900">
                <i class="mr-2 fas fa-exclamation-circle"></i>
                Terjadi kesalahan:
            </p>
            <ul class="text-sm text-red-800 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Profile Header Card -->
    <div class="relative p-8 mb-6 overflow-hidden text-white shadow-lg bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 rounded-2xl">
        <div class="relative z-10">
            <div class="flex items-center gap-6">
                <div class="flex items-center justify-center w-24 h-24 text-4xl font-bold text-teal-600 bg-white rounded-full shadow-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="mb-2 text-3xl font-bold">{{ auth()->user()->name }}</h2>
                    <div class="flex items-center gap-3 text-teal-50">
                        <span class="flex items-center gap-2 px-3 py-1 bg-white rounded-full bg-opacity-20 backdrop-blur-sm">
                            <i class="fas fa-user-tag"></i>
                            <span class="font-semibold">{{ ucfirst(auth()->user()->role) }}</span>
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-calendar"></i>
                            <span class="text-sm">Bergabung {{ auth()->user()->created_at->format('d M Y') }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute transform -translate-y-1/2 -right-8 top-1/2 opacity-10">
            <i class="fas fa-user-circle" style="font-size: 12rem;"></i>
        </div>
    </div>

    <!-- Profile Information Card -->
    <div class="p-6 mb-6 bg-white shadow-sm rounded-xl">
        <div class="flex items-center justify-between pb-4 mb-6 border-b">
            <h3 class="flex items-center gap-2 text-xl font-bold text-gray-800">
                <i class="text-teal-600 fas fa-id-card"></i>
                Informasi Profil
            </h3>
            <button onclick="openEditModal()" class="px-4 py-2 text-sm font-semibold text-white transition bg-teal-600 rounded-lg hover:bg-teal-700">
                <i class="mr-2 fas fa-edit"></i>
                Edit Profil
            </button>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-500">
                    <i class="mr-2 text-teal-500 fas fa-user"></i>
                    Nama Lengkap
                </label>
                <div class="px-4 py-3 border border-gray-200 rounded-lg bg-gray-50">
                    <p class="font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-500">
                    <i class="mr-2 text-teal-500 fas fa-at"></i>
                    Username
                </label>
                <div class="px-4 py-3 border border-gray-200 rounded-lg bg-gray-50">
                    <p class="font-semibold text-gray-900">{{ auth()->user()->username }}</p>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-500">
                    <i class="mr-2 text-teal-500 fas fa-envelope"></i>
                    Email
                </label>
                <div class="px-4 py-3 border border-gray-200 rounded-lg bg-gray-50">
                    <p class="font-semibold text-gray-900">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-500">
                    <i class="mr-2 text-teal-500 fas fa-user-tag"></i>
                    Role
                </label>
                <div class="px-4 py-3 border border-teal-200 rounded-lg bg-teal-50">
                    <p class="font-semibold text-teal-800 capitalize">{{ auth()->user()->role }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm rounded-xl group hover:shadow-md">
            <div class="absolute top-0 right-0 w-24 h-24 transition-all duration-300 transform translate-x-12 -translate-y-12 bg-teal-100 rounded-full opacity-30 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-center w-12 h-12 mb-3 bg-teal-100 rounded-lg">
                    <i class="text-2xl text-teal-600 fas fa-building"></i>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">
                    {{ auth()->user()->joinedRooms()->count() }}
                </h4>
                <p class="text-sm text-gray-600">Total Room</p>
            </div>
        </div>

        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm rounded-xl group hover:shadow-md">
            <div class="absolute top-0 right-0 w-24 h-24 transition-all duration-300 transform translate-x-12 -translate-y-12 bg-blue-100 rounded-full opacity-30 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-center w-12 h-12 mb-3 bg-blue-100 rounded-lg">
                    <i class="text-2xl text-blue-600 fas fa-file-alt"></i>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">
                    {{ \App\Models\Document::where('submitted_by', auth()->id())->count() }}
                </h4>
                <p class="text-sm text-gray-600">Dokumen Upload</p>
            </div>
        </div>

        <div class="relative p-6 overflow-hidden transition bg-white shadow-sm rounded-xl group hover:shadow-md">
            <div class="absolute top-0 right-0 w-24 h-24 transition-all duration-300 transform translate-x-12 -translate-y-12 bg-green-100 rounded-full opacity-30 group-hover:scale-150"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-center w-12 h-12 mb-3 bg-green-100 rounded-lg">
                    <i class="text-2xl text-green-600 fas fa-check-circle"></i>
                </div>
                <h4 class="mb-1 text-3xl font-bold text-gray-900">
                    {{ \App\Models\Document::where('submitted_by', auth()->id())
                       ->whereHas('latestStatus', fn($q) => $q->where('status', 'approved'))
                       ->count() }}
                </h4>
                <p class="text-sm text-gray-600">Dokumen Approved</p>
            </div>
        </div>
    </div>

    <!-- Action Button -->
    <div class="p-6 bg-white shadow-sm rounded-xl">
        <button onclick="openPasswordModal()" class="flex items-center justify-center w-full gap-3 px-6 py-4 transition bg-blue-50 rounded-xl hover:bg-blue-100 group">
            <div class="flex items-center justify-center w-12 h-12 transition bg-blue-100 rounded-lg group-hover:bg-blue-200">
                <i class="text-xl text-blue-600 fas fa-key"></i>
            </div>
            <div class="flex-1 text-left">
                <p class="font-semibold text-gray-800">Ubah Password</p>
                <p class="text-sm text-gray-600">Ganti kata sandi akun Anda</p>
            </div>
            <i class="text-gray-400 fas fa-chevron-right"></i>
        </button>
    </div>

</div>

<!-- Modal Edit Profile -->
<div id="editModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-md p-6 mx-4 bg-white shadow-2xl rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Edit Profil</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <i class="text-xl fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 text-sm font-semibold text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeEditModal()" 
                        class="flex-1 px-4 py-3 font-semibold text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-3 font-semibold text-white transition bg-teal-600 rounded-lg hover:bg-teal-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Change Password -->
<div id="passwordModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
    <div class="w-full max-w-md p-6 mx-4 bg-white shadow-2xl rounded-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Ubah Password</h3>
            <button onclick="closePasswordModal()" class="text-gray-400 hover:text-gray-600">
                <i class="text-xl fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('user.profile.change-password') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 text-sm font-semibold text-gray-700">Password Lama</label>
                <input type="password" name="current_password" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-semibold text-gray-700">Password Baru</label>
                <input type="password" name="new_password" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-semibold text-gray-700">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closePasswordModal()" 
                        class="flex-1 px-4 py-3 font-semibold text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-3 font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                    Ubah Password
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditModal() {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

function openPasswordModal() {
    document.getElementById('passwordModal').classList.remove('hidden');
    document.getElementById('passwordModal').classList.add('flex');
}

function closePasswordModal() {
    document.getElementById('passwordModal').classList.add('hidden');
    document.getElementById('passwordModal').classList.remove('flex');
}
</script>
@endpush
@endsection
