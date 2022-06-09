@extends('adminlte::page')

@section('title', 'Cidades')

@section('content_header')
    <h1>Cidades <a href="{{ route('cities.create') }}" class="btn btn-info"><i class="fas fa-plus"></i></a></h1>
@stop

@section('content')
    @include('admin.includes.alert')
<div class="card">
    <div class="card-header">
:D
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Nome</th>
                <th width="200px">Ações</th>
            </thead>
            <tbody>
                @foreach ($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>
                        <form action="{{ route('cities.destroy', $city->id) }}" class="form form-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-info mr-1" title="Editar o GF {{ $city->title }}"><i class="fas fa-pen"></i></a>
                            <a href="{{ route('cities.show', $city->id) }}" class="btn btn-info mr-1" title="Editar o GF {{ $city->title }}"><i class="fas fa-eye"></i></a>
                            <button type="submit" class="btn btn-danger" title="Deletar o City {{ $city->title }}"><i class="fas fa-minus-circle"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {!! $cities->links() !!}
    </div>
</div>
@stop
