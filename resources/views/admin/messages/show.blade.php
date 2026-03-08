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
                <dt class="text-slate-500">Data</dt>
                <dd class="font-semibold">{{ $message->created_at?->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>

        <hr class="my-4 border-slate-200 dark:border-slate-800">

        <h2 class="mb-2 text-base font-semibold">Mensagem</h2>
        <p class="whitespace-pre-wrap text-slate-700 dark:text-slate-200">{{ $message->message }}</p>

        <a href="{{ route('admin.messages.index') }}" class="btn-secondary mt-6">Voltar</a>
    </article>
@endsection
