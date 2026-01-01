<div class="fixed top-0 left-0 z-50 w-48 h-screen overflow-y-auto text-white bg-gray-900 md:w-64 sidebar">
    <div class="p-4 md:p-6">
        <div class="flex items-center gap-3 mb-6 md:mb-8">
            <div class="flex items-center justify-center bg-blue-500 rounded-lg w-9 h-9 md:w-10 md:h-10">
                <i class="text-lg text-white md:text-xl fas fa-folder-open"></i>
            </div>
            <div>
                <h1 class="text-lg font-bold text-white md:text-xl">SimProk</h1>
                <p class="text-[10px] md:text-xs text-gray-400">User Dashboard</p>
            </div>
        </div>

        <div class="pb-4 mb-4 border-b border-gray-700 md:pb-6 md:mb-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-teal-500 rounded-full md:w-12 md:h-12 md:text-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <p class="text-xs font-semibold text-white truncate md:text-sm">
                        {{ auth()->user()->name }}
                    </p>
                </div>
            </div>
        </div>

        <nav class="mb-8 space-y-2">
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 text-white rounded-lg menu-item active text-sm md:text-base">
                <i class="fas fa-home"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('user.myprokers') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 text-gray-300 rounded-lg menu-item text-sm md:text-base">
                <i class="fas fa-briefcase"></i><span>My Prokers</span>
            </a>
            <a href="{{ route('user.documents') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 text-gray-300 rounded-lg menu-item text-sm md:text-base">
                <i class="fas fa-file-alt"></i><span>Documents</span>
            </a>
            <a href="{{ route('user.notifications') }}" class="relative flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 text-gray-300 rounded-lg menu-item text-sm md:text-base">
                <i class="fas fa-bell"></i><span>Notifications</span>
            </a>
            <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 text-gray-300 rounded-lg menu-item text-sm md:text-base">
                <i class="fas fa-user"></i><span>Profile</span>
            </a>
        </nav>
    </div>

    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700 md:p-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full px-4 py-2 text-xs font-medium text-white bg-red-600 rounded-lg md:text-sm hover:bg-red-700 btn">
                <i class="mr-2 fas fa-sign-out-alt"></i>Logout
            </button>
        </form>
    </div>
</div>
