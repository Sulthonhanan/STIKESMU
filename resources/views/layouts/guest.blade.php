<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#0e7040',
                            secondary: '#073c22',
                            accent: '#fbc531',
                        },
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            display: ['Outfit', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
        @if (file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-secondary via-primary to-emerald-900">
            <div class="text-center mb-2">
                <a href="/" class="flex flex-col items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo STIKESMU" class="h-20 w-auto object-contain">
                    <div class="text-center">
                        <span class="text-white font-display font-bold text-xl block tracking-tight">STIKES MUHAMMADIYAH</span>
                        <span class="text-accent font-display text-sm font-semibold tracking-wider">WONOSOBO</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-4 px-8 py-6 bg-white/95 backdrop-blur-md shadow-2xl overflow-hidden sm:rounded-2xl border border-white/20">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
