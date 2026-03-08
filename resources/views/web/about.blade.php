@extends('layouts.app')

@section('title', 'Sobre a NBTech')

@section('content')
    <section class="container-fluid py-20">
        @if (session('status'))
            <div class="mb-6 max-w-3xl rounded-xl border border-emerald-300 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300" data-reveal>
                {{ session('status') }}
            </div>
        @endif

        <div class="max-w-3xl space-y-5" data-reveal>
            <span class="chip-brand">Sobre</span>
            <h1 class="font-display text-7xl leading-none">Tecnologia com visão de produto</h1>
            <p class="text-lg text-[#4e576a] dark:text-[#e0e4eb]">A NBTech é uma empresa digital orientada à entrega de soluções modernas, com arquitetura limpa e foco em performance.</p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2">
            @foreach ($testimonials as $testimonial)
                <article class="panel p-6" data-reveal>
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

        <div class="mt-12 panel p-6 md:p-8" data-reveal>
            <h2 class="font-display text-4xl leading-none">Partilha a tua experiência</h2>
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
