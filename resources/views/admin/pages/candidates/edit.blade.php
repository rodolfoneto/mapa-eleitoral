@extends('adminlte::page')

@section('title', "Editar o Candidato {{ $candidate->name }}")

@section('content_header')
    <h1>Editar o Candidato {{ $candidate->name }}</h1>
@stop

@section('content')
    
    <form action="{{ route('candidates.update', $candidate->id) }}" method="post" class="form">
        @method('PUT')
        @csrf
        @include('admin.pages.candidates.forms.default')
        <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop
