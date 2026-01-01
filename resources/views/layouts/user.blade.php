<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SimProk - Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.Swal = Swal;
</script>

<body class="font-sans bg-gray-50">
    @include('components.user.Sidebar')

    <div class="fixed inset-0 z-40 hidden bg-black/40 backdrop-blur-sm md:hidden"
         id="userSidebarOverlay"></div>

    <div class="min-h-screen md:ml-64 main-content">
        @include('components.user.Navbar')

        <main class="p-4 md:p-6">
            @yield('content')
        </main>
    </div>

    {{-- Script toggle sidebar user --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.querySelector('.user-sidebar');
            const toggle  = document.getElementById('userSidebarToggle');
            const closeBtn = document.getElementById('userSidebarClose');
            const overlay = document.getElementById('userSidebarOverlay');

            function openSidebar() {
                if (!sidebar) return;
                sidebar.classList.remove('-translate-x-full');
                if (overlay) overlay.classList.remove('hidden');
            }

            function closeSidebar() {
                if (!sidebar) return;
                sidebar.classList.add('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
            }

            if (toggle) {
                toggle.addEventListener('click', () => {
                    if (sidebar.classList.contains('-translate-x-full')) {
                        openSidebar();
                    } else {
                        closeSidebar();
                    }
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
