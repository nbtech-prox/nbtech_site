@extends('layouts.app')

@section('title', 'NBTech | Websites, Apps e Plataformas Digitais')
@section('meta_description', 'Desenvolvemos websites, aplicações web e mobile, plataformas digitais e automação para escalar o teu negócio.')
@section('schema_json_ld')
{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => route('home').'#organization',
            'name' => 'NBTech',
            'url' => route('home'),
            'logo' => url('/branding/logo/logo-clean.png'),
            'description' => 'NBTech desenvolve websites, aplicações web, mobile apps, plataformas digitais e automação para escalar o negócio dos clientes.',
            'sameAs' => [],
        ],
        [
            '@type' => 'WebSite',
            '@id' => route('home').'#website',
            'url' => route('home'),
            'name' => 'NBTech',
            'publisher' => [
                '@id' => route('home').'#organization',
            ],
            'inLanguage' => 'pt-PT',
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endsection

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

    <section class="container-fluid relative py-20 md:py-28">
        <div class="pointer-events-none absolute inset-x-0 top-4 -z-10 h-72 rounded-[3rem] bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.12),_transparent_34%),radial-gradient(circle_at_top_right,_rgba(249,115,22,0.12),_transparent_24%)] blur-3xl"></div>
        <div class="pointer-events-none absolute right-[8%] top-20 -z-10 h-40 w-40 rounded-full border border-[#d6deea] bg-white/30 blur-sm dark:border-[#334053] dark:bg-white/5"></div>
        <div class="grid gap-12 lg:grid-cols-[1.15fr_0.85fr] lg:items-end">
            <div class="space-y-8" data-reveal>
                <span class="chip-brand">Estratégia, design e tecnologia aplicada ao negocio</span>
                <div class="max-w-4xl space-y-5">
                    <h1 class="font-display text-2xl leading-[1.02] text-zinc-900 dark:text-[#f3ede4] sm:text-3xl md:text-4xl xl:text-[2.35rem]">Produtos digitais mais claros, mais fortes e mais preparados para crescer.</h1>
                    <p class="max-w-3xl text-lg leading-8 text-[#4e576a] dark:text-[#dbe2ec]">A NBTech ajuda empresas a lançar websites, plataformas, aplicações e automações com foco em clareza comercial, estrutura técnica sólida e execução sem ruído.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#6a7387] dark:text-[#b7c0cf]">
                    <span class="rounded-full border border-[#d6deea] px-3 py-1 dark:border-[#334053]">Clareza estratégica</span>
                    <span class="rounded-full border border-[#d6deea] px-3 py-1 dark:border-[#334053]">Execução sólida</span>
                    <span class="rounded-full border border-[#d6deea] px-3 py-1 dark:border-[#334053]">Crescimento sustentável</span>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('budget.index') }}" class="btn-primary" data-analytics-event="budget_request_clicked" data-analytics-context="home_hero" data-analytics-label="primary">Pedir orcamento</a>
                    <a href="{{ route('contact.index') }}" class="btn-secondary" data-analytics-event="contact_clicked" data-analytics-context="home_hero" data-analytics-label="secondary">Contacto geral</a>
                    <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-brand-700 transition hover:text-brand-600 dark:text-brand-300 dark:hover:text-brand-200" data-analytics-event="portfolio_clicked" data-analytics-context="home_hero" data-analytics-label="cases">Ver casos de estudo</a>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    <article class="rounded-2xl border border-[#cbd3e1] bg-white/80 p-5 dark:border-[#313b4d] dark:bg-[#111823]">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Clareza</p>
                        <p class="mt-3 text-sm leading-6 text-[#334155] dark:text-[#dce3ee]">Mensagens, estruturas e interfaces pensadas para ajudar o visitante a perceber valor mais depressa.</p>
                    </article>
                    <article class="rounded-2xl border border-[#cbd3e1] bg-white/80 p-5 dark:border-[#313b4d] dark:bg-[#111823]">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Execucao</p>
                        <p class="mt-3 text-sm leading-6 text-[#334155] dark:text-[#dce3ee]">Planeamento pragmático, prioridades bem escolhidas e entregas que evoluem sem desperdício.</p>
                    </article>
                    <article class="rounded-2xl border border-[#cbd3e1] bg-white/80 p-5 dark:border-[#313b4d] dark:bg-[#111823]">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Estrutura</p>
                        <p class="mt-3 text-sm leading-6 text-[#334155] dark:text-[#dce3ee]">Base técnica preparada para crescer, integrar ferramentas e evitar retrabalho mais tarde.</p>
                    </article>
                </div>
            </div>
            <div class="space-y-4" data-reveal>
                <article class="rounded-[2rem] border border-[#cad4e3] bg-white/85 p-6 shadow-[0_30px_80px_-50px_rgba(15,23,42,0.55)] backdrop-blur dark:border-[#2f3b4d] dark:bg-[#101722]/90">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Processo</p>
                    <h2 class="mt-3 font-display text-3xl leading-none">Avancar com clareza antes de investir mal.</h2>
                    <div class="mt-6 space-y-4">
                        @foreach ([
                            ['step' => '01', 'title' => 'Diagnóstico', 'text' => 'Percebemos contexto, objetivo e principal bloqueio.'],
                            ['step' => '02', 'title' => 'Direção', 'text' => 'Definimos a prioridade com mais impacto comercial e técnico.'],
                            ['step' => '03', 'title' => 'Implementação', 'text' => 'Executamos com foco em resultado, consistência e evolução.'],
                        ] as $item)
                            <div class="rounded-2xl border border-[#d7dfeb] bg-[#f8fbff] p-4 dark:border-[#2f3b4d] dark:bg-[#151d29]">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">{{ $item['step'] }}</p>
                                <h3 class="mt-2 text-lg font-semibold">{{ $item['title'] }}</h3>
                                <p class="mt-2 text-sm text-[#526076] dark:text-[#d0d9e6]">{{ $item['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </article>
            </div>
        </div>
    </section>

    @if ($testimonials->isNotEmpty())
        <section class="container-fluid py-8 md:py-10">
            <div class="rounded-[2rem] border border-[#b8c1cf] bg-white/80 p-6 dark:border-[#373f4e] dark:bg-[#10151f] md:p-8" data-reveal>
                <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div class="space-y-3">
                        <span class="chip-brand">Confianca</span>
                        <h2 class="font-display text-4xl leading-none md:text-5xl">Empresas que ja confiaram na NBTech</h2>
                    </div>
                    <p class="max-w-2xl text-sm text-[#4e576a] dark:text-[#e0e4eb]">Prova social relevante reduz risco percebido e ajuda a transformar interesse em contacto qualificado.</p>
                </div>
                <div class="grid gap-4 lg:grid-cols-3">
                    @foreach ($testimonials->take(3) as $testimonial)
                        <article class="rounded-2xl border border-[#c5ceda] bg-[#f8fafc] p-5 dark:border-[#3b4556] dark:bg-[#171d29]">
                            <div class="mb-3 flex items-center justify-between gap-4">
                                <p class="text-sm font-semibold text-zinc-900 dark:text-[#f3ede4]">{{ $testimonial->name }}</p>
                                <p class="text-xs uppercase tracking-[0.16em] text-brand-600">{{ str_repeat('★', $testimonial->rating) }}</p>
                            </div>
                            <p class="text-sm leading-6 text-[#4e576a] dark:text-[#dce2ec]">“{{ $testimonial->quote }}”</p>
                            @if ($testimonial->company)
                                <p class="mt-4 text-xs font-semibold uppercase tracking-[0.16em] text-[#6a7387] dark:text-[#b7c0cf]">{{ $testimonial->company }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="container-fluid py-20">
        <div class="mb-8 flex items-end justify-between" data-reveal>
            <div class="space-y-5">
                <span class="chip-brand">Serviços</span>
                <h2 class="font-display text-3xl leading-[1.02] sm:text-4xl xl:text-[2.2rem]">Intervenções desenhadas para resolver prioridades reais</h2>
            </div>
            <a href="{{ route('services.index') }}" class="btn-secondary">Explorar serviços</a>
        </div>
        <div class="mb-10 grid gap-4 md:grid-cols-3" data-reveal>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/80 p-5 dark:border-[#373f4e] dark:bg-[#121926]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Para crescer</p>
                <h3 class="mt-2 text-xl font-semibold">Mais clareza comercial</h3>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#dbe2ec]">Sites e paginas que comunicam melhor, convencem mais e conduzem a uma acao clara.</p>
            </article>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/80 p-5 dark:border-[#373f4e] dark:bg-[#121926]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Para operar</p>
                <h3 class="mt-2 text-xl font-semibold">Mais eficiencia interna</h3>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#dbe2ec]">Automacoes e plataformas para reduzir trabalho manual, erros e dependencia de processos dispersos.</p>
            </article>
            <article class="rounded-2xl border border-[#b8c1cf] bg-white/80 p-5 dark:border-[#373f4e] dark:bg-[#121926]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Para escalar</p>
                <h3 class="mt-2 text-xl font-semibold">Base tecnica mais solida</h3>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#dbe2ec]">Arquitetura e implementacao pensadas para suportar evolucao sem recomeçar sempre do zero.</p>
            </article>
        </div>
        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($services as $service)
                @php
                    $serviceImage = $normalizeMediaUrl($service->image_url);
                @endphp
                <article class="rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-6 transition-transform duration-200 hover:-translate-y-0.5 dark:border-[#2f3b4d] dark:bg-[#111823]" data-reveal>
                    @if ($serviceImage)
                        <div class="mb-4 overflow-hidden rounded-lg border border-[#aeb8c9] dark:border-[#4e576a]">
                            <img src="{{ $serviceImage }}" alt="Imagem relacionada com {{ $service->title }}" class="h-36 w-full object-cover" loading="lazy">
                        </div>
                    @endif
                    <h3 class="mb-2 text-xl font-semibold">{{ $service->title }}</h3>
                    <p class="text-sm text-[#4e576a] dark:text-[#e0e4eb]">{{ $service->description }}</p>
                    <div class="mt-5 flex items-center justify-between gap-3 border-t border-[#d4dbe7] pt-4 text-xs font-semibold uppercase tracking-[0.14em] text-[#667086] dark:border-[#333f52] dark:text-[#b6c0cf]">
                        <span>Planeamento + execucao</span>
                        <a href="{{ route('services.show', $service) }}" class="text-brand-600 transition group-hover:translate-x-0.5">Ver serviço</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="container-fluid py-20">
        <div class="mb-8 flex items-end justify-between" data-reveal>
            <div class="space-y-5">
                <span class="chip-brand">Portfólio</span>
                <h2 class="font-display text-3xl leading-[1.02] sm:text-4xl xl:text-[2.2rem]">Projetos em destaque</h2>
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
                <article class="group relative overflow-hidden rounded-[1.6rem] border border-[#b8c1cf] bg-[#0a0e15] text-white dark:border-[#4e576a] dark:bg-[#212631]" data-reveal>
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
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between" data-reveal>
            <div>
                <span class="chip-brand">Método</span>
                <h2 class="mt-4 font-display text-3xl leading-[1.02] sm:text-4xl xl:text-[2.2rem]">Como transformamos contexto em direção prática.</h2>
            </div>
            <p class="max-w-2xl text-sm leading-7 text-[#5b667b] dark:text-[#c5cedb]">Sem sobrecarregar o processo. O objetivo é perceber depressa o que importa, definir prioridade e executar com critério.</p>
        </div>
        <div class="grid gap-5 lg:grid-cols-3">
            <article class="rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]" data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-brand-600">Passo 1</p>
                <h2 class="mt-3 text-2xl font-semibold">Partilhas o contexto</h2>
                <p class="mt-3 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Objetivo, prazo, bloqueios e o que ja existe. Quanto mais claro o contexto, melhor o plano.</p>
            </article>
            <article class="rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]" data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-brand-600">Passo 2</p>
                <h2 class="mt-3 text-2xl font-semibold">Recebes direcao</h2>
                <p class="mt-3 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Respondemos com enquadramento tecnico, prioridade recomendada e proximos passos objetivos.</p>
            </article>
            <article class="rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]" data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-brand-600">Passo 3</p>
                <h2 class="mt-3 text-2xl font-semibold">Avancamos com execucao</h2>
                <p class="mt-3 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Implementacao com foco em rapidez, qualidade e impacto comercial real.</p>
            </article>
        </div>
    </section>

    <section class="container-fluid py-20">
        <div class="rounded-[2.2rem] border border-[#cad4e3] bg-white/92 p-8 shadow-[0_36px_90px_-60px_rgba(15,23,42,0.45)] dark:border-[#2f3b4d] dark:bg-[#111823] md:p-12" data-reveal>
            <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr] lg:items-end">
                <div>
                    <span class="chip-brand">Próximo passo</span>
                    <h2 class="mt-4 font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.2rem]">Pronto para transformar a tua ideia num ativo digital que vende?</h2>
                </div>
                <div class="space-y-4">
                    <p class="max-w-2xl text-sm leading-7 text-[#4e576a] dark:text-[#e0e4eb]">Partilha o teu objetivo e a NBTech responde com direção técnica, prioridade recomendada e um caminho claro para avançar.</p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('budget.index') }}" class="btn-primary" data-analytics-event="budget_request_clicked" data-analytics-context="home_final_cta" data-analytics-label="primary">Pedir orcamento</a>
                        <a href="{{ route('contact.index') }}" class="btn-secondary">Falar connosco</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
