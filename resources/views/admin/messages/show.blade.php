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

        <div class="mt-6 flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.messages.index') }}" class="btn-secondary">Voltar</a>

            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" x-data x-ref="deleteForm">
                @csrf
                @method('DELETE')
                <input type="hidden" name="redirect_to_next" value="1">
                <button type="button" class="btn-danger" @click="if (confirm('Eliminar esta mensagem e ir para a seguinte?')) $refs.deleteForm.submit()">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                    Eliminar
                </button>
            </form>
        </div>
    </article>
@endsection
