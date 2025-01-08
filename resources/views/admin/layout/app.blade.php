<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon -->

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon/android-chrome-512x512.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    <title>{{ config('app.name') }}  @hasSection('title'): @yield('title') @else {{ __('Admin panel')  }} @endif</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Add link to recaptchs --}}
    <script src="https://www.google.com/recaptcha/api.js?hl={{ $current_locale }}" async defer></script>

</head>
<body>

    <header class="header-admin">
        @includeIf('admin.layout.header')
    </header>

    <div class="heads_up_admin">
        @includeIf('admin.layout.heads_up_mobile')
    </div>

    @includeIf('components.notifications')

    <main class="main-admin">
        @yield('content')
    </main>

        {{-- Routes for JS --}}
        @stack('scripts')

    <script>
        window.routes = {
            'headerSearch': '{{ route('header_search') }}',
            'registerFormURL': '{{ route('register') }}',
            'timezone': '{{ route('get_timezone') }}',
        }
        let headerSearch = window.routes.headerSearch,
            registerFormURL = window.routes.registerFormURL,
            timezoneRoute = window.routes.timezone;

    </script>
</body>
</html>
