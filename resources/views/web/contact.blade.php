@extends('layouts.app')

@section('title', 'Contacto | NBTech')
@section('meta_description', 'Fala com a NBTech para dúvidas gerais, parcerias ou contacto comercial. Para pedidos com intenção de orçamento, usa a página dedicada de orçamento.')

@section('content')
    <section class="container-fluid py-20">
        <div class="grid gap-12 lg:grid-cols-[0.88fr_1.12fr] lg:items-start">
            <div class="max-w-2xl space-y-5 pt-3" data-reveal>
                <span class="chip-brand">Contacto</span>
                <h1 class="font-display text-2xl leading-[1.02] sm:text-3xl md:text-4xl xl:text-[2.25rem]">Fala connosco sem complicação.</h1>
                <p class="max-w-xl text-lg leading-8 text-[#4e576a] dark:text-[#e0e4eb]">Esta página é para contacto geral: dúvidas, parcerias, pedidos de informação ou conversas iniciais. Se já procuras proposta, prazo e enquadramento comercial, usa a página de orçamento.</p>
                <div class="grid max-w-xl gap-3 pt-2">
                    <div class="rounded-2xl border border-[#cad4e3] bg-white/85 px-5 py-4 text-sm dark:border-[#2f3b4d] dark:bg-[#111823]">Usa este formulário para contacto geral, esclarecimentos ou conversas sem briefing comercial fechado.</div>
                    <div class="rounded-2xl border border-[#cad4e3] bg-white/85 px-5 py-4 text-sm dark:border-[#2f3b4d] dark:bg-[#111823]">Se queres pedir uma proposta com prazo, enquadramento e prioridade, usa <a href="{{ route('budget.index') }}" class="font-semibold text-brand-600 underline-offset-2 hover:underline">Pedir orçamento</a>.</div>
                </div>
            </div>

            <div class="rounded-[1.8rem] border border-[#cad4e3] bg-white/90 p-8 shadow-[0_30px_80px_-50px_rgba(15,23,42,0.35)] dark:border-[#2f3b4d] dark:bg-[#111823] lg:mt-0" data-reveal>
                @if (session('status'))
                    <div aria-live="polite" class="mb-5 rounded-xl border border-emerald-300 bg-emerald-50 p-3 text-sm text-emerald-700 dark:border-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
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
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="company">Empresa</label>
                        <input id="company" name="company" autocomplete="organization" value="{{ old('company') }}" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                        @error('company')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="message">Mensagem</label>
                        <textarea id="message" name="message" rows="6" required class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]" placeholder="Ex.: gostava de esclarecer uma dúvida, perceber como trabalham, discutir uma parceria ou iniciar uma conversa.">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="rounded-xl border border-dashed border-[#b8c1cf] px-4 py-3 text-xs text-[#5d667a] dark:border-[#3e4757] dark:text-[#c7d0de]">
                        Para pedidos com intenção de orçamento, prazo e investimento, usa a página de orçamento para receber uma resposta mais orientada a proposta.
                    </div>

                    <button class="btn-primary" type="submit" data-analytics-event="contact_submitted_attempt" data-analytics-context="contact_page" data-analytics-label="general">Enviar contacto</button>
                </form>
            </div>
        </div>
    </section>
@endsection
