@extends('layouts.admin')

@section('title', 'Novo projeto | NBTech Admin')
@section('heading', 'Novo projeto')

@section('content')
    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="panel p-6">
        @csrf
        @include('admin.projects._form')
        <div class="mt-6 flex gap-3">
            <button class="btn-primary" type="submit">Guardar</button>
            <a href="{{ route('admin.projects.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
