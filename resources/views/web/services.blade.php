@extends('layouts.app')

@section('title', 'Serviços | NBTech')

@section('content')
    <section class="container-fluid py-20">
        <div class="max-w-3xl space-y-5" data-reveal>
            <span class="chip-brand">Serviços</span>
            <h1 class="font-display text-7xl leading-none">Do conceito ao produto em produção</h1>
            <p class="text-lg text-[#4e576a] dark:text-[#e0e4eb]">Combinamos design, engenharia e automação para desenvolver soluções digitais com impacto real no negócio.</p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($services as $service)
                <article class="panel p-6" data-reveal>
                    <h2 class="mb-3 text-2xl font-semibold">{{ $service->title }}</h2>
                    <p class="text-sm text-[#4e576a] dark:text-[#e0e4eb]">{{ $service->description }}</p>
                </article>
            @endforeach
        </div>
    </section>
@endsection
