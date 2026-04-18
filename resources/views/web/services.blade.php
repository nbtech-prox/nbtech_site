@extends('layouts.app')

@section('title', 'Serviços | NBTech')

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

    <section class="container-fluid py-20">
        <div class="max-w-5xl space-y-6" data-reveal>
            <span class="chip-brand">Serviços</span>
            <h1 class="font-display text-7xl leading-none">Soluções digitais desenhadas para crescer com o teu negócio</h1>
            <p class="max-w-4xl text-lg text-[#4e576a] dark:text-[#e0e4eb]">Da estratégia à implementação, ajudamos empresas a lançar, otimizar e escalar produtos digitais com foco em performance, experiência do utilizador e conversão. Cada serviço é pensado para resolver problemas reais e gerar resultados mensuráveis.</p>
        </div>

        <div class="mt-10 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" data-reveal>
            <article class="panel p-5">
                <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">Abordagem</p>
                <h2 class="mt-2 text-2xl font-semibold">Estratégica</h2>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Escolhemos tecnologia e prioridades com base em impacto de negócio, não em tendência.</p>
            </article>
            <article class="panel p-5">
                <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">Execução</p>
                <h2 class="mt-2 text-2xl font-semibold">Rápida</h2>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Entregas iterativas para validares cedo, corrigires rápido e evoluíres com segurança.</p>
            </article>
            <article class="panel p-5">
                <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">Qualidade</p>
                <h2 class="mt-2 text-2xl font-semibold">Escalável</h2>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Código e arquitetura preparados para suportar crescimento sem comprometer performance.</p>
            </article>
            <article class="panel p-5">
                <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">Parceria</p>
                <h2 class="mt-2 text-2xl font-semibold">Próxima</h2>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Comunicação clara, alinhamento contínuo e decisões partilhadas durante todo o processo.</p>
            </article>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($services as $service)
                <article class="panel p-6" data-reveal>
                    @if ($service->image_url)
                        <div class="mb-4 overflow-hidden rounded-lg border border-[#aeb8c9] dark:border-[#4e576a]">
                            <img src="{{ $normalizeMediaUrl($service->image_url) }}" alt="Imagem do serviço {{ $service->title }}" class="h-40 w-full object-cover" loading="lazy">
                        </div>
                    @endif
                    <h2 class="mb-3 text-2xl font-semibold">{{ $service->title }}</h2>
                    <p class="text-sm text-[#4e576a] dark:text-[#e0e4eb]">{{ $service->description }}</p>
                </article>
            @endforeach
        </div>

        <div class="mt-12 panel p-6 md:p-8" data-reveal>
            <h2 class="font-display text-4xl leading-none">Queres ajuda para escolher o serviço certo?</h2>
            <p class="mt-3 max-w-3xl text-sm text-[#4e576a] dark:text-[#e0e4eb]">Analisamos o estado atual do teu projeto e propomos um plano de execução claro, com prioridades, estimativa e próximos passos para avançar com confiança.</p>
            <a href="{{ route('contact.index') }}" class="btn-primary mt-5">Falar com a NBTech</a>
        </div>
    </section>
@endsection
