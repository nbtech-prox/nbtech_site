@extends('layouts.admin')

@section('title', 'Dashboard | NBTech Admin')
@section('heading', 'Dashboard')

@section('content')
    <section class="grid gap-5 md:grid-cols-3">
        <article class="panel p-5">
            <p class="text-xs uppercase tracking-widest text-slate-500">Projetos</p>
            <p class="mt-2 text-3xl font-semibold">{{ $projectCount }}</p>
        </article>
        <article class="panel p-5">
            <p class="text-xs uppercase tracking-widest text-slate-500">Destaque</p>
            <p class="mt-2 text-3xl font-semibold">{{ $featuredCount }}</p>
        </article>
        <a href="{{ route('admin.testimonials.index', ['status' => 'pending']) }}" class="panel block p-5 hover:border-brand-300">
            <p class="text-xs uppercase tracking-widest text-slate-500">Testemunhos pendentes</p>
            <p class="mt-2 text-3xl font-semibold">{{ $pendingTestimonialsCount }}</p>
            <span class="mt-3 flex justify-end">
                <span class="inline-flex rounded-md bg-[#1f2430] px-3 py-1.5 text-sm font-semibold text-brand-500">Ver pendentes</span>
            </span>
        </a>
    </section>

    <section class="mt-8 grid gap-6 lg:grid-cols-2">
        <article class="panel p-5">
            <h2 class="mb-4 text-lg font-semibold">Projetos recentes</h2>
            <ul class="space-y-3 text-sm">
                @forelse ($recentProjects as $project)
                    <li class="flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2 dark:border-slate-800">
                        <span>{{ $project->title }}</span>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-brand-600">Editar</a>
                    </li>
                @empty
                    <li class="text-slate-500">Sem projetos para mostrar.</li>
                @endforelse
            </ul>
        </article>

        <article class="panel p-5">
            <h2 class="mb-4 text-lg font-semibold">Mensagens recentes</h2>
            <ul class="space-y-3 text-sm">
                @forelse ($recentMessages as $message)
                    <li class="rounded-lg border border-slate-200 px-3 py-2 dark:border-slate-800">
                        <p class="font-medium">{{ $message->name }} <span class="text-slate-500">({{ $message->email }})</span></p>
                        <p class="mt-1 text-slate-600 dark:text-slate-300">{{ str($message->message)->limit(90) }}</p>
                    </li>
                @empty
                    <li class="text-slate-500">Sem mensagens.</li>
                @endforelse
            </ul>
        </article>
    </section>
@endsection
