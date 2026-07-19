@extends('layouts.app')

@section('title', $service->meta_title ?: ($service->title.' | NBTech'))
@section('meta_description', $service->meta_description ?: str($service->description)->limit(155))
@section('schema_json_ld', json_encode($service->schemaData(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT))

@section('content')
    @php($content = $service->pageContent())
    <section class="container-fluid py-20">
        <a href="{{ route('services.index') }}" class="mb-6 inline-flex text-sm font-semibold text-brand-600">← Voltar aos serviços</a>

        <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
            <div class="space-y-6" data-reveal>
                <span class="chip-brand">Serviço</span>
                <h1 class="font-display text-2xl leading-[1.02] sm:text-3xl md:text-4xl xl:text-[2.35rem]">{{ $service->title }}</h1>
                <p class="max-w-3xl text-lg leading-8 text-[#4e576a] dark:text-[#e0e4eb]">{{ $content['lead'] }}</p>

                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('budget.index') }}" class="btn-primary" data-analytics-event="budget_request_clicked" data-analytics-context="service_detail" data-analytics-label="{{ $service->slug }}">Pedir orcamento</a>
                    <a href="{{ route('contact.index') }}" class="btn-secondary" data-analytics-event="contact_clicked" data-analytics-context="service_detail" data-analytics-label="{{ $service->slug }}">Falar connosco</a>
                </div>
            </div>

            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 shadow-[0_30px_80px_-50px_rgba(15,23,42,0.38)] dark:border-[#2f3b4d] dark:bg-[#111823] md:p-8" data-reveal>
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Ideal para</p>
                <ul class="mt-5 space-y-3 text-sm text-[#4e576a] dark:text-[#e0e4eb]">
                    @foreach ($content['ideal_for'] as $item)
                        <li class="rounded-xl border border-[#c8d0dd] bg-white px-4 py-3 dark:border-[#334053] dark:bg-[#171e2a]">{{ $item }}</li>
                    @endforeach
                </ul>
            </article>
        </div>

        <div class="mt-12 grid gap-5 lg:grid-cols-3" data-reveal>
            <article class="rounded-[1.6rem] border border-[#cbd3e1] bg-white/88 p-6 dark:border-[#313b4d] dark:bg-[#111823]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Resultado</p>
                <h2 class="mt-3 text-2xl font-semibold">Mais clareza</h2>
                <p class="mt-3 text-sm text-[#4e576a] dark:text-[#dce3ee]">Estruturas e mensagens que ajudam o visitante a perceber melhor o valor do teu negócio.</p>
            </article>
            <article class="rounded-[1.6rem] border border-[#cbd3e1] bg-white/88 p-6 dark:border-[#313b4d] dark:bg-[#111823]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Implementação</p>
                <h2 class="mt-3 text-2xl font-semibold">Menos ruído</h2>
                <p class="mt-3 text-sm text-[#4e576a] dark:text-[#dce3ee]">Prioridades bem definidas, execução limpa e um caminho mais simples para avançar.</p>
            </article>
            <article class="rounded-[1.6rem] border border-[#cbd3e1] bg-white/88 p-6 dark:border-[#313b4d] dark:bg-[#111823]">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Base</p>
                <h2 class="mt-3 text-2xl font-semibold">Mais estrutura</h2>
                <p class="mt-3 text-sm text-[#4e576a] dark:text-[#dce3ee]">Tecnologia preparada para crescer, integrar e evoluir sem recomeçar do zero.</p>
            </article>
        </div>

        <div class="mt-12 grid gap-6 lg:grid-cols-2" data-reveal>
            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-8">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">O que normalmente entregamos</p>
                <ul class="mt-5 space-y-3 text-sm text-[#4e576a] dark:text-[#e0e4eb]">
                    @foreach ($content['deliverables'] as $item)
                        <li class="rounded-xl border border-[#c8d0dd] bg-white px-4 py-3 dark:border-[#334053] dark:bg-[#171e2a]">{{ $item }}</li>
                    @endforeach
                </ul>
            </article>
            <article class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-6 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-8">
                <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-600">Perguntas frequentes</p>
                <div class="mt-5 space-y-4">
                    @foreach ($content['faqs'] as $faq)
                        <div class="rounded-xl border border-[#c8d0dd] bg-white px-4 py-4 dark:border-[#334053] dark:bg-[#171e2a]">
                            <h3 class="text-base font-semibold">{{ $faq['question'] }}</h3>
                            <p class="mt-2 text-sm text-[#4e576a] dark:text-[#e0e4eb]">{{ $faq['answer'] }}</p>
                        </div>
                    @endforeach
                </div>
            </article>
        </div>

        @if ($services->isNotEmpty())
            <div class="mt-14" data-reveal>
                <div class="mb-6 flex items-end justify-between gap-6">
                    <div>
                        <span class="chip-brand">Outros serviços</span>
                        <h2 class="mt-4 font-display text-3xl leading-[1.02] sm:text-4xl xl:text-[2.2rem]">Explora outras prioridades possíveis</h2>
                    </div>
                    <a href="{{ route('services.index') }}" class="btn-secondary">Ver todos</a>
                </div>

                <div class="grid gap-5 lg:grid-cols-3">
                    @foreach ($services as $relatedService)
                        <article class="panel p-6">
                            <h3 class="text-2xl font-semibold">{{ $relatedService->title }}</h3>
                            <p class="mt-3 text-sm text-[#4e576a] dark:text-[#e0e4eb]">{{ $relatedService->description }}</p>
                            <a href="{{ route('services.show', $relatedService) }}" class="mt-5 inline-flex text-sm font-semibold text-brand-600">Ver serviço</a>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-14 rounded-[2rem] border border-[#cad4e3] bg-white/90 p-7 dark:border-[#2f3b4d] dark:bg-[#111823] md:p-10" data-reveal>
            <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr] lg:items-end">
                <div>
                    <span class="chip-brand">Próximo passo</span>
                    <h2 class="mt-4 font-display text-2xl leading-[1.02] sm:text-3xl xl:text-[2.15rem]">Se este serviço faz sentido para o teu contexto, o melhor ponto de partida é uma conversa com direção.</h2>
                </div>
                <div class="space-y-4">
                    <p class="text-sm leading-7 text-[#4e576a] dark:text-[#dce3ee]">Partilha o objetivo, o estado atual e a urgência do projeto. A NBTech ajuda-te a perceber prioridade, viabilidade e próximos passos com menos ruído e mais clareza.</p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('budget.index') }}" class="btn-primary" data-analytics-event="budget_request_clicked" data-analytics-context="service_detail_final" data-analytics-label="{{ $service->slug }}">Pedir orcamento</a>
                        <a href="{{ route('contact.index') }}" class="btn-secondary" data-analytics-event="contact_clicked" data-analytics-context="service_detail_final" data-analytics-label="{{ $service->slug }}">Falar connosco</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
