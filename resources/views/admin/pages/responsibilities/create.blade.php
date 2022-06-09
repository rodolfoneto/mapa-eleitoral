@extends('adminlte::page')

@section('title', 'Cargo Eletivo')

@section('content_header')
    <h1>Adicionar um Cargo Eletivo</h1>
@stop

@section('content')
    
    <form action="{{ route('responsibilities.store') }}" method="post" class="form">
        @csrf
        @include('admin.pages.responsibilities.forms.default')
        <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop
