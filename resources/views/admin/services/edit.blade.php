@extends('layouts.admin')

@section('title', 'Editar serviço | NBTech Admin')
@section('heading', 'Editar serviço')

@section('content')
    <form method="POST" action="{{ route('admin.services.update', $service) }}" class="panel p-6">
        @csrf
        @method('PUT')
        @include('admin.services._form', ['service' => $service])
        <div class="mt-6 flex gap-3">
            <button class="btn-primary" type="submit">Atualizar</button>
            <a href="{{ route('admin.services.index') }}" class="btn-secondary">Voltar</a>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="mt-4" onsubmit="return confirm('Eliminar serviço?')">
        @csrf
        @method('DELETE')
        <button class="inline-flex items-center gap-2 rounded-lg border border-rose-400 px-4 py-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-50 dark:border-rose-700 dark:text-rose-300 dark:hover:bg-rose-950/40" type="submit">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg>
            <span>Eliminar serviço</span>
        </button>
    </form>
@endsection
