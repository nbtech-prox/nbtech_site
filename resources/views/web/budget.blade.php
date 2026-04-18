@extends('layouts.app')

@section('title', 'Pedir orcamento | NBTech')
@section('meta_description', 'Pede um orçamento à NBTech para websites, plataformas, apps e automação. Partilha o teu contexto e recebe próximos passos claros.')

@section('content')
    <section class="container-fluid py-20">
        <div class="grid gap-12 lg:grid-cols-[0.88fr_1.12fr] lg:items-start">
            <div class="max-w-2xl space-y-5 pt-3" data-reveal>
                <span class="chip-brand">Pedido de orcamento</span>
                <h1 class="font-display text-2xl leading-[1.02] sm:text-3xl md:text-4xl xl:text-[2.25rem]">Pede uma proposta com direção, não um orçamento vazio.</h1>
                <p class="max-w-xl text-lg leading-8 text-[#4e576a] dark:text-[#e0e4eb]">Este formulário é para pedidos de website, aplicação, plataforma ou automação. Quanto mais contexto partilhares, mais útil será a resposta inicial da NBTech.</p>

                <div class="grid max-w-xl gap-3 pt-2">
                    <div class="rounded-2xl border border-[#cad4e3] bg-white/90 px-5 py-4 text-sm dark:border-[#2f3b4d] dark:bg-[#111823]">Recebes uma resposta mais orientada a prioridades, viabilidade e próximos passos.</div>
                    <div class="rounded-2xl border border-[#cad4e3] bg-white/90 px-5 py-4 text-sm dark:border-[#2f3b4d] dark:bg-[#111823]">Não precisas de saber a solução técnica exata. Basta explicares o problema, o objetivo e a urgência.</div>
                    <div class="rounded-2xl border border-[#cad4e3] bg-white/90 px-5 py-4 text-sm dark:border-[#2f3b4d] dark:bg-[#111823]">Se quiseres apenas falar connosco sem pedido comercial, usa a página de <a href="{{ route('contact.index') }}" class="font-semibold text-brand-600 underline-offset-2 hover:underline">contacto</a>.</div>
                </div>
            </div>

            <div class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-8 shadow-[0_30px_80px_-50px_rgba(15,23,42,0.35)] dark:border-[#2f3b4d] dark:bg-[#111823] lg:mt-0" data-reveal>
                @if (session('status'))
                    <div aria-live="polite" class="mb-5 rounded-xl border border-emerald-300 bg-emerald-50 p-3 text-sm text-emerald-700 dark:border-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('budget.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium" for="name">Nome</label>
                            <input id="name" name="name" autocomplete="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                            @error('name')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium" for="email">Email</label>
                            <input id="email" type="email" inputmode="email" spellcheck="false" autocomplete="email" name="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                            @error('email')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium" for="company">Empresa</label>
                            <input id="company" name="company" autocomplete="organization" value="{{ old('company') }}" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                            @error('company')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium" for="phone">Telefone (opcional)</label>
                            <input id="phone" type="tel" inputmode="tel" autocomplete="tel" name="phone" value="{{ old('phone') }}" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                            @error('phone')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium" for="project_type">Tipo de projeto</label>
                            <select id="project_type" name="project_type" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                                <option value="website" @selected(old('project_type') === 'website')>Website</option>
                                <option value="web-app" @selected(old('project_type') === 'web-app')>Aplicacao web</option>
                                <option value="mobile-app" @selected(old('project_type') === 'mobile-app')>Mobile app</option>
                                <option value="platform" @selected(old('project_type') === 'platform')>Plataforma</option>
                                <option value="automation" @selected(old('project_type') === 'automation')>Automacao</option>
                                <option value="other" @selected(old('project_type') === 'other')>Outro</option>
                            </select>
                            @error('project_type')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium" for="budget_range">Faixa de investimento</label>
                            <select id="budget_range" name="budget_range" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                                <option value="ate-1000" @selected(old('budget_range') === 'ate-1000')>Ate 1.000 EUR</option>
                                <option value="1000-2500" @selected(old('budget_range') === '1000-2500')>1.000-2.500 EUR</option>
                                <option value="2500-5000" @selected(old('budget_range') === '2500-5000')>2.500-5.000 EUR</option>
                                <option value="5000-10000" @selected(old('budget_range') === '5000-10000')>5.000-10.000 EUR</option>
                                <option value="10000-plus" @selected(old('budget_range') === '10000-plus')>10.000+ EUR</option>
                            </select>
                            @error('budget_range')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium" for="timeline">Prazo pretendido</label>
                            <select id="timeline" name="timeline" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                                <option value="urgente" @selected(old('timeline') === 'urgente')>Urgente</option>
                                <option value="30-60-dias" @selected(old('timeline') === '30-60-dias')>30-60 dias</option>
                                <option value="2-3-meses" @selected(old('timeline') === '2-3-meses')>2-3 meses</option>
                                <option value="flexivel" @selected(old('timeline') === 'flexivel')>Flexivel</option>
                            </select>
                            @error('timeline')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium" for="message">Descricao do objetivo</label>
                        <textarea id="message" name="message" rows="7" required class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]" placeholder="Explica o que precisas, o estado atual do projeto, o principal objetivo e qualquer contexto importante.">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="rounded-xl border border-dashed border-[#b8c1cf] px-4 py-3 text-xs text-[#5d667a] dark:border-[#3e4757] dark:text-[#c7d0de]">
                        Este formulário é para pedidos com intenção comercial. Se quiseres apenas colocar uma dúvida ou entrar em contacto geral, usa a página de contacto.
                    </div>

                    <button class="btn-primary" type="submit" data-analytics-event="budget_submitted_attempt" data-analytics-context="budget_page" data-analytics-label="qualified">Pedir orcamento</button>
                </form>
            </div>
        </div>
    </section>
@endsection
