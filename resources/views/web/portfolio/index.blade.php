@extends('layouts.app')

@section('title', 'Portfólio | NBTech')
@section('meta_description', 'Explora projetos digitais da NBTech: websites, plataformas, ecommerce e soluções web construídas com foco em impacto, clareza e execução sólida.')

@section('content')
    <section class="container-fluid py-20">
        <div class="mb-12 grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-end" data-reveal>
            <div class="space-y-5">
                <span class="chip-brand">Portfólio</span>
                <h1 class="font-display text-2xl leading-[1.02] sm:text-3xl md:text-4xl xl:text-[2.35rem]">Projetos pensados para resolver problemas reais, não apenas para parecer bem.</h1>
                <p class="max-w-4xl text-lg leading-8 text-[#4e576a] dark:text-[#e0e4eb]">Aqui vês exemplos de execução com critério técnico, identidade visual e foco comercial. O objetivo não é mostrar peças soltas, mas capacidade de transformar contexto em resultado digital sólido.</p>
            </div>
            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 shadow-[0_30px_80px_-50px_rgba(15,23,42,0.4)] dark:border-[#2f3b4d] dark:bg-[#111823]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">O que procuramos mostrar</p>
                <ul class="mt-5 space-y-3 text-sm text-[#4e576a] dark:text-[#d7deea]">
                    <li class="rounded-xl border border-[#d6deea] bg-[#f8fbff] px-4 py-3 dark:border-[#334053] dark:bg-[#151d29]">Clareza entre problema, solução e experiência</li>
                    <li class="rounded-xl border border-[#d6deea] bg-[#f8fbff] px-4 py-3 dark:border-[#334053] dark:bg-[#151d29]">Execução que suporta crescimento e evolução</li>
                    <li class="rounded-xl border border-[#d6deea] bg-[#f8fbff] px-4 py-3 dark:border-[#334053] dark:bg-[#151d29]">Projetos que ajudam a vender, operar ou posicionar melhor</li>
                </ul>
            </article>
        </div>

        <div class="mb-10 grid gap-4 lg:grid-cols-3" data-reveal>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/85 p-5 dark:border-[#373f4e] dark:bg-[#101722]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Websites</p>
                <p class="mt-3 text-sm text-[#4e576a] dark:text-[#dce3ee]">Paginas e estruturas desenhadas para apresentar melhor a proposta de valor e converter interesse em contacto.</p>
            </article>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/85 p-5 dark:border-[#373f4e] dark:bg-[#101722]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Plataformas</p>
                <p class="mt-3 text-sm text-[#4e576a] dark:text-[#dce3ee]">Solucoes a medida para centralizar operacoes, melhorar fluxos e criar uma base tecnica mais forte.</p>
            </article>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/85 p-5 dark:border-[#373f4e] dark:bg-[#101722]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Execucao</p>
                <p class="mt-3 text-sm text-[#4e576a] dark:text-[#dce3ee]">Projetos pensados com criterio tecnico, identidade visual e prioridade no que gera resultado real.</p>
            </article>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($projects as $project)
                @php
                    $coverUrl = $project->previewCoverUrl();
                    $coverHost = $coverUrl ? parse_url($coverUrl, PHP_URL_HOST) : null;
                    $coverPath = $coverUrl ? parse_url($coverUrl, PHP_URL_PATH) : null;
                    $resolvedCover = in_array($coverHost, ['localhost', '127.0.0.1'], true) && $coverPath
                        ? $coverPath
                        : $coverUrl;
                    $imageSrc = $resolvedCover ?: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80';
                    $mediaVersion = $project->getFirstMedia('cover')?->updated_at?->timestamp
                        ?? $project->updated_at?->timestamp
                        ?? now()->timestamp;
                    $imageSrcVersioned = $imageSrc.(str_contains($imageSrc, '?') ? '&' : '?').'v='.$mediaVersion;
                @endphp
                <article class="group relative overflow-hidden rounded-[1.6rem] border border-[#b8c1cf] bg-[#0a0e15] text-white dark:border-[#4e576a] dark:bg-[#212631]" data-reveal>
                    <img src="{{ $imageSrcVersioned }}" alt="{{ $project->title }}" class="h-72 w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                    <div class="absolute inset-0 bg-[#0a0e15]/72 opacity-95 transition group-hover:opacity-100"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        @if ($project->category)
                            <p class="mb-2 text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-300">{{ $project->category }}</p>
                        @endif
                        <h2 class="text-xl font-semibold">{{ $project->title }}</h2>
                        <p class="mt-1 text-xs text-zinc-200">{{ implode(' · ', $project->technologies ?? []) }}</p>
                        <a href="{{ route('portfolio.show', $project) }}" class="mt-3 inline-flex rounded-lg bg-white/15 px-3 py-1.5 text-xs font-semibold transition hover:bg-white/25">Abrir caso</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-10">{{ $projects->links() }}</div>

        <div class="mt-14 rounded-[2rem] border border-[#cad4e3] bg-white/90 p-7 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-10" data-reveal>
            <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr] lg:items-end">
                <div>
                    <span class="chip-brand">Próximo passo</span>
                    <h2 class="mt-4 font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">Se queres um projeto com este nível de exigência, começamos pelo teu contexto.</h2>
                </div>
                <div class="space-y-4">
                    <p class="text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">Partilha o objetivo, o estado atual e a urgência. A NBTech ajuda-te a perceber a prioridade certa e o caminho mais forte para avançar.</p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('budget.index') }}" class="btn-primary mt-1">Pedir orcamento</a>
                        <a href="{{ route('contact.index') }}" class="btn-secondary mt-1">Falar connosco</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
