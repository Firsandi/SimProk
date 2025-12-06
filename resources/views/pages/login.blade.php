@extends('layouts.auth')

@section('title', 'Login - SimProk')
@section('body-class', 'bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 min-h-screen flex items-center justify-center transition-all duration-500')

@section('content')
<!-- Floating Background Elements -->
<div class="fixed bottom-0 left-0 -mb-48 -ml-48 bg-white rounded-full w-96 h-96 opacity-5 animate-pulse"></div>
<div class="fixed top-0 right-0 -mt-40 -mr-40 bg-white rounded-full w-80 h-80 opacity-5 animate-pulse" style="animation-delay: 1s;"></div>
<div class="fixed w-64 h-64 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-full top-1/2 left-1/2 opacity-5 animate-pulse" style="animation-delay: 2s;"></div>

<div class="relative z-10 w-full max-w-5xl px-4 py-6 sm:px-6 md:px-8">
    <div class="flex flex-col overflow-hidden bg-white shadow-2xl rounded-3xl lg:flex-row">
        
        <!-- LEFT PANEL - BRANDING -->
        <div id="leftPanel" class="relative flex flex-col items-center justify-between p-8 overflow-hidden transition-all duration-700 lg:w-1/2 bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 sm:p-12">
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 w-64 h-64 -mt-32 -mr-32 bg-white rounded-full opacity-10"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 -mb-24 -ml-24 bg-white rounded-full opacity-10"></div>
            <div class="absolute transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-full top-1/2 left-1/2 w-72 h-72 opacity-5"></div>

            <div></div>

            <!-- Logo & Branding -->
            <div class="relative z-10 flex flex-col items-center justify-center flex-1 text-center">
                <!-- Logo Container -->
                <div class="relative mb-6 group">
                    <!-- Outer glow ring -->
                    <div id="logoGlow" class="absolute inset-0 transition-all duration-700 rounded-full opacity-75 bg-gradient-to-r from-teal-400 via-emerald-400 to-green-400 blur-xl group-hover:opacity-100 animate-pulse"></div>
                    
                    <!-- Logo circle -->
                    <div class="relative flex items-center justify-center w-32 h-32 transition-all duration-500 bg-white rounded-full shadow-2xl sm:w-36 sm:h-36 group-hover:scale-110 group-hover:rotate-6">
                        <!-- Inner gradient circle -->
                        <div id="logoGradient" class="absolute transition-all duration-700 rounded-full inset-2 bg-gradient-to-br from-teal-500 via-emerald-500 to-green-600"></div>
                        
                        <!-- Logo Image -->
                        <div class="relative z-10 flex items-center justify-center w-full h-full">
                            <img src="{{ asset('images/Logo-simprok.png') }}" alt="SimProk Logo" class="object-contain w-20 h-20 sm:w-24 sm:h-24"> 
                        </div>
                    </div>
                </div>

                <!-- App Name -->
                <h1 class="mb-3 text-5xl font-black leading-tight tracking-tight text-white sm:text-6xl drop-shadow-lg">
                    <span class="inline-block animate-fade-in">Sim</span><span class="inline-block animate-fade-in" style="animation-delay: 0.1s;">Prok</span>
                </h1>
                
                <!-- Divider -->
                <div class="relative w-24 h-1.5 mx-auto mb-5 overflow-hidden rounded-full bg-white/20">
                    <div id="dividerShimmer" class="absolute inset-0 bg-gradient-to-r from-teal-300 via-white to-emerald-300 animate-shimmer"></div>
                </div>
                
                <!-- Tagline -->
                <p class="max-w-sm mb-6 text-base font-semibold leading-relaxed sm:text-lg text-white/90 drop-shadow">
                    Sistem Informasi Program Kerja
                </p>

                <!-- Features badges -->
                <div class="flex flex-wrap justify-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-white bg-white/15 backdrop-blur-sm rounded-full border border-white/25">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Cepat
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-white bg-white/15 backdrop-blur-sm rounded-full border border-white/25">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Aman
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-white bg-white/15 backdrop-blur-sm rounded-full border border-white/25">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Mudah
                    </span>
                </div>
            </div>

            <!-- Footer -->
            <div class="relative z-10 flex items-center gap-2 text-sm font-semibold tracking-wide text-white/80">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span>FASILKOM UNEJ © {{ date('Y') }}</span>
            </div>
        </div>

        <!-- RIGHT PANEL - LOGIN FORM -->
        <div class="flex flex-col justify-center p-8 lg:w-1/2 sm:p-12 bg-gradient-to-br from-gray-50 to-teal-50/20">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="mb-2 text-3xl font-black tracking-tight text-gray-900 sm:text-4xl">
                    Masuk ke <span id="headerGradient" class="text-transparent transition-all duration-700 bg-clip-text bg-gradient-to-r from-teal-500 to-emerald-500">SimProk</span>
                </h2>
                <p class="text-sm font-medium text-gray-600">Kelola program kerja dengan mudah dan efisien</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->has('loginError'))
                <div class="flex items-start gap-3 p-4 mb-6 duration-300 border-l-4 border-red-500 shadow-sm rounded-xl bg-red-50 animate-in slide-in-from-top-2">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium text-red-900">{{ $errors->first('loginError') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="flex items-start gap-3 p-4 mb-6 duration-300 border-l-4 border-green-500 shadow-sm rounded-xl bg-green-50 animate-in slide-in-from-top-2">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium text-green-900">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.submit') }}" method="POST" autocomplete="off" id="loginForm" class="space-y-5">
                @csrf
                <input type="hidden" name="user_type" id="userType" value="user">

                <!-- Tab Switcher -->
                <div class="flex gap-2 bg-white p-1.5 rounded-xl border-2 border-gray-200 shadow-sm">
                    <button type="button" 
                            class="flex items-center justify-center flex-1 gap-2 px-4 py-3 text-sm font-bold text-white transition-all duration-500 rounded-lg shadow-md bg-gradient-to-r from-teal-500 to-emerald-500" 
                            id="userTab" 
                            onclick="switchTab('user')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>User</span>
                    </button>
                    <button type="button" 
                            class="flex items-center justify-center flex-1 gap-2 px-4 py-3 text-sm font-bold text-gray-600 transition-all duration-500 rounded-lg hover:bg-gray-100" 
                            id="adminTab" 
                            onclick="switchTab('admin')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Admin</span>
                    </button>
                </div>

                <!-- Username -->
                <div>
                    <label class="block mb-2 text-xs font-bold tracking-wider text-gray-700 uppercase">Username atau Email</label>
                    <div class="relative group">
                        <input type="text" 
                               name="username" 
                               id="username"
                               class="w-full px-4 py-3.5 font-medium text-gray-900 placeholder-gray-400 transition-all duration-300 border-2 border-gray-200 pl-12 rounded-xl focus:outline-none focus:bg-white focus:shadow-lg group-hover:border-gray-300 @error('username') border-red-300 @enderror"
                               value="{{ old('username') }}"
                               placeholder="Masukkan username atau email"
                               required
                               autofocus>
                        <div class="absolute flex items-center justify-center w-5 h-5 -translate-y-1/2 left-4 top-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    @error('username')
                        <div class="flex items-center gap-1.5 mt-2 text-xs font-medium text-red-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block mb-2 text-xs font-bold tracking-wider text-gray-700 uppercase">Password</label>
                    <div class="relative group">
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="w-full px-4 py-3.5 font-medium text-gray-900 placeholder-gray-400 transition-all duration-300 border-2 border-gray-200 pl-12 pr-12 rounded-xl focus:outline-none focus:bg-white focus:shadow-lg group-hover:border-gray-300 @error('password') border-red-300 @enderror"
                               placeholder="Masukkan password"
                               required>
                        <div class="absolute flex items-center justify-center w-5 h-5 -translate-y-1/2 left-4 top-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <button type="button" 
                                class="absolute p-1 text-gray-400 transition-colors -translate-y-1/2 right-4 top-1/2 hover:text-teal-500" 
                                id="togglePasswordBtn"
                                onclick="togglePassword()">
                            <svg class="w-5 h-5" id="passwordIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="flex items-center gap-1.5 mt-2 text-xs font-medium text-red-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        id="loginBtn" 
                        class="w-full py-4 rounded-xl font-bold text-white bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 transition-all duration-500 transform hover:-translate-y-0.5 active:translate-y-0 shadow-lg hover:shadow-xl flex items-center justify-center gap-2.5 disabled:opacity-70 disabled:cursor-not-allowed relative overflow-hidden group">
                    <div class="absolute inset-0 transition-transform duration-1000 -translate-x-full bg-gradient-to-r from-white/0 via-white/20 to-white/0 group-hover:translate-x-full"></div>
                    <svg class="relative z-10 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    <span id="btnText" class="relative z-10">Masuk Sekarang</span>
                </button>
            </form>

            <!-- Footer Links -->
            <div class="flex flex-col items-start justify-between gap-4 pt-6 mt-6 border-t-2 border-gray-200 sm:flex-row sm:items-center">
                <a href="{{ route('password.request') }}" 
                   id="forgotLink" 
                   class="flex items-center gap-2 text-sm font-bold text-teal-500 transition-all duration-500 hover:text-teal-600 hover:gap-3 group">
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Lupa Password?
                </a>
                <span id="modeBadge" 
                      class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold tracking-wider text-teal-600 uppercase transition-all duration-500 border-2 border-teal-200 rounded-full bg-gradient-to-r from-teal-50 to-emerald-50">
                    <svg class="w-4 h-4" id="modeIconSvg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span id="modeText">User Mode</span>
                </span>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
