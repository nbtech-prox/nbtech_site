@extends('layouts.app')

@section('title', ($project->meta_title ?: $project->title).' | NBTech')
@section('meta_description', $project->meta_description ?: str($project->description)->limit(150))

@section('content')
    <section class="container-fluid py-20">
        <a href="{{ route('portfolio.index') }}" class="mb-6 inline-flex text-sm font-semibold text-brand-600">← Voltar ao portfólio</a>

        <div class="mb-8 max-w-4xl" data-reveal>
            <p class="text-xs font-semibold uppercase tracking-widest text-brand-600">{{ $project->category }}</p>
            <h1 class="font-display text-7xl leading-none">{{ $project->title }}</h1>
            <p class="mt-4 text-lg text-[#4e576a] dark:text-[#e0e4eb]">{{ $project->description }}</p>
            @if ($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="btn-primary mt-5">Visitar projeto</a>
            @endif
        </div>

        <img src="{{ $cover ?: 'https://images.unsplash.com/photo-1509395176047-4a66953fd231?auto=format&fit=crop&w=1600&q=80' }}" alt="{{ $project->title }}" class="h-[420px] w-full rounded-lg object-cover" loading="lazy" data-reveal>

        <div class="mt-10 panel p-6" data-reveal>
            <h2 class="mb-4 text-xl font-semibold">Tecnologias utilizadas</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($project->technologies ?? [] as $technology)
                    <span class="rounded-full bg-brand-100 px-3 py-1 text-xs font-semibold text-brand-800 dark:bg-brand-900/40 dark:text-brand-300">{{ $technology }}</span>
                @endforeach
            </div>
        </div>

        @if ($gallery->isNotEmpty())
            <div class="mt-10 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($gallery as $media)
                    <img src="{{ $media->getUrl() }}" alt="Imagem do projeto {{ $project->title }}" class="h-60 w-full rounded-lg object-cover" loading="lazy" data-reveal>
                @endforeach
            </div>
        @endif
    </section>
@endsection
