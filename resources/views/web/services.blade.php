@extends('layouts.app')

@section('title', 'Serviços | NBTech')
@section('meta_description', 'Conhece os serviços da NBTech: websites, aplicações web, mobile apps, plataformas digitais e automação para empresas que querem crescer com clareza e eficiência.')

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
        <div class="max-w-6xl space-y-8" data-reveal>
            <span class="chip-brand">Serviços</span>
            <div class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-start">
                <div class="space-y-5">
                    <h1 class="font-display text-2xl leading-[1.02] sm:text-3xl md:text-4xl xl:text-[2.35rem]">Soluções digitais para vender melhor, operar com mais fluidez e crescer com estrutura.</h1>
                    <p class="max-w-4xl text-lg leading-8 text-[#4e576a] dark:text-[#e0e4eb]">A NBTech combina estratégia, design e implementação para transformar necessidades reais em produtos digitais mais claros, mais fortes e mais preparados para evoluir.</p>
                </div>
                <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/85 p-6 shadow-[0_30px_80px_-50px_rgba(15,23,42,0.4)] backdrop-blur dark:border-[#2f3b4d] dark:bg-[#101722]/90">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">O que recebes</p>
                    <ul class="mt-5 space-y-3 text-sm text-[#4e576a] dark:text-[#d7deea]">
                        <li class="rounded-xl border border-[#d6deea] bg-[#f8fbff] px-4 py-3 dark:border-[#334053] dark:bg-[#151d29]">Prioridades técnicas alinhadas com impacto comercial</li>
                        <li class="rounded-xl border border-[#d6deea] bg-[#f8fbff] px-4 py-3 dark:border-[#334053] dark:bg-[#151d29]">Execução limpa, progressiva e sem excesso de complexidade</li>
                        <li class="rounded-xl border border-[#d6deea] bg-[#f8fbff] px-4 py-3 dark:border-[#334053] dark:bg-[#151d29]">Base preparada para crescer com menos retrabalho</li>
                    </ul>
                </article>
            </div>
        </div>

        <div class="mt-14" data-reveal>
            <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <span class="chip-brand">Explorar</span>
                    <h2 class="mt-4 font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">Escolhe a área que queres aprofundar</h2>
                </div>
                <p class="max-w-2xl text-sm leading-7 text-[#5b667b] dark:text-[#c5cedb]">Cada serviço tem uma página própria com contexto, casos de uso, entregáveis e próximos passos para te ajudar a perceber se é a prioridade certa.</p>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($services as $service)
                    <article class="group rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-6 transition-transform duration-200 hover:-translate-y-0.5 dark:border-[#2f3b4d] dark:bg-[#111823]" data-reveal>
                        <div class="flex items-start justify-between gap-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                            <a href="{{ route('services.show', $service) }}" class="rounded-full border border-[#d3dcea] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#556176] transition group-hover:border-brand-300 group-hover:text-brand-700 dark:border-[#334053] dark:text-[#c5cedb] dark:group-hover:text-brand-300">Abrir</a>
                        </div>

                        @if ($service->image_url)
                            <div class="mt-5 overflow-hidden rounded-2xl border border-[#dbe2ed] dark:border-[#334053]">
                                <img src="{{ $normalizeMediaUrl($service->image_url) }}" alt="Imagem do serviço {{ $service->title }}" class="h-44 w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                            </div>
                        @endif

                        <h3 class="mt-5 text-2xl font-semibold">{{ $service->title }}</h3>
                        <p class="mt-3 text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">{{ $service->description }}</p>

                        <div class="mt-6 flex flex-wrap items-center gap-4">
                            <a href="{{ route('services.show', $service) }}" class="btn-secondary">Ver serviço</a>
                            <a href="{{ route('budget.index') }}" class="text-sm font-semibold text-brand-600">Pedir proposta</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="mt-16 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]" data-reveal>
            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-7 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Como pensamos</p>
                <h2 class="mt-4 font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">Não vendemos serviços soltos. Estruturamos prioridades.</h2>
                <p class="mt-4 max-w-3xl text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">O objetivo não é empurrar um serviço genérico. É perceber o que está a bloquear crescimento, clareza ou eficiência e escolher a intervenção com mais retorno para o teu caso.</p>
                <div class="mt-6 grid gap-3 sm:grid-cols-3 text-sm">
                    <div class="rounded-xl border border-[#d6deea] bg-[#f8fbff] px-4 py-4 dark:border-[#334053] dark:bg-[#151d29]">Diagnóstico antes de execução</div>
                    <div class="rounded-xl border border-[#d6deea] bg-[#f8fbff] px-4 py-4 dark:border-[#334053] dark:bg-[#151d29]">Menos ruído, mais direção</div>
                    <div class="rounded-xl border border-[#d6deea] bg-[#f8fbff] px-4 py-4 dark:border-[#334053] dark:bg-[#151d29]">Base preparada para evoluir</div>
                </div>
            </article>

            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-7 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Próximo passo</p>
                <h2 class="mt-4 font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">Se não tens a certeza do serviço certo, começamos pelo contexto.</h2>
                <p class="mt-4 text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">Partilha o estado atual do projeto e a NBTech ajuda-te a perceber onde está a prioridade com mais impacto — seja lançar, melhorar conversão, estruturar plataforma ou automatizar processos.</p>
                <div class="mt-6 flex flex-wrap items-center gap-4">
                    <a href="{{ route('budget.index') }}" class="btn-primary">Pedir orcamento</a>
                    <a href="{{ route('contact.index') }}" class="btn-secondary">Falar connosco</a>
                </div>
            </article>
        </div>
    </section>
@endsection
