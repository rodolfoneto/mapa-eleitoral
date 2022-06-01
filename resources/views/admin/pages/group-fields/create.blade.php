@extends('adminlte::page')

@section('title', 'Grupo de Campos')

@section('content_header')
    <h1>Adicionar um Grupo de Campos</h1>
@stop

@section('content')
    
    <form action="{{ route('groupfields.store') }}" method="post" class="form">
        @include('admin.pages.group-fields.forms.default')
        <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop
