<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="icon" type="image/png" href="{{ asset('admin/images/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('admin/images/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/images/favicon/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Ouron" />
    <link rel="manifest" href="{{ asset('admin/images/favicon/site.webmanifest') }}" />

    <title>@yield('title', 'Ouron Ecommerce')</title>

    @yield('openGraph', '')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- ==== Swipper CSS CDN ==== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- AOS Animation --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Sweat Alert CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>

    @include('frontend.layouts.header') {{-- Include Header --}}

    <main class="container-fluid p-0 m-0">
        @yield('content') {{-- Dynamic Page Content --}}
    </main>

    @include('frontend.layouts.footer') {{-- Include Footer --}}

    {{-- JQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Custom js --}}
    <script src="{{ asset('js/script.js') }}"></script>

    {{-- AOS Script --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    @yield('swiper-script', '')
</body>

</html>
