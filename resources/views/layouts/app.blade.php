<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laraberg CMS') }}</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS (Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Laraberg Styles --}}
    <!-- @larabergStyles -->
</head>

<body class="bg-gradient-to-br from-slate-50 via-gray-100 to-slate-200 text-gray-800 font-[Inter] antialiased">

    {{-- ===== Top Navigation ===== --}}
    <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            {{-- Logo / Title --}}
            <h1 class="text-2xl font-bold tracking-tight text-indigo-600">
                Laraberg CMS
            </h1>

            {{-- Navigation Links --}}
            <nav class="flex items-center gap-4">

                <a href="{{ route('posts.index') }}"
                   class="text-gray-600 hover:text-indigo-600 font-medium transition">
                    Posts
                </a>

                <a href="{{ route('posts.create') }}"
                   class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl shadow-md
                          hover:bg-indigo-700 hover:shadow-lg transition-all duration-200">
                    + New Post
                </a>
            </nav>
        </div>
    </header>

    {{-- ===== Page Content ===== --}}
    <main class="max-w-7xl mx-auto px-6 py-10">

        {{-- Glass Card Container --}}
        <div class="bg-white/90 backdrop-blur-md border border-gray-200
                    rounded-3xl shadow-xl p-8 min-h-[70vh]">

            @yield('content')

        </div>
    </main>

    {{-- ===== Footer ===== --}}
    <footer class="text-center text-sm text-gray-500 py-8">
        © {{ date('Y') }} Laraberg Laravel 12 — Crafted with ❤️ for modern CMS
    </footer>

    {{-- Laraberg Scripts --}}
    <!-- @larabergScripts -->

</body>
</html>
