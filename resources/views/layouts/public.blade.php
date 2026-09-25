<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'STIKES Muhammadiyah Wonosobo')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

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
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900 flex flex-col min-h-screen">
        @include('components.navbar')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('components.footer')
    </body>
</html>
