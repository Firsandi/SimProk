<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SimProk - Dashboard')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Axios CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';</script>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.Swal = Swal;
        window.confirmAction = function (form, {
            title = 'Konfirmasi',
            text = 'Yakin ingin melanjutkan aksi ini?',
            confirmText = 'Ya, lanjutkan',
            cancelText = 'Batal',
            icon = 'warning',
        } = {}) {
            Swal.fire({
                icon: icon, title: title, text: text,
                showCancelButton: true,
                confirmButtonText: confirmText,
                cancelButtonText: cancelText,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
            }).then((result) => { if (result.isConfirmed) form.submit(); });
            return false;
        };
    </script>

    @stack('styles')

    {{-- Custom Design System CSS --}}
    <style>
        body { font-family: 'Plus Jakarta Sans', 'Inter', ui-sans-serif, system-ui, sans-serif; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, 0.4); border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(148, 163, 184, 0.7); }

        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }

        /* Micro-Animations */
        @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
        @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slide-in-left { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-6px); } }
        @keyframes pulse-soft { 0%, 100% { opacity: 0.6; } 50% { opacity: 1; } }
        @keyframes gradient-shift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }

        .animate-shimmer { animation: shimmer 2s infinite; }
        .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
        .animate-fade-in-up { animation: fade-in-up 0.5s ease-out forwards; }
        .animate-slide-in-left { animation: slide-in-left 0.4s ease-out forwards; }
        .animate-float { animation: float 4s ease-in-out infinite; }
        .animate-pulse-soft { animation: pulse-soft 3s ease-in-out infinite; }
        .animate-gradient { background-size: 200% 200%; animation: gradient-shift 6s ease infinite; }

        .stagger-1 { animation-delay: 0.05s; } .stagger-2 { animation-delay: 0.1s; }
        .stagger-3 { animation-delay: 0.15s; } .stagger-4 { animation-delay: 0.2s; }

        /* Glass Effect */
        .glass { background: rgba(255,255,255,0.7); backdrop-filter: blur(12px) saturate(180%); -webkit-backdrop-filter: blur(12px) saturate(180%); }
        .glass-dark { background: rgba(15,23,42,0.85); backdrop-filter: blur(16px) saturate(200%); -webkit-backdrop-filter: blur(16px) saturate(200%); }

        /* Sidebar active indicator */
        .sidebar-active-indicator { position: relative; }
        .sidebar-active-indicator::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 60%; border-radius: 0 4px 4px 0; background: linear-gradient(180deg, #38bdf8, #818cf8); }
    </style>
</head>

<body class="bg-slate-50/80 text-gray-800 antialiased">
    @include('components.user.Sidebar')

    <div class="fixed inset-0 z-40 hidden bg-black/40 backdrop-blur-sm md:hidden transition-opacity duration-300"
         id="userSidebarOverlay"></div>

    <div class="min-h-screen md:ml-64 main-content transition-all duration-300">
        @include('components.user.Navbar')

        <main class="p-4 md:p-6 lg:p-8">
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
