<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="Seller Portal - Authentication" />

        <title>{{ config('app.name', 'Seller Portal') }}</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Cookie Consent -->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/cookie-consent/css/cookie-consent.css') }}" />

        <!-- Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-8 sm:py-0">
            <!-- Authentication Form Container -->
            <div class="w-full sm:max-w-2xl mt-6 px-6 py-8 bg-white shadow-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <script>
            /**
             * Prevent form submission on Enter key press
             *
             * Prevents accidental form submission in guest forms
             * when pressing Enter in text input fields.
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

