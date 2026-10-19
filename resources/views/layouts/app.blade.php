<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Fakultas Kedokteran Universitas Bumigora | Menyiapkan Dokter Masa Depan')</title>
    <meta name="description" content="@yield('meta_description', 'Official portal Fakultas Kedokteran Universitas Bumigora (UBG) Mataram, Lombok, Nusa Tenggara Barat. Pendidikan dokter humanis, kompeten, dan berbasis keunggulan klinis.')">
    <meta name="keywords" content="fakultas kedokteran bumigora, fk ubg, kedokteran mataram ntb, universitas bumigora kedokteran, pendidikan dokter lombok, profesi dokter ubg">
    <meta name="author" content="Universitas Bumigora">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Fakultas Kedokteran Universitas Bumigora')">
    <meta property="og:description" content="@yield('meta_description', 'Menyiapkan Dokter Masa Depan yang Kompeten dan Humanis di Universitas Bumigora.')">
    <meta property="og:image" content="{{ asset('images/logos/ubg-blue.png') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Fakultas Kedokteran Universitas Bumigora')">
    <meta name="twitter:description" content="@yield('meta_description', 'Menyiapkan Dokter Masa Depan yang Kompeten dan Humanis di Universitas Bumigora.')">
    <meta name="twitter:image" content="{{ asset('images/logos/ubg-blue.png') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logos/logo-ubg.png') }}">

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body 
    x-data="{ 
        scrolled: false, 
        mobileMenuOpen: false,
        modalOpen: false,
        activeModal: null,
        openModal(id) { this.activeModal = id; this.modalOpen = true; document.body.classList.add('overflow-hidden'); },
        closeModal() { this.activeModal = null; this.modalOpen = false; document.body.classList.remove('overflow-hidden'); }
    }" 
    @scroll.window="scrolled = (window.pageYOffset > 40)"
    @keydown.escape.window="closeModal()"
    class="min-h-full flex flex-col text-body font-sans bg-white selection:bg-[#2466C1]/20 selection:text-[#163b70]"
>
    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-heading focus:text-white focus:rounded-md focus:shadow-lg focus:outline-none">
        {{ __('Lompat ke konten utama') }}
    </a>

    <!-- Top Bar -->
    @include('partials.top-bar')

    <!-- Main Navigation Bar -->
    @include('partials.navbar')

    <!-- Main Content Area -->
    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    @stack('scripts')
</body>
</html>
