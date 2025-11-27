@extends('layouts.guest')

@section('content')
<div class="flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-3xl glass rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
        
        {{-- Left Side --}}
        <div class="md:w-1/2 gradient-left flex flex-col justify-between items-center p-12 relative overflow-hidden text-white">
            <div class="relative z-10 flex flex-col items-center flex-1 justify-center w-full">
                <div class="mb-8 text-center">
                    <div class="w-32 h-32 logo-shadow bg-white rounded-full flex items-center justify-center mb-6">
                        <span class="text-teal-600 text-7xl font-extrabold">SP</span>
                    </div>
                    <h2 class="text-5xl font-extrabold mb-2 drop-shadow-lg">SimProk</h2>
                    <div class="h-1 w-16 bg-gradient-to-r from-emerald-300 to-cyan-300 rounded-full mx-auto mb-4"></div>
                    <p class="text-cyan-50 text-sm font-medium drop-shadow text-center leading-relaxed max-w-xs">
                        Kelola Program Kerja Anda Dengan Mudah dan Efisien
                    </p>
                </div>
            </div>
            <div class="relative z-10 text-center text-white/60 text-xs tracking-widest font-medium mt-8">
                FASILKOM UNEJ © {{ date('Y') }}
            </div>
        </div>

        {{-- Right Side --}}
        <div class="md:w-1/2 px-8 py-10 flex flex-col justify-center">
            <div class="mb-8 text-center">
                <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Masuk ke SimProk</h3>
                <p class="text-gray-600 text-sm font-medium">Pilih tipe akun dan masukkan kredensial Anda</p>
            </div>

            @include('components.auth.Login-tabs')
            @include('components.auth.Login-error')

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5" autocomplete="off">
                @csrf
                <input type="hidden" name="user_type" id="userType" value="user">

                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-800 mb-2">Username atau Email</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            class="w-full border-2 border-gray-200 rounded-lg pl-11 pr-4 py-3 text-gray-800 placeholder-gray-400 font-medium focus:outline-none transition-all"
                            placeholder="firsandi atau firsandi@fasilkom.unej.ac.id" required>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-800 mb-2">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="password" id="password" name="password"
                            class="w-full border-2 border-gray-200 rounded-lg pl-11 pr-4 py-3 text-gray-800 placeholder-gray-400 font-medium focus:outline-none transition-all"
                            placeholder="Masukkan password Anda" required>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" id="loginBtn"
                        class="w-full py-3 rounded-lg font-semibold bg-teal-600 hover:bg-teal-700 transition text-white flex items-center justify-center gap-2 shadow">
                        <i class="fa fa-sign-in-alt"></i><span>Login</span>
                    </button>
                </div>
            </form>

            <div class="mt-8 flex items-center justify-between text-xs">
                <a href="#" class="text-teal-600 hover:text-teal-800 font-medium transition-colors">Lupa password?</a>
                <span class="inline-block px-4 py-1.5 bg-teal-50 text-teal-700 rounded-full font-semibold text-xs" id="loginInfo">👤 User Mode</span>
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
        const loginInfo = document.getElementById('loginInfo');

        if (type === 'user') {
            userTab.classList.add('active'); userTab.classList.remove('inactive');
            adminTab.classList.remove('active'); adminTab.classList.add('inactive');
            userTypeInput.value = 'user';
            loginBtn.children[1].textContent = 'Login as User';
            loginInfo.textContent = '👤 User Mode';
        } else {
            adminTab.classList.add('active'); adminTab.classList.remove('inactive');
            userTab.classList.remove('active'); userTab.classList.add('inactive');
            userTypeInput.value = 'admin';
            loginBtn.children[1].textContent = 'Login as Admin';
            loginInfo.textContent = '🔐 Admin Mode';
        }
    }
    document.addEventListener('DOMContentLoaded', () => { switchTab('user'); });
</script>
@endsection
