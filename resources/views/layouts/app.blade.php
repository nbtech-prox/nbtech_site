<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeSwitcher" x-init="init" :data-theme="mode">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'NBTech desenvolve websites, aplicações web, mobile apps, plataformas digitais e automação.')">
    <title>@yield('title', 'NBTech')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="relative min-h-screen overflow-x-hidden">
        <header x-data="{ mobileOpen: false }" class="fixed inset-x-0 top-0 z-50 border-b border-[#b8c1cf] bg-white dark:border-[#373f4e] dark:bg-[#0a0e15]">
            <div class="container-fluid flex h-18 items-center justify-between gap-4 py-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <picture>
                        <source srcset="/branding/logo/logo-clean.webp" type="image/webp">
                        <img src="/branding/logo/logo-clean.png" alt="NBTech" class="h-14 w-14 object-contain shadow-sm">
                    </picture>
                    <div class="w-max leading-tight">
                        <p class="brand-wordmark flex w-full items-center justify-between text-3xl text-[#0a0e15] dark:text-white" aria-label="NBTech">
                            <span class="font-extrabold">N</span><span class="font-extrabold">B</span><span class="font-medium">T</span><span class="font-medium">e</span><span class="font-medium">c</span><span class="font-medium">h</span>
                        </p>
                        <p class="-mt-0.5 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#4e576a] dark:text-[#bfc6d4]">Soluções à sua medida</p>
                    </div>
                </a>

                <div class="flex items-center gap-2 lg:hidden">
                    <button type="button" @click="mobileOpen = !mobileOpen" class="rounded-lg border border-[#a8b3c6] px-2 py-1 text-xs dark:border-[#4e576a] dark:text-[#e0e4eb]">
                        Menu
                    </button>
                    @include('partials.theme-toggle')
                </div>

                <nav class="hidden items-center gap-7 text-sm font-medium text-[#212631] dark:text-[#e0e4eb] lg:flex">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-brand-700 dark:text-brand-300' : 'hover:text-brand-600' }}">Início</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-brand-700 dark:text-brand-300' : 'hover:text-brand-600' }}">Sobre</a>
                    <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'text-brand-700 dark:text-brand-300' : 'hover:text-brand-600' }}">Serviços</a>
                    <a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'text-brand-700 dark:text-brand-300' : 'hover:text-brand-600' }}">Portfólio</a>
                    <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'text-brand-700 dark:text-brand-300' : 'hover:text-brand-600' }}">Contacto</a>
                    <a href="{{ route('contact.index') }}" class="btn-primary">Iniciar Projeto</a>
                    @include('partials.theme-toggle')
                </nav>
            </div>
            <nav x-cloak x-show="mobileOpen" x-transition.opacity class="container-fluid space-y-2 pb-4 text-xs font-semibold uppercase tracking-wide text-[#212631] dark:text-[#e0e4eb] lg:hidden">
                <a href="{{ route('home') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('home') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Início</a>
                <a href="{{ route('about') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('about') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Sobre</a>
                <a href="{{ route('services.index') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('services.*') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Serviços</a>
                <a href="{{ route('portfolio.index') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('portfolio.*') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Portfólio</a>
                <a href="{{ route('contact.index') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('contact.*') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Contacto</a>
                <a href="{{ route('contact.index') }}" class="btn-primary w-full text-center">Iniciar Projeto</a>
            </nav>
        </header>

        <main class="pt-24">
            @yield('content')
        </main>

        <footer class="border-t border-[#b8c1cf] py-10 dark:border-[#373f4e]">
            <div class="container-fluid flex flex-col gap-5 text-sm text-[#4e576a] md:flex-row md:items-center md:justify-between dark:text-[#e0e4eb]">
                <p>&copy; {{ now()->year }} NBTech. Engenharia digital com foco em resultado.</p>
                <div class="flex items-center gap-5">
                    <a href="{{ route('services.index') }}" class="hover:text-brand-600">Serviços</a>
                    <a href="{{ route('portfolio.index') }}" class="hover:text-brand-600">Portfólio</a>
                    <a href="{{ route('contact.index') }}" class="hover:text-brand-600">Contacto</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
