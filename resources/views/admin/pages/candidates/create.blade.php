@extends('adminlte::page')

@section('title', "Cadastrar um Candidato")

@section('content_header')
    <h1>Cadastrar um Candidato</h1>
@stop

@section('content')
    
    <form action="{{ route('candidates.store') }}" method="post" class="form">
        @csrf
        @include('admin.pages.candidates.forms.default')
        <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop
