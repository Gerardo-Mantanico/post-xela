<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <title>Laravel</title>


    <!-- component -->
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>

<header class="grid bg-black items-center lg:grid-cols-3 p-6">
    <div class="flex justify-start lg:col-start-1">
        <img src="logo.png" alt="logo" class="w-20"> <!-- Puedes ajustar el tamaño aquí -->
    </div>

    @if (Route::has('login'))
    <nav class="flex justify-end lg:col-start-3 lg:col-end-4">
        @auth
        <a
            href="{{ url('/category') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Dashboard
        </a>
        @else
        <a
            href="{{ route('login') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Log in
        </a>

        @if (Route::has('register'))
        <a
            href="{{ route('register') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Register
        </a>
        @endif
        @endauth
    </nav>
    @endif
</header>

<livewire:post-home-table />

<footer class="py-16 text-center text-sm text-black dark:text-white/70">
    Xela events 0.1
</footer>



</html>