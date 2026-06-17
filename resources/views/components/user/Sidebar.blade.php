{{-- User Sidebar — Premium Dark Glass --}}
<div class="user-sidebar fixed top-0 left-0 z-50 w-64 h-screen overflow-y-auto text-white transition-all duration-300 ease-in-out -translate-x-full md:translate-x-0 bg-slate-900/95 backdrop-blur-2xl border-r border-white/10 shadow-[4px_0_24px_rgba(0,0,0,0.4)] flex flex-col justify-between">

    <div>
        {{-- Header --}}
        <div class="p-6 border-b border-white/5 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-teal-500/10 to-emerald-600/10 z-0"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-400 to-emerald-600 shadow-lg shadow-teal-500/30 transform hover:scale-105 transition-transform duration-300">
                        <i class="text-xl text-white fas fa-folder-open animate-pulse-soft"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-300">SimProk</h1>
                        <p class="text-xs font-semibold text-teal-400 tracking-wider uppercase mt-0.5">User Panel</p>
                    </div>
                </div>

                {{-- Mobile close --}}
                <button id="userSidebarClose"
                        class="p-2 text-slate-400 rounded-xl md:hidden hover:bg-white/10 hover:text-white transition-all duration-200">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>

        {{-- User Info Card --}}
        <div class="px-5 py-6">
            <div class="group relative flex items-center gap-4 p-3.5 rounded-2xl bg-gradient-to-br from-white/5 to-white/[0.02] border border-white/10 hover:border-teal-500/30 transition-all duration-300 cursor-pointer overflow-hidden shadow-lg">
                <div class="absolute inset-0 bg-gradient-to-r from-teal-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10 flex items-center justify-center w-12 h-12 text-lg font-bold text-white rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600 shadow-md shadow-teal-500/20 group-hover:shadow-teal-500/40 transition-all duration-300">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="relative z-10 flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate group-hover:text-teal-300 transition-colors duration-200">
                        {{ auth()->user()->name ?? 'User Name' }}
                    </p>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <p class="text-xs text-slate-400 font-medium capitalize">{{ auth()->user()->role ?? 'User' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="px-4 space-y-2">
            <p class="px-4 mb-3 text-[10px] font-extrabold uppercase tracking-widest text-slate-500">Main Navigation</p>

            @php
                $navItems = [
                    ['route' => 'user.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard', 'pattern' => 'user.dashboard'],
                    ['route' => 'user.myprokers', 'icon' => 'fa-briefcase', 'label' => 'My Prokers', 'pattern' => 'user.myprokers*'],
                    ['route' => 'user.documents', 'icon' => 'fa-file-alt', 'label' => 'Documents', 'pattern' => 'user.documents*'],
                    ['route' => 'user.notifications', 'icon' => 'fa-bell', 'label' => 'Notifications', 'pattern' => 'user.notifications*'],
                    ['route' => 'user.profile', 'icon' => 'fa-user', 'label' => 'Profile', 'pattern' => 'user.profile*'],
                ];
            @endphp

            @foreach($navItems as $item)
                @php
                    $isActive = request()->routeIs($item['pattern']);
                @endphp
                <a href="{{ route($item['route']) }}"
                   class="group flex items-center gap-3.5 px-4 py-3.5 rounded-xl transition-all duration-300 relative overflow-hidden
                        {{ $isActive
                            ? 'bg-gradient-to-r from-teal-500/20 to-emerald-500/5 text-white border border-teal-500/30 shadow-[0_0_15px_rgba(20,184,166,0.15)]'
                            : 'text-slate-400 hover:bg-white/5 hover:text-white border border-transparent' }}">
                    
                    @if($isActive)
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-gradient-to-b from-teal-400 to-emerald-500 rounded-r-full shadow-[0_0_10px_rgba(45,212,191,0.6)]"></div>
                    @endif
                    
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg transition-all duration-300 {{ $isActive ? 'bg-gradient-to-br from-teal-500 to-emerald-600 text-white shadow-md' : 'bg-white/5 text-slate-400 group-hover:bg-white/10 group-hover:text-teal-400' }}">
                        <i class="fas {{ $item['icon'] }} text-sm transition-transform duration-300 group-hover:scale-110"></i>
                    </div>
                    <span class="font-semibold text-sm tracking-wide">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>

    {{-- Logout --}}
    <div class="p-5 mt-auto relative">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent pointer-events-none"></div>
        <form action="{{ route('logout') }}" method="POST" class="relative z-10">
            @csrf
            <button class="group relative flex items-center justify-center w-full gap-2.5 px-4 py-3.5 text-sm font-bold text-rose-400 transition-all duration-300 rounded-xl bg-rose-500/10 border border-rose-500/20 hover:bg-rose-500 hover:text-white hover:border-rose-500 hover:shadow-[0_0_20px_rgba(244,63,94,0.3)] overflow-hidden">
                <i class="fas fa-power-off text-sm transition-transform duration-300 group-hover:rotate-180"></i>
                <span class="tracking-wide">Log Out</span>
            </button>
        </form>
    </div>
</div>
