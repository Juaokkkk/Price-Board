<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
>

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

@livewireStyles

<script>
    if (
        localStorage.theme === 'dark' ||
        (!('theme' in localStorage) &&
        window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    }
</script>

</head>

<body class="bg-gray-100 dark:bg-slate-950 transition-colors">

<button
    id="toggle-theme"
    class="fixed top-5 right-5 z-50 flex items-center justify-center
           w-12 h-12 rounded-xl
           bg-white dark:bg-slate-800
           text-slate-700 dark:text-slate-200
           shadow-lg
           border border-slate-200 dark:border-slate-700
           transition"
>
    <span
        id="theme-icon"
        class="material-symbols-outlined"
    >
        dark_mode
    </span>
</button>

<div class="font-sans text-gray-900 dark:text-white antialiased">
    {{ $slot }}
</div>

@livewireScripts

<script>

    const botaoTema = document.getElementById('toggle-theme');
    const icon = document.getElementById('theme-icon');

    function atualizarIcone() {

        if (document.documentElement.classList.contains('dark')) {

            icon.textContent = 'wb_sunny';

        } else {

            icon.textContent = 'dark_mode';

        }
    }

    atualizarIcone();

    botaoTema.addEventListener('click', () => {

        document.documentElement.classList.toggle('dark');

        if (document.documentElement.classList.contains('dark')) {

            localStorage.theme = 'dark';

        } else {

            localStorage.theme = 'light';

        }

        atualizarIcone();

    });

</script>
</body>
</html>
