{{-- User Sidebar — Premium Dark Glass --}}
<div class="user-sidebar fixed top-0 left-0 z-50 w-64 h-screen overflow-y-auto text-white transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 border-r border-white/5 flex flex-col justify-between">

    <div>
        {{-- Header --}}
        <div class="p-5 md:p-6 border-b border-white/10">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 md:w-11 md:h-11 rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600 shadow-lg shadow-teal-500/25">
                        <i class="text-lg text-white md:text-xl fas fa-folder-open"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-extrabold tracking-tight text-white">SimProk</h1>
                        <p class="text-[10px] md:text-xs font-medium text-slate-400">User Panel</p>
                    </div>
                </div>

                {{-- Mobile close --}}
                <button id="userSidebarClose"
                        class="p-2 text-slate-400 rounded-lg md:hidden hover:bg-white/10 hover:text-white transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- User Info Card --}}
        <div class="p-4 border-b border-white/10">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5">
                <div class="flex items-center justify-center w-10 h-10 md:w-11 md:h-11 text-sm font-bold text-white rounded-full bg-gradient-to-br from-teal-500 to-emerald-600 shadow-md">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-slate-400 capitalize">{{ auth()->user()->role }}</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="p-4 space-y-1.5">
            <p class="px-3 mb-2 text-[10px] font-bold uppercase tracking-widest text-slate-500">Menu Utama</p>

            <a href="{{ route('user.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('user.dashboard')
                        ? 'bg-gradient-to-r from-teal-600/90 to-emerald-600/90 text-white shadow-lg shadow-teal-500/20 font-semibold'
                        : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-home w-5 text-center"></i>
                <span class="font-medium text-sm">Dashboard</span>
            </a>

            <a href="{{ route('user.myprokers') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('user.myprokers*')
                        ? 'bg-gradient-to-r from-teal-600/90 to-emerald-600/90 text-white shadow-lg shadow-teal-500/20 font-semibold'
                        : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-briefcase w-5 text-center"></i>
                <span class="font-medium text-sm">My Prokers</span>
            </a>

            <a href="{{ route('user.documents') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('user.documents*')
                        ? 'bg-gradient-to-r from-teal-600/90 to-emerald-600/90 text-white shadow-lg shadow-teal-500/20 font-semibold'
                        : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-file-alt w-5 text-center"></i>
                <span class="font-medium text-sm">Documents</span>
            </a>

            <a href="{{ route('user.notifications') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('user.notifications*')
                        ? 'bg-gradient-to-r from-teal-600/90 to-emerald-600/90 text-white shadow-lg shadow-teal-500/20 font-semibold'
                        : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-bell w-5 text-center"></i>
                <span class="font-medium text-sm">Notifications</span>
            </a>

            <a href="{{ route('user.profile') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('user.profile*')
                        ? 'bg-gradient-to-r from-teal-600/90 to-emerald-600/90 text-white shadow-lg shadow-teal-500/20 font-semibold'
                        : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-user w-5 text-center"></i>
                <span class="font-medium text-sm">Profile</span>
            </a>
        </nav>
    </div>

    {{-- Logout --}}
    <div class="p-4 border-t border-white/10">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="flex items-center justify-center w-full gap-2 px-4 py-2.5 text-sm font-semibold text-red-300 transition-all duration-200 rounded-xl border border-red-500/20 bg-red-500/10 hover:bg-red-500/20 hover:text-red-200">
                <i class="fas fa-sign-out-alt text-xs"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
