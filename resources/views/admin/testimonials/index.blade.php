@extends('layouts.admin')

@section('title', 'Testemunhos | NBTech Admin')
@section('heading', 'Testemunhos')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row sm:flex-wrap">
            <input type="text" name="q" value="{{ $search }}" placeholder="Pesquisar testemunho" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm sm:w-64 dark:border-slate-700 dark:bg-slate-900">
            <select name="status" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm sm:w-44 dark:border-slate-700 dark:bg-slate-900">
                <option value="">Todos os estados</option>
                @foreach ($statuses as $statusKey => $statusLabel)
                    <option value="{{ $statusKey }}" @selected($selectedStatus === $statusKey)>{{ $statusLabel }}</option>
                @endforeach
            </select>
            <button class="btn-secondary w-full sm:w-auto" type="submit">Pesquisar</button>
            @if ($search !== '' || $selectedStatus !== '')
                <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary w-full sm:w-auto">Limpar</a>
            @endif
        </form>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-primary w-full sm:w-auto">Novo testemunho</a>
    </div>

    <div class="panel overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="border-b border-slate-200 text-left dark:border-slate-800">
                <tr><th class="px-4 py-3">Nome</th><th class="px-4 py-3">Empresa</th><th class="px-4 py-3 text-center">Pontuação</th><th class="px-4 py-3 text-center">Estado</th><th class="px-4 py-3 text-center">Ações</th></tr>
            </thead>
            <tbody>
                @foreach ($testimonials as $testimonial)
                    <tr class="border-b border-slate-100 dark:border-slate-900">
                        <td class="px-4 py-3">{{ $testimonial->name }}</td>
                        <td class="px-4 py-3">{{ $testimonial->company }}</td>
                        <td class="px-4 py-3 text-center text-amber-500">{{ str_repeat('★', (int) ($testimonial->rating ?? 5)) }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $testimonial->status === 'approved' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300' }}">
                                {{ $statuses[$testimonial->status] ?? ucfirst($testimonial->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-3">
                                @if ($testimonial->status !== 'approved')
                                    <form method="POST" action="{{ route('admin.testimonials.approve', $testimonial) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-md text-emerald-600 transition hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-emerald-900/20" title="Aprovar" aria-label="Aprovar">
                                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m5 13 4 4L19 7"/></svg>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.testimonials.pending', $testimonial) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-md text-amber-600 transition hover:bg-amber-50 hover:text-amber-700 dark:hover:bg-amber-900/20" title="Marcar pendente" aria-label="Marcar pendente">
                                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8v5"/><path d="M12 16h.01"/><circle cx="12" cy="12" r="9"/></svg>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-md text-brand-600 transition hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-brand-900/20" title="Editar" aria-label="Editar">
                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Eliminar este testemunho?');">
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

    <div class="mt-6">{{ $testimonials->links() }}</div>
@endsection
