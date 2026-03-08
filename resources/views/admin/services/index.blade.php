@extends('layouts.admin')

@section('title', 'Serviços | NBTech Admin')
@section('heading', 'Serviços')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ $search }}" placeholder="Pesquisar serviço" class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900">
            <button class="btn-secondary" type="submit">Pesquisar</button>
        </form>
        <a href="{{ route('admin.services.create') }}" class="btn-primary">Novo serviço</a>
    </div>

    <div class="panel overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="border-b border-slate-200 text-left dark:border-slate-800">
                <tr><th class="px-4 py-3">Título</th><th class="px-4 py-3 text-center">Ordem</th><th class="px-4 py-3 text-center">Ações</th></tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr class="border-b border-slate-100 dark:border-slate-900">
                        <td class="px-4 py-3">{{ $service->title }}</td>
                        <td class="px-4 py-3 text-center">{{ $service->order }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('admin.services.edit', $service) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-md text-brand-600 transition hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-brand-900/20" title="Editar" aria-label="Editar">
                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Eliminar este serviço?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-md text-rose-600 transition hover:bg-rose-50 hover:text-rose-700 dark:hover:bg-rose-900/20" title="Eliminar" aria-label="Eliminar">
                                        <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $services->links() }}</div>
@endsection
