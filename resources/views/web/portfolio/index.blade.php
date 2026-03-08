@extends('layouts.app')

@section('title', 'Portfólio | NBTech')

@section('content')
    <section class="container-fluid py-20">
        <div class="mb-10 space-y-5" data-reveal>
            <span class="chip-brand">Portfólio</span>
            <h1 class="font-display text-7xl leading-none">Projetos digitais com impacto</h1>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($projects as $project)
                <article class="group relative overflow-hidden rounded-lg border border-[#b8c1cf] bg-[#0a0e15] text-white dark:border-[#4e576a] dark:bg-[#212631]" data-reveal>
                    <img src="{{ $project->getFirstMediaUrl('cover') ?: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $project->title }}" class="h-72 w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                    <div class="absolute inset-0 bg-[#0a0e15]/72 opacity-95 transition group-hover:opacity-100"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <h2 class="text-xl font-semibold">{{ $project->title }}</h2>
                        <p class="mt-1 text-xs text-zinc-200">{{ implode(' · ', $project->technologies ?? []) }}</p>
                        <a href="{{ route('portfolio.show', $project) }}" class="mt-3 inline-flex rounded-lg bg-white/15 px-3 py-1.5 text-xs font-semibold transition hover:bg-white/25">Ver projeto</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-10">{{ $projects->links() }}</div>
    </section>
@endsection
