@extends('layouts.app')

@section('title', 'NBTech | Websites, Apps e Plataformas Digitais')
@section('meta_description', 'Desenvolvemos websites, aplicações web e mobile, plataformas digitais e automação para escalar o teu negócio.')

@section('content')
    @php
        $normalizeMediaUrl = static function (?string $url): ?string {
            if (! $url) {
                return null;
            }

            $host = parse_url($url, PHP_URL_HOST);
            $path = parse_url($url, PHP_URL_PATH);

            if (in_array($host, ['localhost', '127.0.0.1'], true) && $path) {
                return $path;
            }

            return $url;
        };
    @endphp

    <section class="container-fluid py-20 md:py-28">
        <div class="grid items-center gap-12 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-7" data-reveal>
                <span class="chip-brand">Digital Product Engineering</span>
                <h1 class="font-display text-5xl leading-[0.95] text-zinc-900 dark:text-[#f3ede4] md:text-6xl">
                    <span class="block md:whitespace-nowrap">Transformamos ideias em</span>
                    <span class="block md:whitespace-nowrap">resultados digitais reais.</span>
                </h1>
                <p class="max-w-2xl text-lg text-[#4e576a] dark:text-[#e0e4eb]">Na NBTech, criamos websites, aplicações web e mobile, plataformas à medida e automações inteligentes para empresas que querem crescer mais rápido. Unimos estratégia, design e tecnologia para entregar soluções rápidas, escaláveis e orientadas a conversão.</p>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('contact.index') }}" class="btn-primary">Iniciar Projeto</a>
                    <a href="{{ route('portfolio.index') }}" class="btn-secondary">Ver Trabalhos</a>
                </div>
            </div>
            <div class="panel relative p-8" data-reveal>
                <h2 class="mb-6 text-sm font-semibold uppercase tracking-widest text-zinc-500">O que entregamos</h2>
                <div class="grid gap-4">
                    @foreach (['Websites', 'Aplicações Web', 'Mobile Apps', 'Plataformas Digitais', 'Automação de Processos'] as $item)
                        <div class="rounded-xl border-[1.5px] border-[#aeb8c9] bg-white p-4 text-sm font-medium dark:border-[#586176] dark:bg-[#212631] dark:text-[#ffffff]">{{ $item }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid py-20">
        <div class="mb-8 flex items-end justify-between" data-reveal>
            <div class="space-y-5">
                <span class="chip-brand">Serviços</span>
                <h2 class="font-display text-6xl">Especialização técnica completa</h2>
            </div>
            <a href="{{ route('services.index') }}" class="btn-secondary">Explorar serviços</a>
        </div>
        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($services as $service)
                @php
                    $serviceImage = $normalizeMediaUrl($service->image_url);
                @endphp
                <article class="panel p-6 transition-transform duration-200 hover:-translate-y-0.5" data-reveal>
                    @if ($serviceImage)
                        <div class="mb-4 overflow-hidden rounded-lg border border-[#aeb8c9] dark:border-[#4e576a]">
                            <img src="{{ $serviceImage }}" alt="Imagem relacionada com {{ $service->title }}" class="h-36 w-full object-cover" loading="lazy">
                        </div>
                    @endif
                    <h3 class="mb-2 text-xl font-semibold">{{ $service->title }}</h3>
                    <p class="text-sm text-[#4e576a] dark:text-[#e0e4eb]">{{ $service->description }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="container-fluid py-20">
        <div class="mb-8 flex items-end justify-between" data-reveal>
            <div class="space-y-5">
                <span class="chip-brand">Portfólio</span>
                <h2 class="font-display text-6xl">Projetos em destaque</h2>
            </div>
            <a href="{{ route('portfolio.index') }}" class="btn-secondary">Todos os projetos</a>
        </div>
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($featuredProjects as $project)
                @php
                    $coverUrl = $project->previewCoverUrl();
                    $coverHost = $coverUrl ? parse_url($coverUrl, PHP_URL_HOST) : null;
                    $coverPath = $coverUrl ? parse_url($coverUrl, PHP_URL_PATH) : null;
                    $resolvedCover = in_array($coverHost, ['localhost', '127.0.0.1'], true) && $coverPath
                        ? $coverPath
                        : $coverUrl;
                    $imageSrc = $resolvedCover ?: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80';
                    $mediaVersion = $project->getFirstMedia('cover')?->updated_at?->timestamp
                        ?? $project->updated_at?->timestamp
                        ?? now()->timestamp;
                    $imageSrcVersioned = $imageSrc.(str_contains($imageSrc, '?') ? '&' : '?').'v='.$mediaVersion;
                @endphp
                <article class="group relative overflow-hidden rounded-lg border border-[#b8c1cf] bg-[#0a0e15] text-white dark:border-[#4e576a] dark:bg-[#212631]" data-reveal>
                    <img src="{{ $imageSrcVersioned }}" alt="{{ $project->title }}" class="h-72 w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                    <div class="absolute inset-0 bg-[#0a0e15]/72"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <h3 class="text-xl font-semibold">{{ $project->title }}</h3>
                        <p class="mt-1 text-xs text-zinc-200">{{ implode(' · ', $project->technologies ?? []) }}</p>
                        <a href="{{ route('portfolio.show', $project) }}" class="mt-4 inline-flex rounded-lg bg-white/15 px-3 py-1.5 text-xs font-semibold hover:bg-white/25">Ver projeto</a>
                    </div>
                </article>
            @empty
                <p class="text-sm text-[#4e576a] dark:text-[#e0e4eb]">Sem projetos em destaque ainda.</p>
            @endforelse
        </div>
    </section>

    <section class="container-fluid py-20">
        <div class="panel p-8 md:p-12" data-reveal>
            <h2 class="font-display text-6xl">Pronto para acelerar o teu produto digital?</h2>
            <p class="mt-4 max-w-2xl text-[#4e576a] dark:text-[#e0e4eb]">Falamos sobre objetivos, prazo e orçamento para desenhar uma solução feita à medida.</p>
            <a href="{{ route('contact.index') }}" class="btn-primary mt-6">Falar com a NBTech</a>
        </div>
    </section>
@endsection
