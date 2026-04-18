@extends('layouts.app')

@section('title', 'Sobre a NBTech')

@section('content')
    <section class="container-fluid py-20">
        @if (session('status'))
            <div class="mb-6 max-w-3xl rounded-xl border border-emerald-300 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300" data-reveal>
                {{ session('status') }}
            </div>
        @endif

        <div class="max-w-5xl space-y-6" data-reveal>
            <span class="chip-brand">Sobre a NBTech</span>
            <h1 class="font-display text-2xl leading-[1.02] sm:text-3xl md:text-4xl xl:text-[2.35rem]">Construímos produtos digitais que geram resultados reais</h1>
            <p class="max-w-4xl text-lg text-[#4e576a] dark:text-[#e0e4eb]">A NBTech combina estratégia, design e engenharia para transformar objetivos de negócio em experiências digitais rápidas, escaláveis e orientadas à conversão. Trabalhamos com foco em execução, clareza técnica e impacto mensurável em cada entrega.</p>
        </div>

        <div class="mt-10 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" data-reveal>
            <article class="rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-5 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">Foco</p>
                <h2 class="mt-2 text-2xl font-semibold">Performance</h2>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Arquiteturas leves, frontend rápido e backend preparado para crescer sem fricção.</p>
            </article>
            <article class="rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-5 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">Método</p>
                <h2 class="mt-2 text-2xl font-semibold">Entrega contínua</h2>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Planeamento por fases, validação constante e melhorias iterativas com prioridade no que gera valor.</p>
            </article>
            <article class="rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-5 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">Qualidade</p>
                <h2 class="mt-2 text-2xl font-semibold">Código sólido</h2>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Boas práticas, estrutura limpa e manutenção simplificada para reduzir risco técnico no longo prazo.</p>
            </article>
            <article class="rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-5 dark:border-[#2f3b4d] dark:bg-[#111823]">
                <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">Parceria</p>
                <h2 class="mt-2 text-2xl font-semibold">Visão de negócio</h2>
                <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Decisões técnicas alinhadas com objetivos comerciais, aquisição de clientes e retenção.</p>
            </article>
        </div>

        <div class="mt-10 grid gap-6 xl:grid-cols-[1.1fr_0.9fr]" data-reveal>
            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-8">
                <h2 class="font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">Como trabalhamos</h2>
                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    <div class="rounded-xl border border-[#aeb8c9] bg-white p-4 dark:border-[#4e576a] dark:bg-[#212631]">
                        <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">01</p>
                        <h3 class="mt-2 text-base font-semibold">Diagnóstico</h3>
                        <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Mapeamos contexto, metas e prioridades para evitar retrabalho.</p>
                    </div>
                    <div class="rounded-xl border border-[#aeb8c9] bg-white p-4 dark:border-[#4e576a] dark:bg-[#212631]">
                        <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">02</p>
                        <h3 class="mt-2 text-base font-semibold">Implementação</h3>
                        <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Desenvolvemos com ciclos curtos, validação frequente e comunicação transparente.</p>
                    </div>
                    <div class="rounded-xl border border-[#aeb8c9] bg-white p-4 dark:border-[#4e576a] dark:bg-[#212631]">
                        <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">03</p>
                        <h3 class="mt-2 text-base font-semibold">Escala</h3>
                        <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Otimização contínua com foco em estabilidade, conversão e crescimento.</p>
                    </div>
                </div>
            </article>

            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-8">
                <h2 class="font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">O que defendemos</h2>
                <ul class="mt-5 space-y-3 text-sm text-[#4e576a] dark:text-[#e0e4eb]">
                    <li class="rounded-lg border border-[#aeb8c9] bg-white px-4 py-3 dark:border-[#4e576a] dark:bg-[#212631]"><strong class="text-zinc-900 dark:text-white">Clareza:</strong> sem jargão desnecessário, com decisões explicadas de forma objetiva.</li>
                    <li class="rounded-lg border border-[#aeb8c9] bg-white px-4 py-3 dark:border-[#4e576a] dark:bg-[#212631]"><strong class="text-zinc-900 dark:text-white">Responsabilidade:</strong> compromisso com prazos, qualidade e resultados acordados.</li>
                    <li class="rounded-lg border border-[#aeb8c9] bg-white px-4 py-3 dark:border-[#4e576a] dark:bg-[#212631]"><strong class="text-zinc-900 dark:text-white">Evolução:</strong> melhoria contínua em produto, processos e experiência do utilizador.</li>
                </ul>
            </article>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2">
            @foreach ($testimonials as $testimonial)
                <article class="rounded-[1.6rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823]" data-reveal>
                    <div class="mb-4 text-sm font-semibold">
                        {{ $testimonial->name }}
                        @if($testimonial->company)
                            <span class="ml-2 text-zinc-500">·
                                @if ($testimonial->company_url)
                                    <a href="{{ $testimonial->company_url }}" target="_blank" rel="noopener noreferrer" class="underline decoration-transparent underline-offset-2 transition hover:decoration-current">{{ $testimonial->company }}</a>
                                @else
                                    {{ $testimonial->company }}
                                @endif
                            </span>
                        @endif
                    </div>
                    <p class="mb-3 text-sm text-amber-500" aria-label="Pontuação {{ $testimonial->rating ?? 5 }} de 5">{{ str_repeat('★', (int) ($testimonial->rating ?? 5)) }}<span class="text-slate-400">{{ str_repeat('☆', 5 - (int) ($testimonial->rating ?? 5)) }}</span></p>
                    <p class="text-sm text-[#4e576a] dark:text-[#e0e4eb]">“{{ $testimonial->quote }}”</p>
                </article>
            @endforeach
        </div>

        <div class="mt-12 rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-8" data-reveal>
            <h2 class="font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">Partilha a tua experiência</h2>
            <p class="mt-3 text-sm text-[#4e576a] dark:text-[#e0e4eb]">Envia o teu testemunho. Após validação da nossa equipa, ele pode ser publicado no site.</p>

            @if ($errors->any())
                <div class="mt-4 rounded-xl border border-rose-300 bg-rose-50 p-3 text-sm text-rose-700 dark:border-rose-700 dark:bg-rose-950/40 dark:text-rose-300">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('testimonials.store') }}" class="mt-5 space-y-4">
                @csrf
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="testimonial_name">Nome</label>
                        <input id="testimonial_name" name="name" required value="{{ old('name') }}" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="testimonial_company">Empresa (opcional)</label>
                        <input id="testimonial_company" name="company" value="{{ old('company') }}" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                    </div>
                </div>
                <div class="grid gap-4 md:grid-cols-[1fr_260px]">
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="testimonial_company_url">Website da empresa (opcional)</label>
                        <input id="testimonial_company_url" name="company_url" value="{{ old('company_url') }}" placeholder="https://..." class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="testimonial_rating">Pontuação</label>
                        <select id="testimonial_rating" name="rating" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected((int) old('rating', 5) === $i)>{{ str_repeat('★', $i) }} ({{ $i }})</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium" for="testimonial_quote">Mensagem</label>
                    <textarea id="testimonial_quote" name="quote" rows="4" required class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]" placeholder="Partilha o impacto que a NBTech teve no teu projeto.">{{ old('quote') }}</textarea>
                </div>
                <button type="submit" class="btn-primary">Enviar testemunho</button>
            </form>
        </div>
    </section>
@endsection
