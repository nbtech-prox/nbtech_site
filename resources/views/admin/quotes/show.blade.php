@extends('layouts.admin')

@section('title', 'Orçamento | NBTech Admin')
@section('heading', 'Detalhe do orçamento')

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <div>
            <p class="text-xs uppercase tracking-widest text-slate-500">{{ $quote->number }}</p>
            <h2 class="text-2xl font-semibold">{{ $quote->title }}</h2>
            <p class="text-sm text-slate-600 dark:text-slate-300">{{ $quote->client_name }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.quotes.pdf', [$quote, 'orcamento']) }}?v={{ now()->timestamp }}" class="btn-secondary">PDF Orçamento</a>
            @if ($quote->proforma_number)
                <a href="{{ route('admin.quotes.pdf', [$quote, 'proforma']) }}?v={{ now()->timestamp }}" class="btn-secondary">PDF Fatura Proforma</a>
            @endif
            @if ($quote->invoice_receipt_number)
                <a href="{{ route('admin.quotes.pdf', [$quote, 'fatura-recibo']) }}?v={{ now()->timestamp }}" class="btn-secondary">PDF Fatura/Recibo</a>
            @endif
            @if ($canMarkInvoiced)
                <form method="POST" action="{{ route('admin.quotes.mark-invoiced', $quote) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-secondary">Marcar como emitido</button>
                </form>
            @endif
            @if ($canMarkPaid)
                <form method="POST" action="{{ route('admin.quotes.mark-paid', $quote) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-secondary">Marcar como pago</button>
                </form>
            @endif
            <a href="{{ route('admin.quotes.edit', $quote) }}" class="btn-primary">Editar</a>
        </div>
    </div>

    <article class="panel p-6">
        <div class="mb-6 grid gap-4 text-sm md:grid-cols-3">
            <div>
                <p class="text-slate-500">Emissão</p>
                <p class="font-semibold">{{ $quote->issue_date?->format('d/m/Y') }}</p>
            </div>
            @if ($quote->document_type === 'proforma')
                <div>
                    <p class="text-slate-500">Validade</p>
                    <p class="font-semibold">{{ $quote->due_date?->format('d/m/Y') ?: '—' }}</p>
                </div>
            @endif
            <div>
                <p class="text-slate-500">Estado</p>
                <p class="font-semibold">{{ $statuses[$quote->status] ?? ucfirst($quote->status) }}</p>
            </div>
            <div>
                <p class="text-slate-500">Tipo</p>
                <p class="font-semibold">{{ $documentTypes[$quote->document_type] ?? '—' }}</p>
            </div>
            <div>
                <p class="text-slate-500">Nº Proforma</p>
                <p class="font-semibold">{{ $quote->proforma_number ?: '—' }}</p>
            </div>
            <div>
                <p class="text-slate-500">Nº Fatura/Recibo</p>
                <p class="font-semibold">{{ $quote->invoice_receipt_number ?: '—' }}</p>
            </div>
            <div>
                <p class="text-slate-500">Email</p>
                <p class="font-semibold">{{ $quote->client_email ?: '—' }}</p>
            </div>
            <div>
                <p class="text-slate-500">Telefone</p>
                <p class="font-semibold">{{ $quote->client_phone ?: '—' }}</p>
            </div>
            <div>
                <p class="text-slate-500">NIF</p>
                <p class="font-semibold">{{ $quote->client_nif ?: '—' }}</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-slate-200 text-left dark:border-slate-700">
                    <tr>
                        <th class="px-3 py-2">Descrição</th>
                        <th class="px-3 py-2 text-right">Qtd.</th>
                        <th class="px-3 py-2 text-right">Preço Unit.</th>
                        <th class="px-3 py-2 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quote->items as $item)
                        <tr class="border-b border-slate-100 dark:border-slate-800">
                            <td class="px-3 py-2">{{ $item->description }}</td>
                            <td class="px-3 py-2 text-right">{{ number_format((float) $item->quantity, 2, ',', '.') }}</td>
                            <td class="px-3 py-2 text-right">€ {{ number_format((float) $item->unit_price, 2, ',', '.') }}</td>
                            <td class="px-3 py-2 text-right">€ {{ number_format((float) $item->line_total, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 ml-auto w-full max-w-xs space-y-2 text-sm">
            <div class="flex items-center justify-between"><span>Subtotal</span><strong>€ {{ number_format((float) $quote->subtotal, 2, ',', '.') }}</strong></div>
            <div class="flex items-center justify-between"><span>IVA ({{ number_format((float) $quote->tax_rate, 2, ',', '.') }}%)</span><strong>€ {{ number_format((float) $quote->tax_total, 2, ',', '.') }}</strong></div>
            <div class="flex items-center justify-between border-t border-slate-300 pt-2 text-base font-semibold dark:border-slate-700"><span>Total</span><strong>€ {{ number_format((float) $quote->total, 2, ',', '.') }}</strong></div>
        </div>

        @if ($quote->notes)
            <div class="mt-6 rounded-lg border border-slate-200 p-3 text-sm dark:border-slate-700">
                <h3 class="mb-1 font-semibold">Notas</h3>
                <p class="whitespace-pre-wrap">{{ $quote->notes }}</p>
            </div>
        @endif
    </article>
@endsection
