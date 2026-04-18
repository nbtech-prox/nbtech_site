@extends('layouts.admin')

@section('title', 'Mensagem | NBTech Admin')
@section('heading', 'Detalhe da mensagem')

@section('content')
    <article class="panel p-6 text-sm">
        <dl class="grid gap-4 md:grid-cols-2">
            <div>
                <dt class="text-slate-500">Nome</dt>
                <dd class="font-semibold">{{ $message->name }}</dd>
            </div>
            <div>
                <dt class="text-slate-500">Email</dt>
                <dd class="font-semibold">{{ $message->email }}</dd>
            </div>
            <div>
                <dt class="text-slate-500">Empresa</dt>
                <dd class="font-semibold">{{ $message->company ?: '—' }}</dd>
            </div>
            <div>
                <dt class="text-slate-500">Tipo</dt>
                <dd class="font-semibold">{{ $message->typeLabel() }}</dd>
            </div>
            <div>
                <dt class="text-slate-500">Data</dt>
                <dd class="font-semibold">{{ $message->created_at?->format('d/m/Y H:i') }}</dd>
            </div>
            @if ($message->phone)
                <div>
                    <dt class="text-slate-500">Telefone</dt>
                    <dd class="font-semibold">{{ $message->phone }}</dd>
                </div>
            @endif
            @if ($message->project_type)
                <div>
                    <dt class="text-slate-500">Tipo de projeto</dt>
                    <dd class="font-semibold">{{ $message->projectTypeLabel() }}</dd>
                </div>
            @endif
            @if ($message->budget_range)
                <div>
                    <dt class="text-slate-500">Faixa de investimento</dt>
                    <dd class="font-semibold">{{ $message->budgetRangeLabel() }}</dd>
                </div>
            @endif
            @if ($message->timeline)
                <div>
                    <dt class="text-slate-500">Prazo</dt>
                    <dd class="font-semibold">{{ $message->timelineLabel() }}</dd>
                </div>
            @endif
        </dl>

        <hr class="my-4 border-slate-200 dark:border-slate-800">

        <h2 class="mb-2 text-base font-semibold">Mensagem</h2>
        <p class="whitespace-pre-wrap text-slate-700 dark:text-slate-200">{{ $message->message }}</p>

        <a href="{{ route('admin.messages.index') }}" class="btn-secondary mt-6">Voltar</a>
    </article>
@endsection
