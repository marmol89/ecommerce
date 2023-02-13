<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/glider-js/glider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/flex-slider/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('vendor/dropzone/dist/dropzone.css') }}"> --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('vendor/ckeditor/build/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/glider-js/glider.min.js') }}"></script>
    <script src="{{ asset('vendor/flex-slider/node_modules/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('vendor/flex-slider/jquery.flexslider-min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.js') }}"></script>
    {{--    <script src="{{ asset('vendor/dropzone/dist/dropzone.js') }}"></script>--}}
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <!-- Dropzone -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>
<body class="font-sans antialiased">
<x-jet-banner />

<div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')

    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

@stack('modals')

@livewireScripts

@stack('scripts')
</body>
</html>
