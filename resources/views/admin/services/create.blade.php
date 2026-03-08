@extends('layouts.admin')

@section('title', 'Novo serviço | NBTech Admin')
@section('heading', 'Novo serviço')

@section('content')
    <form method="POST" action="{{ route('admin.services.store') }}" class="panel p-6">
        @csrf
        @include('admin.services._form')
        <div class="mt-6 flex gap-3">
            <button class="btn-primary" type="submit">Guardar</button>
            <a href="{{ route('admin.services.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
