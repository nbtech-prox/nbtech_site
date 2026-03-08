@extends('layouts.admin')

@section('title', 'Novo testemunho | NBTech Admin')
@section('heading', 'Novo testemunho')

@section('content')
    <form method="POST" action="{{ route('admin.testimonials.store') }}" class="panel p-6">
        @csrf
        @include('admin.testimonials._form')
        <div class="mt-6 flex gap-3">
            <button class="btn-primary" type="submit">Guardar</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
