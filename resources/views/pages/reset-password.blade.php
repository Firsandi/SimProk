@extends('layouts.auth')

@section('title', 'Reset Password - SimProk')
@section('body-class', 'bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 min-h-screen flex items-center justify-center p-4')

@section('content')
<!-- Floating Background Elements -->
<div class="fixed bottom-0 left-0 -mb-48 -ml-48 bg-white rounded-full w-96 h-96 opacity-5 animate-pulse"></div>
<div class="fixed top-0 right-0 -mt-40 -mr-40 bg-white rounded-full w-80 h-80 opacity-5 animate-pulse" style="animation-delay: 1s;"></div>

<div class="relative z-10 w-full max-w-md">
    <!-- Header -->
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 mb-4 transition-transform bg-white rounded-full shadow-lg hover:scale-105">
            <i class="text-4xl text-blue-600 fas fa-lock"></i>
        </div>
        <h1 class="mb-2 text-3xl font-bold text-white">Reset Password</h1>
        <p class="text-blue-100">Buat password baru untuk akun Anda</p>
    </div>

    <!-- Card -->
    <div class="p-8 bg-white shadow-2xl rounded-2xl">
        
        <!-- Error Messages -->
        @if($errors->any())
            <div class="p-4 mb-6 border-l-4 border-red-500 rounded-r-lg bg-red-50 animate-in slide-in-from-top-2">
                <p class="flex items-center mb-2 font-semibold text-red-800">
                    <i class="mr-2 fas fa-exclamation-circle"></i>
                    Error:
                </p>
                <ul class="text-sm text-red-700 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email (readonly) -->
            <div>
                <label class="block mb-2 text-xs font-bold tracking-wider text-gray-900 uppercase">
                    Email Address
                </label>
                <div class="relative">
                    <input type="email" name="email" value="{{ request()->email ?? old('email') }}" 
                           class="w-full px-4 py-3 font-medium text-gray-900 border-2 border-gray-200 cursor-not-allowed pl-11 bg-gray-50 rounded-xl" 
                           readonly>
                    <i class="absolute text-gray-400 -translate-y-1/2 fas fa-envelope left-4 top-1/2"></i>
                </div>
            </div>

            <!-- Password Baru -->
            <div>
                <label class="block mb-2 text-xs font-bold tracking-wider text-gray-900 uppercase">
                    Password Baru
                </label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                           class="w-full px-4 py-3 pr-12 font-medium text-gray-900 placeholder-gray-500 transition-all duration-300 border-2 border-gray-200 pl-11 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-gradient-to-b focus:from-white focus:to-blue-50 focus:shadow-lg focus:shadow-blue-500/20"
                           placeholder="Minimal 8 karakter" required>
                    <i class="absolute text-gray-400 -translate-y-1/2 fas fa-key left-4 top-1/2"></i>
                    <button type="button" class="absolute p-1 text-gray-400 -translate-y-1/2 right-4 top-1/2 hover:text-blue-500" onclick="togglePassword('password', 'passwordIcon')">
                        <i class="text-lg fas fa-eye" id="passwordIcon"></i>
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500">Password harus minimal 8 karakter</p>
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label class="block mb-2 text-xs font-bold tracking-wider text-gray-900 uppercase">
                    Konfirmasi Password
                </label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full px-4 py-3 pr-12 font-medium text-gray-900 placeholder-gray-500 transition-all duration-300 border-2 border-gray-200 pl-11 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-gradient-to-b focus:from-white focus:to-blue-50 focus:shadow-lg focus:shadow-blue-500/20"
                           placeholder="Ketik ulang password" required>
                    <i class="absolute text-gray-400 -translate-y-1/2 fas fa-check-circle left-4 top-1/2"></i>
                    <button type="button" class="absolute p-1 text-gray-400 -translate-y-1/2 right-4 top-1/2 hover:text-blue-500" onclick="togglePassword('password_confirmation', 'confirmIcon')">
                        <i class="text-lg fas fa-eye" id="confirmIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="resetBtn"
                    class="w-full py-3 rounded-xl font-bold text-white bg-gradient-to-r from-blue-500 to-blue-400 hover:from-blue-600 hover:to-blue-500 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 shadow-lg hover:shadow-xl hover:shadow-blue-500/30 flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                <i class="fas fa-save"></i>
                <span id="btnText">Reset Password</span>
            </button>
        </form>
    </div>

    <!-- Security Info -->
    <div class="p-4 mt-6 text-sm text-white bg-white bg-opacity-20 backdrop-blur-sm rounded-xl">
        <p class="flex items-start gap-2">
            <i class="flex-shrink-0 mt-1 fas fa-shield-alt"></i>
            <span>Password baru harus minimal 8 karakter dan berbeda dari password lama.</span>
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Loading state on submit
    document.querySelector('form').addEventListener('submit', function() {
        const btn = document.getElementById('resetBtn');
        const btnText = document.getElementById('btnText');
        btn.disabled = true;
        btnText.innerHTML = '<span class="inline-block w-4 h-4 border-2 border-white rounded-full border-t-transparent animate-spin"></span> Loading...';
    });
</script>
@endpush