.animate-shimmer {
    animation: shimmer 2s infinite;
}
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.6s ease-out forwards;
}
</style>
@endsection

@push('scripts')
<script>
// ==========================================
// THEME CONFIGURATION
// ==========================================
const themes = {
    user: {
        body: 'bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 min-h-screen flex items-center justify-center transition-all duration-700',
        panel: 'relative flex flex-col items-center justify-between p-8 overflow-hidden lg:w-1/2 bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 sm:p-12 transition-all duration-700',
        logoGlow: 'absolute inset-0 bg-gradient-to-r from-teal-400 via-emerald-400 to-green-400 rounded-full blur-xl opacity-75 group-hover:opacity-100 transition-all duration-700 animate-pulse',
        logoGradient: 'absolute inset-2 bg-gradient-to-br from-teal-500 via-emerald-500 to-green-600 rounded-full transition-all duration-700',
        dividerShimmer: 'absolute inset-0 bg-gradient-to-r from-teal-300 via-white to-emerald-300 animate-shimmer',
        headerGradient: 'text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-emerald-500 transition-all duration-700',
        button: 'w-full py-4 rounded-xl font-bold text-white bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 transition-all duration-500 transform hover:-translate-y-0.5 active:translate-y-0 shadow-lg hover:shadow-xl hover:shadow-teal-500/40 flex items-center justify-center gap-2.5 disabled:opacity-70 disabled:cursor-not-allowed relative overflow-hidden group',
        badge: 'inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-teal-50 to-emerald-50 text-teal-600 rounded-full font-bold text-xs uppercase tracking-wider border-2 border-teal-200 transition-all duration-500',
        link: 'text-teal-500 hover:text-teal-600 font-bold text-sm transition-all duration-500 flex items-center gap-2 hover:gap-3 group',
        toggleBtn: 'absolute p-1 text-gray-400 transition-colors -translate-y-1/2 right-4 top-1/2 hover:text-teal-500',
        tabActive: 'flex items-center justify-center flex-1 gap-2 px-4 py-3 text-sm font-bold text-white transition-all duration-500 rounded-lg shadow-md bg-gradient-to-r from-teal-500 to-emerald-500',
        tabInactive: 'flex items-center justify-center flex-1 gap-2 px-4 py-3 text-sm font-bold text-gray-600 transition-all duration-500 rounded-lg hover:bg-gray-100',
        icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
        text: 'User Mode'
    },
    admin: {
        body: 'bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 min-h-screen flex items-center justify-center transition-all duration-700',
        panel: 'relative flex flex-col items-center justify-between p-8 overflow-hidden lg:w-1/2 bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 sm:p-12 transition-all duration-700',
        logoGlow: 'absolute inset-0 bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 rounded-full blur-xl opacity-75 group-hover:opacity-100 transition-all duration-700 animate-pulse',
        logoGradient: 'absolute inset-2 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-600 rounded-full transition-all duration-700',
        dividerShimmer: 'absolute inset-0 bg-gradient-to-r from-blue-300 via-white to-indigo-300 animate-shimmer',
        headerGradient: 'text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 transition-all duration-700',
        button: 'w-full py-4 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-700 hover:via-indigo-700 hover:to-blue-800 transition-all duration-500 transform hover:-translate-y-0.5 active:translate-y-0 shadow-lg hover:shadow-xl hover:shadow-blue-500/40 flex items-center justify-center gap-2.5 disabled:opacity-70 disabled:cursor-not-allowed relative overflow-hidden group',
        badge: 'inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 rounded-full font-bold text-xs uppercase tracking-wider border-2 border-blue-200 transition-all duration-500',
        link: 'text-blue-600 hover:text-blue-700 font-bold text-sm transition-all duration-500 flex items-center gap-2 hover:gap-3 group',
        toggleBtn: 'absolute p-1 text-gray-400 transition-colors -translate-y-1/2 right-4 top-1/2 hover:text-blue-500',
        tabActive: 'flex items-center justify-center flex-1 gap-2 px-4 py-3 text-sm font-bold text-white transition-all duration-500 rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-indigo-600',
        tabInactive: 'flex items-center justify-center flex-1 gap-2 px-4 py-3 text-sm font-bold text-gray-600 transition-all duration-500 rounded-lg hover:bg-gray-100',
        icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        text: 'Admin Mode'
    }
};

