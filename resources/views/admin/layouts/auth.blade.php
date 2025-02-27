<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <!-- App favicon -->
    <link rel="icon" type="image/png" href="{{ asset('admin/images/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('admin/images/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/images/favicon/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Ouron" />
    <link rel="manifest" href="{{ asset('admin/images/favicon/site.webmanifest') }}" />

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('admin/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('admin/js/config.js') }}"></script>
</head>

<body>
    
    @yield('content')

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="admin/js/vendor.js"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="admin/js/app.js"></script>
</body>

</html>
