@extends('adminlte::page')

@section('title', "Editar o GC #{{ $groupField->id }}")

@section('content_header')
    <h1>Editar o Grupo de Campos #{{ $groupField->id }}</h1>
@stop

@section('content')
    
    <form action="{{ route('groupfields.update', $groupField->id) }}" method="post" class="form">
        @method('PUT')
        @include('admin.pages.group-fields.forms.default')
        <x-adminlte-button class="btn-flat" type="submit" label="Editar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop
