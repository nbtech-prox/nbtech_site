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

        <div class="mb-8 max-w-4xl" data-reveal>
            <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">{{ $project->category }}</p>
            <h1 class="font-display text-7xl leading-none">{{ $project->title }}</h1>
            <p class="mt-4 text-lg text-[#4e576a] dark:text-[#e0e4eb]">{{ $project->description }}</p>
            @if ($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="btn-primary mt-5">Visitar projeto</a>
            @endif
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

        <div class="mt-10 panel p-6" data-reveal>
            <h2 class="mb-4 text-xl font-semibold">Tecnologias utilizadas</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($project->technologies ?? [] as $technology)
                    <span class="rounded-full bg-brand-100 px-3 py-1 text-xs font-semibold text-brand-800 dark:bg-brand-900/40 dark:text-brand-300">{{ $technology }}</span>
                @endforeach
            </div>
        </div>
    </section>
@endsection
