@extends('adminlte::page')

@section('title', "Cadastrar uma Cidade")

@section('content_header')
    <h1>Cadastrar uma Cidade</h1>
@stop

@section('content')
    
    <form action="{{ route('cities.store') }}" method="post" class="form">
        @csrf
        @include('admin.pages.cities.forms.default')
        <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop
