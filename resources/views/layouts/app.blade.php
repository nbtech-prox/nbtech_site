<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeSwitcher" x-init="init" :data-theme="mode">
<head>
    @php
        $metaTitle = trim($__env->yieldContent('meta_title', $__env->yieldContent('title', 'NBTech')));
        $metaDescription = trim($__env->yieldContent('meta_description', 'NBTech desenvolve websites, aplicações web, mobile apps, plataformas digitais e automação.'));
        $canonicalUrl = trim($__env->yieldContent('canonical', url()->current()));
        $ogType = trim($__env->yieldContent('og_type', 'website'));
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    @hasSection('schema_json_ld')
        <script type="application/ld+json">
            @yield('schema_json_ld')
        </script>
    @endif
    <title>{{ $metaTitle }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[radial-gradient(circle_at_top_left,_rgba(220,228,241,0.7),_transparent_32%),linear-gradient(180deg,_#f7f9fc_0%,_#eef2f8_100%)] dark:bg-[radial-gradient(circle_at_top_left,_rgba(32,46,68,0.55),_transparent_28%),linear-gradient(180deg,_#0a0e15_0%,_#111722_100%)]">
    <div class="relative min-h-screen overflow-x-hidden">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[120] focus:rounded-lg focus:bg-brand-600 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-white">
            Saltar para o conteúdo
        </a>
        <div class="border-b border-[#dbe2ee] bg-white/80 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#526076] backdrop-blur dark:border-[#243041] dark:bg-[#0d1320]/88 dark:text-[#bfc8d6]">
            <div class="container-fluid flex min-h-11 flex-wrap items-center justify-between gap-3 py-2">
                <span>NBTech · websites, plataformas e automação com foco em resultado</span>
                <a href="{{ route('budget.index') }}" class="transition hover:text-brand-600 dark:hover:text-brand-300">Pedir avaliação inicial</a>
            </div>
        </div>
        <header x-data="{ mobileOpen: false }" class="fixed inset-x-0 top-0 z-50 border-b border-[#dbe2ee] bg-white/84 backdrop-blur dark:border-[#2f3b4d] dark:bg-[#0b121d]/88">
            <div class="container-fluid flex h-20 items-center justify-between gap-5 py-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <picture>
                        <source srcset="/branding/logo/logo-clean.webp" type="image/webp">
                        <img src="/branding/logo/logo-clean.png" alt="NBTech" class="h-14 w-14 rounded-full object-contain shadow-sm ring-1 ring-black/5 dark:ring-white/10">
                    </picture>
                    <div class="w-max leading-tight">
                        <p class="brand-wordmark flex w-full items-center justify-between text-3xl text-[#0a0e15] dark:text-white" aria-label="NBTech">
                            <span class="font-extrabold">N</span><span class="font-extrabold">B</span><span class="font-medium">T</span><span class="font-medium">e</span><span class="font-medium">c</span><span class="font-medium">h</span>
                        </p>
                        <p class="-mt-0.5 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#5a6579] dark:text-[#bfc6d4]">Soluções à sua medida</p>
                    </div>
                </a>

                <div class="flex items-center gap-2 lg:hidden">
                    <button type="button" @click="mobileOpen = !mobileOpen" aria-label="Abrir menu" class="rounded-lg border border-[#a8b3c6] px-2 py-1 text-xs dark:border-[#4e576a] dark:text-[#e0e4eb]">
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
                    <a href="{{ route('budget.index') }}" class="btn-primary">Pedir orcamento</a>
                    @include('partials.theme-toggle')
                </nav>
            </div>
            <nav x-cloak x-show="mobileOpen" x-transition.opacity class="container-fluid space-y-2 pb-4 text-xs font-semibold uppercase tracking-wide text-[#212631] dark:text-[#e0e4eb] lg:hidden">
                <a href="{{ route('home') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('home') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Início</a>
                <a href="{{ route('about') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('about') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Sobre</a>
                <a href="{{ route('services.index') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('services.*') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Serviços</a>
                <a href="{{ route('portfolio.index') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('portfolio.*') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Portfólio</a>
                <a href="{{ route('contact.index') }}" class="block rounded-lg border px-3 py-2 {{ request()->routeIs('contact.*') ? 'border-brand-400 bg-brand-50 text-brand-700 dark:border-brand-500 dark:bg-brand-900/20 dark:text-brand-300' : 'border-[#9ea9bc] dark:border-[#4e576a] dark:bg-[#212631]' }}">Contacto</a>
                <a href="{{ route('budget.index') }}" class="btn-primary w-full text-center">Pedir orcamento</a>
            </nav>
        </header>

        <main id="main-content" class="pt-20">
            @yield('content')
        </main>

        <footer class="mt-8 border-t border-[#dbe2ee] bg-white/55 py-12 backdrop-blur dark:border-[#2f3b4d] dark:bg-[#0d121b]/60">
            <div class="container-fluid grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                <div class="space-y-4 text-sm text-[#4e576a] dark:text-[#d7deea]">
                    <div>
                        <p class="brand-wordmark text-3xl text-[#0a0e15] dark:text-white">NBTech</p>
                        <p class="mt-1 max-w-xl leading-7">Construímos websites, plataformas, apps e automações com foco em clareza comercial, execução técnica e crescimento sustentável.</p>
                    </div>
                    <p class="text-xs uppercase tracking-[0.16em] text-[#697488] dark:text-[#aeb8c9]">&copy; {{ now()->year }} NBTech. Engenharia digital com foco em resultado.</p>
                </div>
                <div class="grid gap-6 text-sm text-[#4e576a] dark:text-[#d7deea] sm:grid-cols-2 lg:justify-self-end">
                    <div class="space-y-3">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Navegação</p>
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('services.index') }}" class="hover:text-brand-600">Serviços</a>
                            <a href="{{ route('portfolio.index') }}" class="hover:text-brand-600">Portfólio</a>
                            <a href="{{ route('about') }}" class="hover:text-brand-600">Sobre</a>
                            <a href="{{ route('legal.privacy') }}" class="hover:text-brand-600">Política de Privacidade</a>
                            <a href="{{ route('legal.cookies') }}" class="hover:text-brand-600">Política de Cookies</a>
                            <a href="{{ route('legal.terms') }}" class="hover:text-brand-600">Termos e Condições</a>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Contacto</p>
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('contact.index') }}" class="hover:text-brand-600">Contacto geral</a>
                            <a href="{{ route('budget.index') }}" class="hover:text-brand-600">Pedir orçamento</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
