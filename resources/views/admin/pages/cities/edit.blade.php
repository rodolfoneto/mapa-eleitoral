@extends('adminlte::page')

@section('title', "Editar a Cidade {{ $city->name }}")

@section('content_header')
    <h1>Editar a Cidade {{ $city->name }}</h1>
@stop

@section('content')
    
    <form action="{{ route('cities.update', $city->id) }}" method="post" class="form">
        @method('PUT')
        @csrf
        @include('admin.pages.cities.forms.default')
        <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop
