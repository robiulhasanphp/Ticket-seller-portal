<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="Seller Portal - Ticket Management System" />

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

        <title>{{ config('app.name', 'Seller Portal') }}</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/nanobar.js'])
        @livewireStyles
    </head>

    <body class="font-sans antialiased h-full" data-nanobar="radial-gradient(circle at 30% 107%,#fdf497 0%,#fdf497 5%,#fd5949 45%,#d6249f 60%,#285AEB 90%)">
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Main Content Area -->
        <main class="flex-1">
            <x-navigation.sidebar>
                {{ $slot }}
            </x-navigation.sidebar>
        </main>

        @stack('scripts')
        @livewireScripts

        <script>
            /**
             * Add loading state class to DOM elements
             */
            function addLoadingClass() {
                const element = document.getElementById('loadingClass');
                if (element) {
                    element.classList.add('loading');
                }
            }

            /**
             * Prevent form submission on Enter key press
             *
             * This prevents accidental form submission when pressing Enter
             * in text input fields that should not trigger submission.
             */
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('form');
                if (form) {
                    form.addEventListener('keypress', function (e) {
                        if (e.keyCode === 13) {
                            e.preventDefault();
                        }
                    });
                }
            });
        </script>
    </body>
</html>




