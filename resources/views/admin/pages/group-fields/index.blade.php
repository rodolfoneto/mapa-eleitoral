@extends('adminlte::page')

@section('title', 'Grupo de Campos')

@section('content_header')
    <h1>Grupos de Campos <a href="{{ route('groupfields.create') }}" class="btn btn-info"><i class="fas fa-plus"></i></a></h1>
@stop

@section('content')
    <table class="table">
        <thead>
            <th>Nome</th>
            <th width="200px">Ações</th>
        </thead>
        <tbody>
            @foreach ($groupFields as $groupField)
            <tr>
                <td>{{ $groupField->title }}</td>
                <td>
                    <form action="{{ route('groupfields.destroy', $groupField->id) }}" class="form form-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('groupfields.edit', $groupField->id) }}" class="btn btn-info ml1" title="Editar o GF {{ $groupField->title }}"><i class="fas fa-pen"></i></a>
                        <a href="{{ route('groupfields.show', $groupField->id) }}" class="btn btn-info ml1" title="Editar o GF {{ $groupField->title }}"><i class="fas fa-eye"></i></a>
                        <button type="submit" class="btn btn-danger" title="Deletar o GF {{ $groupField->title }}"><i class="fas fa-minus-circle"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
