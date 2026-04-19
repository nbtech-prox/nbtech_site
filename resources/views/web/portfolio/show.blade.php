@extends('layouts.app')

@section('title', ($project->meta_title ?: $project->title).' | NBTech')
@section('meta_description', $project->meta_description ?: str($project->description)->limit(150))

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

        $coverSrc = $normalizeMediaUrl($cover);
        $normalizedGalleryItems = $galleryItems
            ->map(fn (array $item) => [
                'src' => $normalizeMediaUrl($item['src'] ?? null),
                'alt' => $item['alt'] ?? ('Imagem do projeto '.$project->title),
            ])
            ->filter(fn (array $item) => filled($item['src']))
            ->values();
    @endphp

    <section class="container-fluid py-20">
        <a href="{{ route('portfolio.index') }}" class="mb-6 inline-flex text-sm font-semibold text-brand-600">← Voltar ao portfólio</a>

        <div class="mb-10 grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-end" data-reveal>
            <div class="max-w-4xl">
            @if ($project->category)
                <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">{{ $project->category }}</p>
            @endif
            <h1 class="font-display text-2xl leading-[1.02] sm:text-3xl md:text-4xl xl:text-[2.35rem]">{{ $project->title }}</h1>
            <p class="mt-4 text-lg text-[#4e576a] dark:text-[#e0e4eb]">{{ $project->description }}</p>
            @if ($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="btn-primary mt-5">Visitar projeto</a>
            @endif
            </div>
            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 shadow-[0_30px_80px_-50px_rgba(15,23,42,0.4)] dark:border-[#2f3b4d] dark:bg-[#111823]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Leitura estratégica</p>
                <p class="mt-4 text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">Este caso existe para mostrar como uma direção técnica e visual bem resolvida pode tornar a presença digital mais clara, mais credível e mais útil para o negócio.</p>
            </article>
        </div>

        <div class="mb-8 grid gap-4 lg:grid-cols-4" data-reveal>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/85 p-5 dark:border-[#373f4e] dark:bg-[#101722]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Categoria</p>
                @if ($project->category)
                    <p class="mt-3 text-sm font-medium text-zinc-900 dark:text-[#f3ede4]">{{ $project->category }}</p>
                @endif
            </article>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/85 p-5 dark:border-[#373f4e] dark:bg-[#101722]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Abordagem</p>
                <p class="mt-3 text-sm font-medium text-zinc-900 dark:text-[#f3ede4]">Clareza, performance e base escalavel</p>
            </article>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/85 p-5 dark:border-[#373f4e] dark:bg-[#101722]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Stack</p>
                <p class="mt-3 text-sm font-medium text-zinc-900 dark:text-[#f3ede4]">{{ collect($project->technologies ?? [])->take(3)->implode(' / ') ?: 'Tecnologia a medida' }}</p>
            </article>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/85 p-5 dark:border-[#373f4e] dark:bg-[#101722]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Objetivo</p>
                <p class="mt-3 text-sm font-medium text-zinc-900 dark:text-[#f3ede4]">Entregar uma experiencia digital mais forte e mais util</p>
            </article>
        </div>

        @if ($coverSrc)
            <div class="mb-8 overflow-hidden rounded-xl border border-[#aeb8c9] bg-[#0a0e15] dark:border-[#4e576a]" data-reveal>
                <img src="{{ $coverSrc }}" alt="Capa do projeto {{ $project->title }}" class="h-[280px] w-full object-cover sm:h-[360px] lg:h-[440px]" loading="lazy">
            </div>
        @endif

        @if ($normalizedGalleryItems->isNotEmpty())
            <div
                class="mt-10"
                x-data="{
                    open: false,
                    activeIndex: 0,
                    items: @js($normalizedGalleryItems),
                    openAt(index) { this.activeIndex = index; this.open = true; },
                    close() { this.open = false; },
                    next() { this.activeIndex = (this.activeIndex + 1) % this.items.length; },
                    prev() { this.activeIndex = (this.activeIndex - 1 + this.items.length) % this.items.length; }
                }"
                @keydown.window.escape="close()"
                @keydown.window.arrow-right="if (open) next()"
                @keydown.window.arrow-left="if (open) prev()"
                data-reveal
            >
                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($normalizedGalleryItems as $item)
                        <button type="button" @click="openAt({{ $loop->index }})" class="group relative overflow-hidden rounded-xl border border-[#aeb8c9] bg-[#0a0e15] text-left dark:border-[#4e576a]" data-reveal aria-label="Abrir imagem {{ $loop->iteration }} da galeria">
                            <img src="{{ $item['src'] }}" alt="{{ $item['alt'] }}" class="h-48 w-full object-cover transition duration-500 group-hover:scale-110 group-hover:brightness-110" loading="lazy">
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#0a0e15]/70 via-transparent to-transparent opacity-80 transition group-hover:opacity-60"></div>
                        </button>
                    @endforeach
                </div>

                <div x-cloak x-show="open" x-transition.opacity.duration.200ms class="fixed inset-0 z-[100] flex items-center justify-center bg-[#0a0e15]/92 p-4" @click.self="close()">
                    <div class="relative w-full max-w-6xl">
                        <button type="button" @click="close()" class="absolute -top-12 right-0 inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/30 bg-white/10 text-white transition hover:bg-white/20" aria-label="Fechar galeria">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                        </button>

                        <div class="overflow-hidden rounded-xl border border-white/15 bg-black/40 shadow-2xl">
                            <img :src="items[activeIndex].src" :alt="items[activeIndex].alt" class="max-h-[78vh] w-full object-contain">
                        </div>

                        <button type="button" @click="prev()" class="absolute left-2 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/30 bg-white/10 text-white transition hover:bg-white/20" aria-label="Imagem anterior">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        </button>

                        <button type="button" @click="next()" class="absolute right-2 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/30 bg-white/10 text-white transition hover:bg-white/20" aria-label="Próxima imagem">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </button>

                        <p class="mt-3 text-center text-xs uppercase tracking-widest text-white/80" x-text="`${activeIndex + 1} / ${items.length}`"></p>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-10 rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]" data-reveal>
            <h2 class="mb-4 text-xl font-semibold">Tecnologias utilizadas</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($project->technologies ?? [] as $technology)
                    <span class="rounded-full bg-brand-100 px-3 py-1 text-xs font-semibold text-brand-800 dark:bg-brand-900/40 dark:text-brand-300">{{ $technology }}</span>
                @endforeach
            </div>
        </div>

        <div class="mt-8 grid gap-5 lg:grid-cols-2" data-reveal>
            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-8">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Leitura rapida</p>
                <h2 class="mt-3 font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">O que este projeto demonstra</h2>
                <ul class="mt-5 space-y-3 text-sm text-[#4e576a] dark:text-[#e0e4eb]">
                    <li class="rounded-xl border border-[#c8d0dd] bg-white px-4 py-3 dark:border-[#334053] dark:bg-[#171e2a]">Capacidade de transformar necessidade em estrutura digital concreta</li>
                    <li class="rounded-xl border border-[#c8d0dd] bg-white px-4 py-3 dark:border-[#334053] dark:bg-[#171e2a]">Atencao a identidade, experiencia e consistencia tecnica</li>
                    <li class="rounded-xl border border-[#c8d0dd] bg-white px-4 py-3 dark:border-[#334053] dark:bg-[#171e2a]">Execucao pensada para evoluir e nao apenas para "entregar e sair"</li>
                </ul>
            </article>
            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-8">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Aplicacao pratica</p>
                <h2 class="mt-3 font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">Se tens um desafio parecido</h2>
                <p class="mt-4 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Podemos ajudar-te a estruturar o projeto, identificar a prioridade certa e definir uma execucao com mais impacto desde o inicio.</p>
                <a href="{{ route('budget.index') }}" class="btn-primary mt-5">Falar sobre o meu projeto</a>
            </article>
        </div>

        <div class="mt-10 rounded-[2rem] border border-[#cad4e3] bg-white/90 p-7 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-10" data-reveal>
            <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr] lg:items-end">
                <div>
                    <span class="chip-brand">Próximo passo</span>
                    <h2 class="mt-4 font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">Se tens um desafio parecido, o melhor ponto de partida é uma conversa com direção.</h2>
                </div>
                <div class="space-y-4">
                    <p class="text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">Podemos ajudar-te a clarificar objetivo, prioridade e abordagem antes da execução, para avançares com menos ruído e mais impacto.</p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('budget.index') }}" class="btn-primary">Pedir orcamento</a>
                        <a href="{{ route('contact.index') }}" class="btn-secondary">Falar connosco</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
