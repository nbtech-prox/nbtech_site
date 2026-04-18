@extends('layouts.admin')

@section('title', 'Orçamentos | NBTech Admin')
@section('heading', 'Orçamentos')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <form method="GET" class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
            <input type="text" name="q" value="{{ $search }}" placeholder="Pesquisar por número, título ou cliente" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm sm:w-80 dark:border-slate-700 dark:bg-slate-900">
            <button class="btn-secondary w-full sm:w-auto" type="submit">Pesquisar</button>
        </form>
        <a href="{{ route('admin.quotes.create') }}" class="btn-primary w-full sm:w-auto">Novo orçamento</a>
    </div>

    <div class="panel overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="border-b border-slate-200 text-left dark:border-slate-800">
                <tr>
                    <th class="px-4 py-3">Número</th>
                    <th class="px-4 py-3">Cliente</th>
                    <th class="px-4 py-3">Tipo</th>
                    <th class="px-4 py-3 text-center">Data</th>
                    <th class="px-4 py-3 text-center">Estado</th>
                    <th class="px-4 py-3 text-right">Total</th>
                    <th class="px-4 py-3 text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotes as $quote)
                    <tr class="border-b border-slate-100 dark:border-slate-900">
                        <td class="px-4 py-3 font-semibold">{{ $quote->number }}</td>
                        <td class="px-4 py-3">{{ $quote->client_name }}</td>
                        <td class="px-4 py-3">{{ $quote->document_type === 'fatura-recibo' ? 'Fatura/Recibo' : 'Fatura Proforma' }}</td>
                        <td class="px-4 py-3 text-center">{{ $quote->issue_date?->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-center">{{ $statuses[$quote->status] ?? ucfirst($quote->status) }}</td>
                        <td class="px-4 py-3 text-right">€ {{ number_format((float) $quote->total, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('admin.quotes.show', $quote) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-md text-brand-600 transition hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-brand-900/20" title="Ver" aria-label="Ver">
                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"/><circle cx="12" cy="12" r="2.5"/></svg>
                                </a>
                                <a href="{{ route('admin.quotes.edit', $quote) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-md text-brand-600 transition hover:bg-brand-50 hover:text-brand-700 dark:hover:bg-brand-900/20" title="Editar" aria-label="Editar">
                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" onsubmit="return confirm('Eliminar este orçamento?');">
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

    <div class="mt-6">{{ $quotes->links() }}</div>
@endsection
