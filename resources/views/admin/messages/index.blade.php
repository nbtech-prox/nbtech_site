@extends('layouts.admin')

@section('title', 'Mensagens | NBTech Admin')
@section('heading', 'Mensagens e pedidos')

@section('content')
    <div class="mb-4">
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="q" value="{{ $search }}" placeholder="Pesquisar por nome ou email" class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900">
            <select name="type" class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900">
                <option value="">Todos os tipos</option>
                @foreach ($types as $typeKey => $typeLabel)
                    <option value="{{ $typeKey }}" @selected(($selectedType ?? '') === $typeKey)>{{ $typeLabel }}</option>
                @endforeach
            </select>
            <button class="btn-secondary" type="submit">Pesquisar</button>
            @if ($search !== '' || ($selectedType ?? '') !== '')
                <a href="{{ route('admin.messages.index') }}" class="btn-secondary">Limpar</a>
            @endif
        </form>
    </div>

    <div class="panel overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="border-b border-slate-200 text-left dark:border-slate-800">
                <tr>
                    <th class="px-4 py-3">Nome</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Tipo</th>
                    <th class="px-4 py-3">Empresa</th>
                    <th class="px-4 py-3 text-center">Data</th>
                    <th class="px-4 py-3 text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr class="border-b border-slate-100 dark:border-slate-900">
                        <td class="px-4 py-3">{{ $message->name }}</td>
                        <td class="px-4 py-3">{{ $message->email }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $message->type === \App\Support\ContactMessageTypes::BUDGET ? 'bg-brand-100 text-brand-800 dark:bg-brand-900/40 dark:text-brand-300' : 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200' }}">
                                {{ $message->typeLabel() }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $message->company ?: '—' }}</td>
                        <td class="px-4 py-3 text-center">{{ $message->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <a class="inline-flex h-8 w-8 items-center justify-center rounded-md text-brand-600 transition hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-brand-900/20" href="{{ route('admin.messages.show', $message) }}" title="Ver" aria-label="Ver">
                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"/><circle cx="12" cy="12" r="2.5"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Eliminar esta mensagem?');">
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

    <div class="mt-6">{{ $messages->links() }}</div>
@endsection
