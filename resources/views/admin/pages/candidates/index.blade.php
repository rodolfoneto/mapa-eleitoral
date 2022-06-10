@extends('adminlte::page')

@section('title', 'Candidatos')

@section('content_header')
    <h1>Candidatos <a href="{{ route('candidates.create') }}" class="btn btn-info"><i class="fas fa-plus"></i></a></h1>
@stop

@section('content')
    @include('admin.includes.alert')
<div class="card">
    <div class="card-header">
        {{-- <form>
            <x-adminlte-input name="q" placeholder="termo" igroup-size="md" value="{{ $filters['q'] ?? '' }}">
                <x-slot name="appendSlot">
                    <x-adminlte-button theme="outline-danger" label="Ir!"/>
                </x-slot>
                <x-slot name="prependSlot">
                    <div class="input-group-text text-danger">
                        <i class="fas fa-search"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </form> --}}
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Nome</th>
                <th>Partido</th>
                <th>Pricinpal</th>
                <th width="200px">Ações</th>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->political_party }}</td>
                    <td>{{ $candidate->main == 1 ? 'Sim' : 'Não' }}</td>
                    <td>
                        <form action="{{ route('candidates.destroy', $candidate->id) }}" class="form form-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-info mr-1" title="Editar o GF {{ $candidate->name }}"><i class="fas fa-pen"></i></a>
                            <button type="submit" class="btn btn-danger" title="Deletar o Candidato {{ $candidate->name }}"><i class="fas fa-minus-circle"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
         :D
        @if (!empty($filters))
            {!! $candidates->appends($filters)->links() !!}
        @else
            {!! $candidates->links() !!}
        @endif
    </div>
</div>
@stop
