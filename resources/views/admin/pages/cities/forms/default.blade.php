<x-adminlte-input name="name" type="text" placeholder="Nome da Cidade" value="{{ $city->name ?? old('name') }}"/>

{{-- @php
    $options = [];
    foreach ($states as $state) {
        $options[$state->id] = $state->name;
        $selected = 1;
    }
@endphp --}}

<input type="hidden" name="state_id" value="1">

<x-adminlte-input name="tse_id" type="text" placeholder="Identificação do TSE"  value="{{ $city->tse_id ?? old('tse_id') }}"/>

<x-adminlte-input name="mayor_name" type="text" placeholder="Nome do Prefeito" value="{{ $city->mayor_name ?? old('mayor_name') }}"/>

<x-adminlte-input name="habitant_qty" type="number" placeholder="Quantidade de habitantes" value="{{ $city->habitant_qty ?? old('habitant_qty') }}"/>

<x-adminlte-input name="electures_qty" type="number" placeholder="Quantidade de eleitores" value="{{ $city->electures_qty ?? old('electures_qty') }}"/>
