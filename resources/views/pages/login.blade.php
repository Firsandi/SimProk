@extends('layouts.app')

@section('content')


    <!-- Main Container -->
    <div class="flex items-center justify-center px-4 pb-12">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl w-full">
            <div class="flex flex-col md:flex-row">
                <!-- Left Side - Illustration -->
                    <div class="w-full md:w-2/5 bg-gray-200 p-12 flex items-center justify-center">
                    <img 
                        src="{{ asset('images/logo.png') }}" 
                        alt="SimProdi Logo" 
                        class="w-100 h-110 object-contain mx-auto md:mx-0">
                    
                </div>

                <!-- Right Side - Form -->
                <div class="w-full md:w-3/5 p-8 md:p-12">
                    <!-- App Title -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">SimProk</h2>
                    </div>

                    <!-- Tabs -->
                    <div class="flex gap-2 mb-8">
                        <button 
                            type="button"
                            id="userTab"
                            onclick="switchTab('user')"
                            class="flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-gray-800 text-white">
                            As User
                        </button>
                        <button 
                            type="button"
                            id="adminTab"
                            onclick="switchTab('admin')"
                            class="flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-gray-200 text-gray-700 hover:bg-gray-300">
                            As Admin
                        </button>
                    </div>

                    <!-- Login Form -->
                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Hidden field for user type -->
                        <input type="hidden" name="user_type" id="userType" value="user">

                        <!-- Username/Email Field -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                                Username/email
                            </label>
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                value="{{ old('username') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('username') border-red-500 @enderror" 
                                placeholder="Masukkan username atau email"
                                required>
                            @error('username')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror" 
                                placeholder="Masukkan password"
                                required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Login Button -->
                        <div class="pt-2">
                            <button 
                                type="submit" 
                                class="w-full bg-gray-800 text-white py-3 px-4 rounded-lg font-medium hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 transition-colors duration-200">
                                Login
                            </button>
                        </div>
                    </form>

                    <!-- Optional: Forgot Password Link -->
                    <div class="mt-6 text-center">
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200">
                            Lupa password?
                        </a>
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

            if (type === 'user') {
                userTab.className = 'flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-gray-800 text-white';
                adminTab.className = 'flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-gray-200 text-gray-700 hover:bg-gray-300';
                userTypeInput.value = 'user';
            } else {
                userTab.className = 'flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-gray-200 text-gray-700 hover:bg-gray-300';
                adminTab.className = 'flex-1 py-2 px-4 rounded-lg font-medium transition-colors duration-200 bg-gray-800 text-white';
                userTypeInput.value = 'admin';
            }
        }
    </script>
@endsection
