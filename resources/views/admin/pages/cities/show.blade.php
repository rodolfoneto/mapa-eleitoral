@extends('adminlte::page')

@section('title', 'Cidade ' . $city->name)

@section('content_header')
    <h1>Cidade {{ $city->name }}</h1>
@stop

@section('content')
<form action="{{ route('fieldvalues.store', $city->id) }}" method="post">
    @csrf
    @include('admin.includes.alert')
    <div class="card">
        <div class="card-header">
            Campos para Preencher
        </div>

        <div class="card-body">
            @foreach ($groupFields as $groupField)
                <p><b>{{ $groupField->title }}</b></p>
                @foreach($groupField->fields()->orderBy('id')->get() as $field)
                    <x-adminlte-input name="{{ $field->id }}" type="text" value="{{ $field->fieldValueByCity($city)->value ?? old($field->id) }}" placeholder="{{ $field->placeholder}}"/>
                @endforeach
            @endforeach
        </div>
        
        <div class="card-footer">
            <x-adminlte-button class="btn-flat" type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
        </div>
    </div>
</form>
@stop







{{-- @foreach ($groupFields as $groupField)
    {{ $groupField->title }}
    @foreach($groupField->fields as $field)
        {{ $field->placeholder }}
    @endforeach
@endforeach --}}
