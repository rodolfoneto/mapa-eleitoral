@extends('adminlte::page')

@section('title', 'GP ' . $groupField->title)

@section('content_header')
    <h1>Detalhes GP {{ $groupField->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @include('admin.includes.alert')
            Campos desse Grupo
        </div>

        <div class="card-body">
            @if (count($fields) == 0)
                Sem campos no momento
            @else
                @foreach ($fields as $field)
                    <form action="{{ route('fields.delete', [$groupField->id, $field->id]) }}" class="form" method="post">
                        @csrf
                        @method('DELETE')
                        <x-adminlte-input name="{{ $field->id }}" placeholder="{{ $field->placeholder }}" igroup-size="sl" disabled>
                            <x-slot name="appendSlot">
                                <x-adminlte-button class="btn-sm" type="submit" class="mr-2 mb-2" theme="outline-danger" icon="fas fa-lg fa-trash"/>
                            </x-slot>
                        </x-adminlte-input>
                    </form>
                @endforeach
            @endif
        </div>

        <div class="card-footer">
            <b>Novo</b>
            <form action="{{ route('fields.store', $groupField->id) }}" method="post">
                @csrf
                <x-adminlte-input name="placeholder"/>
                <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
            </form>
        </div>
    </div>
@stop