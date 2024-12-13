<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name') }}</title>
        @vite(['resources/css/app.css'])
    </head>

    <body class="flex flex-col justify-between min-h-screen antialiased text-white border-t-2 border-purple-600 min-w-screen bg-gray-950">
        <header class="px-8 py-4">
            <div class="flex items-baseline justify-between">
                <div class="flex items-center">
                    <a href="/" class="text-3xl font-bold">{{ __('Pokémon') }}<span class="text-red-500">{{ __('Vote') }}</span> </a>
                </div>
                <nav class="flex flex-row items-center gap-8">
                    <a href="/results" class="text-lg hover:underline">
					    {{ __('Results') }}
                    </a>
                </nav>
            </div>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="py-3 font-light text-center text-gray-500">
            <a href="https://github.com/henryleeworld/laravel-livewire-pokemon-vote" target="_blank" rel="noopener noreferrer">
                {{ __('GitHub') }}
            </a>
        </footer>
        @vite(['resources/js/app.js'])
    </body>
</html>
