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
        {{-- Header --}}
        {{-- <header class="d-flex flex-column justify-content-center"> --}}
        <header>
            <div class="container">
                <div class="desktop_header">
                    @includeIf('layouts.header')
                </div>
                <div class="mobile_header">
                    @includeIf('layouts.header_mobile')
                </div>
            </div>
        </header>


        {{-- Notification --}}
        @includeIf('components.notifications')

        {{-- Pages --}}
        <main class="main-web">
            {{-- Crumbs --}}
            <section class="crumbs__route">
                <div class="container">@yield('crumbs')</div>
            </section>

            <div class="container">@yield('content')</div>

        </main>

        {{-- Footer --}}

        <footer>
            <div class="container">
                <div class="desktop_footer">
                    @includeIf('layouts.footer')
                </div>
                <div class="mobile_footer">
                    @includeIf('layouts.footer_mobile')
                </div>
            </div>
        </footer>

        {{-- Searching block --}}
        <section id="header__searching">
            @includeIf('components.set_searching')
        </section>

        {{-- Routes for JS --}}
        <script>
            window.routes = {
                'mainRoute': '{{ route('index') }}',
                'headerSearch': '{{ route('header_search') }}',
                'registerFormURL': '{{ route('register') }}',
                'timezone': '{{ route('get_timezone') }}',
                'screenWidth': '{{ route('get_screen_width') }}',
            }
            let mainRoute = window.routes.mainRoute,
                headerSearch = window.routes.headerSearch,
                registerFormURL = window.routes.registerFormURL,
                timezoneRoute = window.routes.timezone,
                screenWidthRoute = window.routes.screenWidth;
        </script>
</html>
