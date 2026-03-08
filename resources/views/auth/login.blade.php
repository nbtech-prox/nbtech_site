<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeSwitcher" x-init="init" :data-theme="mode">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entrar | NBTech Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f0f1f5] dark:bg-[#0a0e15]">
    <div class="mx-auto flex min-h-screen w-full max-w-6xl items-center px-6 py-12">
        <div class="grid w-full gap-10 lg:grid-cols-2">
            <div class="space-y-5" data-reveal>
                <picture>
                    <source srcset="/branding/logo/logo-clean.webp" type="image/webp">
                    <img src="/branding/logo/logo-clean.png" alt="NBTech" class="h-16 w-16 object-contain shadow-sm">
                </picture>
                <h1 class="font-display text-7xl leading-none text-[#0a0e15] dark:text-white">Painel Admin</h1>
                <p class="text-[#4e576a] dark:text-[#e0e4eb]">Acede ao dashboard de gestão de conteúdos e oportunidades da NBTech.</p>
                @include('partials.theme-toggle')
            </div>

            <div class="panel p-8" data-reveal>
                <h2 class="mb-6 text-xl font-semibold">Autenticação</h2>

                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-rose-300 bg-rose-50 p-3 text-sm text-rose-700 dark:border-rose-700/70 dark:bg-rose-950/30 dark:text-rose-200">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium">Email</label>
                        <input id="email" name="email" type="email" required autofocus class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631] dark:text-[#ffffff]" value="{{ old('email') }}">
                    </div>
                    <div>
                        <label for="password" class="mb-1 block text-sm font-medium">Password</label>
                        <input id="password" name="password" type="password" required class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631] dark:text-[#ffffff]">
                    </div>
                    <label class="flex items-center gap-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">
                        <input type="checkbox" name="remember" class="rounded border-[#9ea9bc]">
                        Manter sessão iniciada
                    </label>
                    <button class="btn-primary w-full" type="submit">Entrar no Admin</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
