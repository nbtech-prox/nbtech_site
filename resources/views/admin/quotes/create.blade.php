@extends('layouts.admin')

@section('title', 'Novo orçamento | NBTech Admin')
@section('heading', 'Novo orçamento')

@section('content')
    <form method="POST" action="{{ route('admin.quotes.store') }}" class="panel p-6">
        @csrf
        @include('admin.quotes._form')

        <div class="mt-6 flex gap-3">
            <button class="btn-primary" type="submit">Guardar orçamento</button>
            <a href="{{ route('admin.quotes.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
