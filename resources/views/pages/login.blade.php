@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl w-full">
        <div class="flex flex-col md:flex-row">
            
            <!-- Left Side - Logo -->
            <div class="w-full md:w-2/5 bg-gray-200 p-12 flex items-center justify-center">
                <div class="text-center">
                    <div class="w-32 h-32 bg-gray-800 rounded-full mx-auto flex items-center justify-center mb-4">
                        <span class="text-white text-4xl font-bold">SP</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">SimProk</h2>
                    <p class="text-gray-600 mt-2">Fasilkom UNEJ</p>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full md:w-3/5 p-8 md:p-12">
                
                <!-- App Title -->
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">SimProk</h2>
                    <p class="text-gray-600 text-sm mt-1">Sistem Manajemen Program Kerja</p>
                </div>

                <!-- TABS -->
                <div class="flex gap-2 mb-8">
                    <button 
                        type="button"
                        id="userTab"
                        onclick="switchTab('user')"
                        class="flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 tab-btn"
                        data-tab="user">
                        <i class="fas fa-users mr-2"></i>As User
                    </button>
                    <button 
                        type="button"
                        id="adminTab"
                        onclick="switchTab('admin')"
                        class="flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 tab-btn"
                        data-tab="admin">
                        <i class="fas fa-shield-alt mr-2"></i>As Admin
                    </button>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Hidden field for user type -->
                    <input type="hidden" name="user_type" id="userType" value="user">

                    <!-- Username/Email Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            Username/Email
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="{{ old('username') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('username') border-red-500 @enderror" 
                            placeholder="Masukkan username atau email"
                            required>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror" 
                            placeholder="Masukkan password"
                            required>
                    </div>

                    <!-- Login Button -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            id="loginBtn"
                            class="w-full bg-gray-800 text-white py-3 px-4 rounded-lg font-medium hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 transition-colors duration-200">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Forgot Password Link -->
                <div class="mt-6 text-center">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200">
                        Lupa password?
                    </a>
                </div>

                <!-- Info Messages -->
                <div id="infoMessage" class="mt-6 p-3 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg text-sm hidden">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(type) {
        const userTab = document.getElementById('userTab');
        const adminTab = document.getElementById('adminTab');
        const userTypeInput = document.getElementById('userType');
        const loginBtn = document.getElementById('loginBtn');
        const infoMessage = document.getElementById('infoMessage');

        if (type === 'user') {
            // User Tab Style
            userTab.className = 'flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-blue-600 text-white';
            adminTab.className = 'flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-gray-200 text-gray-700 hover:bg-gray-300';
            userTypeInput.value = 'user';
            loginBtn.textContent = '🔓 Login as User';
            infoMessage.textContent = '✓ Login dengan akun User/Anggota';
            infoMessage.classList.remove('hidden');
        } else {
            // Admin Tab Style
            userTab.className = 'flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-gray-200 text-gray-700 hover:bg-gray-300';
            adminTab.className = 'flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-red-600 text-white';
            userTypeInput.value = 'admin';
            loginBtn.textContent = '🔐 Login as Admin';
            infoMessage.textContent = '✓ Login dengan akun Admin';
            infoMessage.classList.remove('hidden');
        }
    }

    // Set default tab on page load
    window.addEventListener('DOMContentLoaded', function() {
        switchTab('user');
    });
</script>
@endsection
