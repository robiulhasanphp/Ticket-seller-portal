<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
        <title>{{ config('app.name', 'Seller Portal') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
      {{--  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>--}}
        @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/nanobar.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased h-full" data-nanobar="radial-gradient(circle at 30% 107%,#fdf497 0%,#fdf497 5%,#fd5949 45%,#d6249f 60%,#285AEB 90%)">
        <!-- Page Heading -->
        @if (isset($header))
            <header>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <!-- Page Content -->
        <main>
            <x-navigation.sidebar>
                {{ $slot }}
            </x-navigation.sidebar>
        </main>
        @stack('scripts')
    </body>
    @livewireScripts

<script>
    function addLoadingClass() {
        let element = document.getElementById('loadingClass');
        element.classList.add('loading');
    }

    const form = document.getElementById('form');
    if (form) {
        form.addEventListener('keypress', function(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        });
    }

</script>
</html>



