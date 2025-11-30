@extends('layouts.auth')

@section('title', 'Lupa Password - SimProk')
@section('body-class', 'bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 min-h-screen flex items-center justify-center p-4')

@section('content')
<!-- Floating Background Elements -->
<div class="fixed bottom-0 left-0 -mb-48 -ml-48 bg-white rounded-full w-96 h-96 opacity-5 animate-pulse"></div>
<div class="fixed top-0 right-0 -mt-40 -mr-40 bg-white rounded-full w-80 h-80 opacity-5 animate-pulse" style="animation-delay: 1s;"></div>

<div class="relative z-10 w-full max-w-md">
    <!-- Header -->
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 mb-4 transition-transform bg-white rounded-full shadow-lg hover:scale-105">
            <i class="text-4xl text-teal-600 fas fa-key"></i>
        </div>
        <h1 class="mb-2 text-3xl font-bold text-white">Lupa Password?</h1>
        <p class="text-teal-100">Masukkan email Anda untuk reset password</p>
    </div>

    <!-- Card -->
    <div class="p-8 bg-white shadow-2xl rounded-2xl">
        
        <!-- Success Message -->
        @if(session('success'))
            <div class="p-4 mb-6 border-l-4 border-green-500 rounded-r-lg bg-green-50 animate-in slide-in-from-top-2">
                <p class="flex items-center font-semibold text-green-800">
                    <i class="mr-2 fas fa-check-circle"></i>
                    {{ session('success') }}
                </p>
            </div>
        @endif

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
        <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-2 text-xs font-bold tracking-wider text-gray-900 uppercase">
                    Email Address
                </label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="w-full px-4 py-3 font-medium text-gray-900 placeholder-gray-500 transition-all duration-300 border-2 border-gray-200 pl-11 rounded-xl focus:outline-none focus:border-teal-500 focus:bg-gradient-to-b focus:from-white focus:to-teal-50 focus:shadow-lg focus:shadow-teal-500/20"
                           placeholder="your.email@example.com" required autofocus>
                    <i class="absolute text-gray-400 -translate-y-1/2 fas fa-envelope left-4 top-1/2"></i>
                </div>
            </div>

            <button type="submit" 
                    class="w-full py-3 rounded-xl font-bold text-white bg-gradient-to-r from-teal-500 to-teal-400 hover:from-teal-600 hover:to-teal-500 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 shadow-lg hover:shadow-xl hover:shadow-teal-500/30 flex items-center justify-center gap-2">
                <i class="fas fa-paper-plane"></i>
                Kirim Link Reset Password
            </button>
        </form>

        <!-- Back to Login -->
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-700 font-semibold text-sm flex items-center justify-center gap-1.5 hover:gap-2 transition-all">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Login
            </a>
        </div>
    </div>

    <!-- Info Box -->
    <div class="p-4 mt-6 text-sm text-white bg-white bg-opacity-20 backdrop-blur-sm rounded-xl">
        <p class="flex items-start gap-2">
            <i class="flex-shrink-0 mt-1 fas fa-info-circle"></i>
            <span>Link reset password akan dikirim ke email Anda. Periksa inbox atau folder spam.</span>
        </p>
    </div>
</div>
@endsection
