@extends('adminlte::page')

@section('title', 'Cargos Eletivos')

@section('content_header')
    <h1>Cargos Eletivos <a href="{{ route('responsibilities.create') }}" class="btn btn-info"><i class="fas fa-plus"></i></a></h1>
@stop

@section('content')
    @include('admin.includes.alert')
    <table class="table">
        <thead>
            <th>Nome</th>
            <th width="120px">Ações</th>
        </thead>
        <tbody>
            @foreach ($responsibilities as $responsibility)
            <tr>
                <td>{{ $responsibility->title }}</td>
                <td>
                    <form action="{{ route('responsibilities.destroy', $responsibility->id) }}" class="form form-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('responsibilities.edit', $responsibility->id) }}" class="btn btn-info mr-1" title="Editar o GF {{ $responsibility->title }}"><i class="fas fa-pen"></i></a>
                        <button type="submit" class="btn btn-danger" title="Deletar o GF {{ $responsibility->title }}"><i class="fas fa-minus-circle"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