// ==========================================
// SWITCH TAB FUNCTION
// ==========================================
function switchTab(type) {
    const theme = themes[type];
    
    // Update tabs
    const userTab = document.getElementById('userTab');
    const adminTab = document.getElementById('adminTab');
    
    if (type === 'user') {
        userTab.className = theme.tabActive;
        adminTab.className = themes.admin.tabInactive;
    } else {
        adminTab.className = theme.tabActive;
        userTab.className = themes.user.tabInactive;
    }
    
    // Update elements
    document.body.className = theme.body;
    document.getElementById('leftPanel').className = theme.panel;
    document.getElementById('logoGlow').className = theme.logoGlow;
    document.getElementById('logoGradient').className = theme.logoGradient;
    document.getElementById('dividerShimmer').className = theme.dividerShimmer;
    document.getElementById('headerGradient').className = theme.headerGradient;
    document.getElementById('loginBtn').className = theme.button;
    document.getElementById('modeBadge').className = theme.badge;
    document.getElementById('forgotLink').className = theme.link;
    document.getElementById('togglePasswordBtn').className = theme.toggleBtn;
    
    // Update text and icon
    document.getElementById('userType').value = type;
    document.getElementById('modeIconSvg').innerHTML = theme.icon;
    document.getElementById('modeText').textContent = theme.text;
}

// ==========================================
// TOGGLE PASSWORD VISIBILITY
// ==========================================
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('passwordIcon');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
}

// ==========================================
// FORM SUBMIT HANDLER
// ==========================================
document.getElementById('loginForm').addEventListener('submit', function() {
    const loginBtn = document.getElementById('loginBtn');
    const btnText = document.getElementById('btnText');
    loginBtn.disabled = true;
    btnText.innerHTML = '<span class="inline-block w-5 h-5 border-white rounded-full border-3 border-t-transparent animate-spin"></span> Memproses...';
});

// ==========================================
// INITIALIZE
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    switchTab('user');
});
</script>
@endpush
