<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeSwitcher" x-init="init" :data-theme="mode">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin | NBTech')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-ui bg-[#f0f1f5] dark:bg-[#0a0e15]">
    <div
        class="grid min-h-screen lg:[grid-template-columns:var(--admin-sidebar-width)_1fr]"
        x-data="{ sidebarCollapsed: JSON.parse(localStorage.getItem('nbtech-admin-sidebar-collapsed') ?? 'false'), mobileMenuOpen: false }"
        x-init="$watch('sidebarCollapsed', value => localStorage.setItem('nbtech-admin-sidebar-collapsed', JSON.stringify(value)))"
        style="--admin-sidebar-width: 290px"
        :style="`--admin-sidebar-width:${sidebarCollapsed ? '84px' : '290px'}`"
    >
        <aside class="hidden flex-col border-r border-[#aeb8c9] bg-white p-4 dark:border-[#373f4e] dark:bg-[#212631] lg:flex">
            <div
                class="mb-8 border-b border-[#b8c1cf] pb-4 dark:border-[#373f4e]"
                :class="sidebarCollapsed ? 'flex flex-col items-center gap-3' : 'flex items-start justify-between gap-2'"
            >
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" :class="sidebarCollapsed ? 'justify-center' : ''">
                    <picture>
                        <source srcset="/branding/logo/logo-clean.webp" type="image/webp">
                        <img
                            src="/branding/logo/logo-clean.png"
                            alt="NBTech"
                            class="object-contain shadow-sm"
                            :class="sidebarCollapsed ? 'h-10 w-10' : 'h-14 w-14'"
                        >
                    </picture>
                    <div class="w-max leading-tight" x-cloak x-show="!sidebarCollapsed" x-transition.opacity.duration.150ms>
                        <p class="brand-wordmark flex w-full items-center justify-between text-3xl text-[#0a0e15] dark:text-white" aria-label="NBTech">
                            <span class="font-extrabold">N</span><span class="font-extrabold">B</span><span class="font-medium">T</span><span class="font-medium">e</span><span class="font-medium">c</span><span class="font-medium">h</span>
                        </p>
                        <p class="-mt-0.5 whitespace-nowrap text-[10px] font-semibold uppercase tracking-[0.13em] text-[#4e576a] dark:text-[#bfc6d4]">Soluções à sua medida</p>
                    </div>
                </a>
            </div>
            <nav class="space-y-2 text-sm font-medium" :class="sidebarCollapsed ? 'mt-1' : ''">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" :class="sidebarCollapsed ? 'justify-center' : ''" title="Dashboard">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V20h14V9.5"/><path d="M10 20v-5h4v5"/></svg>
                    <span x-cloak x-show="!sidebarCollapsed" x-transition.opacity.duration.120ms>Dashboard</span>
                </a>
                <a href="{{ route('admin.projects.index') }}" class="admin-nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" :class="sidebarCollapsed ? 'justify-center' : ''" title="Projetos">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7.5A2.5 2.5 0 0 1 5.5 5h4L11 7h7.5A2.5 2.5 0 0 1 21 9.5v9A2.5 2.5 0 0 1 18.5 21h-13A2.5 2.5 0 0 1 3 18.5z"/></svg>
                    <span x-cloak x-show="!sidebarCollapsed" x-transition.opacity.duration.120ms>Projetos</span>
                </a>
                <a href="{{ route('admin.quotes.index') }}" class="admin-nav-link {{ request()->routeIs('admin.quotes.*') ? 'active' : '' }}" :class="sidebarCollapsed ? 'justify-center' : ''" title="Orçamentos">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h8"/><path d="M5 7h14"/><rect x="4" y="7" width="16" height="14" rx="2"/><path d="M8 12h8M8 16h5"/></svg>
                    <span x-cloak x-show="!sidebarCollapsed" x-transition.opacity.duration.120ms>Orçamentos</span>
                </a>
                <a href="{{ route('admin.services.index') }}" class="admin-nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" :class="sidebarCollapsed ? 'justify-center' : ''" title="Serviços">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="7" height="7" rx="1.5"/><rect x="13" y="4" width="7" height="7" rx="1.5"/><rect x="4" y="13" width="7" height="7" rx="1.5"/><rect x="13" y="13" width="7" height="7" rx="1.5"/></svg>
                    <span x-cloak x-show="!sidebarCollapsed" x-transition.opacity.duration.120ms>Serviços</span>
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="admin-nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" :class="sidebarCollapsed ? 'justify-center' : ''" title="Testemunhos">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 10h8"/><path d="M8 14h5"/><path d="M5 5h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-4l-3 3-3-3H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z"/></svg>
                    <span x-cloak x-show="!sidebarCollapsed" x-transition.opacity.duration.120ms>Testemunhos</span>
                </a>
                <a href="{{ route('admin.messages.index') }}" class="admin-nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" :class="sidebarCollapsed ? 'justify-center' : ''" title="Mensagens">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg>
                    <span x-cloak x-show="!sidebarCollapsed" x-transition.opacity.duration.120ms>Mensagens</span>
                </a>
            </nav>

            <div class="mt-auto border-t border-[#b8c1cf] pt-4 dark:border-[#373f4e]" :class="sidebarCollapsed ? 'flex justify-center' : 'flex justify-end'">
                <button
                    type="button"
                    class="rounded-lg border border-brand-600 bg-brand-50/70 p-1.5 text-brand-700 transition hover:bg-brand-100 dark:border-brand-500 dark:bg-brand-900/30 dark:text-brand-300 dark:hover:bg-brand-900/45"
                    :class="sidebarCollapsed ? 'rounded-full p-2 shadow-[0_0_0_2px_rgba(37,99,235,0.18)]' : ''"
                    @click="sidebarCollapsed = !sidebarCollapsed"
                    :title="sidebarCollapsed ? 'Expandir sidebar' : 'Recolher sidebar'"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path x-show="!sidebarCollapsed" d="m15 18-6-6 6-6" />
                        <path x-show="sidebarCollapsed" d="m9 18 6-6-6-6" />
                    </svg>
                </button>
            </div>
        </aside>

        <div>
            <header class="sticky top-0 z-30 border-b border-[#aeb8c9] bg-white/90 px-4 py-3 backdrop-blur dark:border-[#373f4e] dark:bg-[#212631]/95 sm:px-6 lg:px-10">
                <div class="flex items-center justify-between gap-3">
                    <h1 class="font-display text-3xl leading-none sm:text-4xl lg:text-5xl">@yield('heading', 'Dashboard')</h1>
                    <div class="flex items-center gap-2 sm:gap-3">
                        <button
                            type="button"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-[#a8b3c6] text-[#212631] transition hover:bg-[#e0e4eb] dark:border-[#4e576a] dark:text-[#e0e4eb] dark:hover:bg-[#2a3140] lg:hidden"
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            :aria-expanded="mobileMenuOpen"
                            aria-label="Alternar navegação"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 7h16M4 12h16M4 17h16" x-show="!mobileMenuOpen" />
                                <path d="M6 6l12 12M18 6 6 18" x-show="mobileMenuOpen" />
                            </svg>
                        </button>
                        @include('partials.theme-toggle')
                        <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                            @csrf
                            <button type="submit" class="btn-secondary">Terminar sessão</button>
                        </form>
                    </div>
                </div>

                <div x-show="mobileMenuOpen" x-transition.opacity class="mt-3 space-y-2 rounded-xl border border-[#b8c1cf] bg-white p-3 text-sm dark:border-[#4e576a] dark:bg-[#212631] lg:hidden">
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.projects.index') }}" class="admin-nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">Projetos</a>
                    <a href="{{ route('admin.quotes.index') }}" class="admin-nav-link {{ request()->routeIs('admin.quotes.*') ? 'active' : '' }}">Orçamentos</a>
                    <a href="{{ route('admin.services.index') }}" class="admin-nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">Serviços</a>
                    <a href="{{ route('admin.testimonials.index') }}" class="admin-nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">Testemunhos</a>
                    <a href="{{ route('admin.messages.index') }}" class="admin-nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">Mensagens</a>
                    <form method="POST" action="{{ route('logout') }}" class="pt-1">
                        @csrf
                        <button type="submit" class="btn-secondary w-full">Terminar sessão</button>
                    </form>
                </div>
            </header>

            <main class="px-4 py-5 sm:px-6 sm:py-6 lg:px-10 lg:py-7">
                @if (session('status'))
                    <div class="mb-6 rounded-xl border border-emerald-300 bg-emerald-50 p-3 text-sm text-emerald-700 dark:border-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
