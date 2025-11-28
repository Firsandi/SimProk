@extends('layouts.guest')

@section('content')

<!-- WRAPPER BARU → agar card login benar-benar di tengah -->
<div class="flex items-center justify-center min-h-screen px-4">

    <!-- Floating Background Elements -->
    <div class="fixed bottom-0 left-0 -mb-48 -ml-48 bg-white rounded-full w-96 h-96 opacity-5 animate-pulse"></div>
    <div class="fixed top-0 right-0 -mt-40 -mr-40 bg-white rounded-full w-80 h-80 opacity-5 animate-pulse" style="animation-delay: 1s;"></div>

    <div class="w-full max-w-4xl px-4 py-6 sm:px-6 md:px-8">
        <div class="flex flex-col overflow-hidden bg-white shadow-2xl rounded-2xl lg:flex-row min-h-96">
            
            <!-- LEFT PANEL - BRANDING -->
            <div class="relative flex flex-col items-center justify-between p-8 overflow-hidden lg:w-1/2 bg-gradient-to-br from-teal-500 via-teal-400 to-teal-600 sm:p-12">
                <div class="absolute top-0 right-0 w-64 h-64 -mt-32 -mr-32 bg-white rounded-full opacity-10"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 -mb-24 -ml-24 bg-white rounded-full opacity-10"></div>

                <div></div>

                <div class="relative z-10 flex flex-col items-center justify-center flex-1 text-center">
                    <div class="flex items-center justify-center w-20 h-20 mb-4 transition-transform duration-300 bg-white rounded-full shadow-lg sm:w-24 sm:h-24 sm:mb-6 hover:scale-105">
                        <span class="text-5xl font-black text-transparent sm:text-6xl bg-gradient-to-r from-teal-500 to-teal-600 bg-clip-text">SP</span>
                    </div>
                    <h1 class="mb-3 text-4xl font-black leading-tight text-white sm:text-5xl">SimProk</h1>
                    <div class="w-12 h-1 mx-auto mb-4 rounded-full sm:w-16 bg-gradient-to-r from-emerald-200 to-cyan-300"></div>
                    <p class="max-w-xs text-sm font-medium leading-relaxed text-cyan-50 sm:text-base">
                        Sistem Manajemen Program Kerja Organisasi
                    </p>
                </div>

                <div class="relative z-10 text-xs font-medium tracking-wider text-white text-opacity-60">
                    © FASILKOM UNEJ {{ date('Y') }}
                </div>
            </div>

            <!-- RIGHT PANEL - LOGIN FORM -->
            <div class="flex flex-col justify-center p-8 lg:w-1/2 sm:p-12 bg-gray-50">
                <h2 class="mb-2 text-2xl font-black text-gray-900 sm:text-3xl">Masuk ke SimProk</h2>
                <p class="mb-8 text-sm font-medium text-gray-600">Kelola program kerja dengan mudah dan efisien</p>

                @if ($errors->has('loginError'))
                    <div class="flex items-start gap-3 p-3 mb-5 duration-300 border-l-4 border-red-500 rounded-lg sm:p-4 bg-red-50 animate-in slide-in-from-top-2">
                        <i class="fas fa-exclamation-circle text-red-700 text-lg mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-red-900">{{ $errors->first('loginError') }}</span>
                    </div>
                @endif

                @if (session('success'))
                    <div class="flex items-start gap-3 p-3 mb-5 duration-300 border-l-4 border-green-500 rounded-lg sm:p-4 bg-green-50 animate-in slide-in-from-top-2">
                        <i class="fas fa-check-circle text-green-700 text-lg mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-green-900">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST" autocomplete="off" id="loginForm" class="space-y-5">
                    @csrf
                    <input type="hidden" name="user_type" id="userType" value="user">

                    <div class="flex gap-2 bg-white p-1.5 rounded-xl border border-gray-200">
                        <button type="button" class="tab-btn flex-1 flex items-center justify-center gap-2 py-2 px-3 sm:py-2.5 sm:px-4 rounded-lg text-sm font-semibold transition-all duration-300 active bg-gradient-to-r from-teal-500 to-teal-400 text-white shadow-md hover:shadow-lg" id="userTab" onclick="switchTab('user', event)">
                            <i class="fas fa-user-circle"></i>
                            <span>User</span>
                        </button>
                        <button type="button" class="tab-btn flex-1 flex items-center justify-center gap-2 py-2 px-3 sm:py-2.5 sm:px-4 rounded-lg text-sm font-semibold text-gray-600 transition-all duration-300 hover:bg-gray-100" id="adminTab" onclick="switchTab('admin', event)">
                            <i class="fas fa-shield-alt"></i>
                            <span>Admin</span>
                        </button>
                    </div>

                    <div>
                        <label class="block mb-2 text-xs font-bold tracking-wider text-gray-900 uppercase">Username atau Email</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="username" 
                                id="username"
                                class="w-full px-4 py-3 font-medium text-gray-900 placeholder-gray-500 transition-all duration-300 border-2 border-gray-200 pl-11 rounded-xl focus:outline-none focus:border-teal-500 focus:bg-gradient-to-b focus:from-white focus:to-teal-50 focus:shadow-lg focus:shadow-teal-500/20"
                                value="{{ old('username') }}"
                                placeholder="firsandi atau firsandi@fasilkom.unej.ac.id"
                                required
                                autofocus>
                            <i class="absolute text-gray-400 -translate-y-1/2 fas fa-user left-4 top-1/2"></i>
                        </div>
                        @error('username')
                            <div class="flex items-center gap-1 mt-1 text-xs text-red-600">
                                <i class="fas fa-times-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-xs font-bold tracking-wider text-gray-900 uppercase">Password</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                class="w-full px-4 py-3 font-medium text-gray-900 placeholder-gray-500 transition-all duration-300 border-2 border-gray-200 pl-11 rounded-xl focus:outline-none focus:border-teal-500 focus:bg-gradient-to-b focus:from-white focus:to-teal-50 focus:shadow-lg focus:shadow-teal-500/20"
                                placeholder="Masukkan password Anda"
                                required>
                            <i class="absolute text-gray-400 -translate-y-1/2 fas fa-lock left-4 top-1/2"></i>
                            <button type="button" class="absolute p-1 text-gray-400 -translate-y-1/2 right-4 top-1/2 hover:text-teal-500" onclick="togglePassword(event)">
                                <i class="text-lg fas fa-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="flex items-center gap-1 mt-1 text-xs text-red-600">
                                <i class="fas fa-times-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <button type="submit" id="loginBtn" class="w-full py-3 rounded-xl font-bold text-white bg-gradient-to-r from-teal-500 to-teal-400 hover:from-teal-600 hover:to-teal-500 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 shadow-lg hover:shadow-xl hover:shadow-teal-500/30 flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                        <i class="text-base fas fa-sign-in-alt"></i>
                        <span id="btnText">Masuk Sekarang</span>
                    </button>
                </form>

                <div class="flex flex-col items-start justify-between gap-4 pt-5 mt-6 border-t border-gray-200 sm:flex-row sm:items-center">
                    <a href="#" class="text-teal-600 hover:text-teal-700 font-semibold text-xs sm:text-sm transition-all duration-300 flex items-center gap-1.5 hover:gap-2">
                        <i class="fas fa-question-circle"></i>
                        Lupa Password?
                    </a>
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-teal-50 text-teal-700 rounded-full font-bold text-xs uppercase tracking-wider whitespace-nowrap">
                        <i class="fas fa-user-circle" id="modeIcon"></i>
                        <span id="modeText">User Mode</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

