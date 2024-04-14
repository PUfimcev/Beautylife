<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <meta name="description" content="Website BeautyLife">

        <title>{{ config('app.name') }}@hasSection('title'): @yield('title')@endif</title>

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

        <!-- Vite -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        {{-- Add link to recaptchs --}}
        <script src="https://www.google.com/recaptcha/api.js?hl={{ $current_locale }}" async defer></script>

    </head>
    <body>

        <header class="d-flex flex-column justify-content-center">
            @includeIf('layouts.header')
        </header>


        <section class="crumbs__route">
            <div class="container">@yield('crumbs')</div>
        </section>


        @includeIf('components.notifications')

        <main class="main-web">
            @yield('content')
        </main>

        <section id="header__searching">
            @includeIf('components.set_searching')
        </section>

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
