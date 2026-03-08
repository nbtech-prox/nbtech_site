@extends('layouts.app')

@section('title', 'Contacto | NBTech')

@section('content')
    <section class="container-fluid py-20">
        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="space-y-5" data-reveal>
                <span class="chip-brand">Contacto</span>
                <h1 class="font-display text-7xl leading-none">Vamos construir algo relevante.</h1>
                <p class="text-lg text-[#4e576a] dark:text-[#e0e4eb]">Partilha o teu contexto e objetivos. Respondemos com proposta técnica e plano de execução.</p>
            </div>

            <div class="panel p-8" data-reveal>
                @if (session('status'))
                    <div class="mb-5 rounded-xl border border-emerald-300 bg-emerald-50 p-3 text-sm text-emerald-700 dark:border-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="name">Nome</label>
                        <input id="name" name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                        @error('name')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                        @error('email')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="company">Empresa</label>
                        <input id="company" name="company" value="{{ old('company') }}" class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">
                        @error('company')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium" for="message">Mensagem</label>
                        <textarea id="message" name="message" rows="6" required class="w-full rounded-xl border border-[#9ea9bc] bg-white px-4 py-2.5 text-sm dark:border-[#4e576a] dark:bg-[#212631]">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <button class="btn-primary" type="submit">Enviar mensagem</button>
                </form>
            </div>
        </div>
    </section>
@endsection