</div> <!-- END WRAPPER CENTER -->

@endsection

@push('scripts')
<script>
    function switchTab(type, event) {
        event?.preventDefault();
        const userTab = document.getElementById('userTab');
        const adminTab = document.getElementById('adminTab');
        const userTypeInput = document.getElementById('userType');
        const modeIcon = document.getElementById('modeIcon');
        const modeText = document.getElementById('modeText');

        if (type === 'user') {
            userTab.classList.add('active','bg-gradient-to-r','from-teal-500','to-teal-400','text-white','shadow-md');
            userTab.classList.remove('text-gray-600','hover:bg-gray-100');

            adminTab.classList.remove('active','bg-gradient-to-r','from-teal-500','to-teal-400','text-white','shadow-md');
            adminTab.classList.add('text-gray-600','hover:bg-gray-100');

            userTypeInput.value = 'user';
            modeIcon.className = 'fas fa-user-circle';
            modeText.textContent = 'User Mode';
        } else {
            adminTab.classList.add('active','bg-gradient-to-r','from-teal-500','to-teal-400','text-white','shadow-md');
            adminTab.classList.remove('text-gray-600','hover:bg-gray-100');

            userTab.classList.remove('active','bg-gradient-to-r','from-teal-500','to-teal-400','text-white','shadow-md');
            userTab.classList.add('text-gray-600','hover:bg-gray-100');

            userTypeInput.value = 'admin';
            modeIcon.className = 'fas fa-shield-alt';
            modeText.textContent = 'Admin Mode';
        }
    }

    function togglePassword(event) {
        event.preventDefault();
        const input = document.getElementById('password');
        const icon = document.getElementById('passwordIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye','fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash','fa-eye');
        }
    }

    document.getElementById('loginForm').addEventListener('submit', () => {
        const loginBtn = document.getElementById('loginBtn');
        const btnText = document.getElementById('btnText');
        loginBtn.disabled = true;
        btnText.innerHTML = '<span class="inline-block w-4 h-4 border-2 border-white rounded-full border-t-transparent animate-spin"></span> Loading...';
    });

    document.addEventListener('DOMContentLoaded', () => switchTab('user'));
</script>
@endpush
