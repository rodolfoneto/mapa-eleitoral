@extends('adminlte::page')

@section('title', "Editar o Cargo Eletivo #" . $responsibility->title)

@section('content_header')
    <h1>Editar o Cargo Eletivo {{ $responsibility->title }}</h1>
@stop

@section('content')
    
    <form action="{{ route('responsibilities.update', $responsibility->id) }}" method="post" class="form">
        @csrf
        @method('PUT')
        @include('admin.pages.responsibilities.forms.default')
        <x-adminlte-button class="btn-flat" type="submit" label="Editar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop
