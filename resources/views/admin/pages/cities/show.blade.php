@extends('adminlte::page')

@section('title', 'Cidade ' . $city->name)

@section('content_header')
    <h1>Cidade {{ $city->name }}</h1>
@stop

@section('content')
    @csrf
    @include('admin.includes.alert')


    @foreach ($responsibilities as $responsibility)
    <div class="card">
        <div class="card-header">{{ $responsibility->title }}</div>
        <form action="{{ route('cities.candidates.store', $city->id) }}" method="post">
            @csrf
            <div class="card-body">
                @foreach ($responsibility->candidates()->orderBy('main', 'desc')->get() as $candidate)
                    <div class="row">
                        <div class="col-4">
                            {{ $candidate->name }}
                        </div>
                        <div class="col-8">
                            <x-adminlte-input type="number" step=".01" name="{{ $candidate->id }}" placeholder="% de votos" value="{{ $candidate->votesByCityId($city->id)->votes_pp ?? '' }}" />
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
            </div>
        </form>
    </div>
    @endforeach


    <div class="card">
        <div class="card-header">
            Campos Personalizados
        </div>
        <form action="{{ route('fieldvalues.store', $city->id) }}" method="post">
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
        </form>
    </div>
@stop
