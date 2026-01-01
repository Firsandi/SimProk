<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SimProk - Admin Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.Swal = Swal;
</script>

<body class="font-sans bg-gray-50">
    {{-- Sidebar tetap seperti dulu --}}
    @include('components.admin.sidebar')

    {{-- Wrapper konten, sekarang responsif --}}
    <div class="min-h-screen md:ml-64">
        @include('components.admin.navbar', [
            'title' => $pageTitle ?? 'dashboard',
            'subtitle' => $pageSubtitle ?? 'Kelola semua data'
        ])

        <main class="p-4 md:p-6">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
