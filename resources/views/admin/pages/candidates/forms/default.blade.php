@section('plugins.BootstrapSwitch', true)

<x-adminlte-input name="name" type="text" placeholder="Nome do Candidato" value="{{ $candidate->name ?? old('name') }}" />

<x-adminlte-input name="political_party" type="text" placeholder="Partido Político" value="{{ $candidate->political_party ?? old('political_party') }}" oninput="this.value = this.value.toUpperCase()" />

<x-adminlte-select name="responsibility_id">
    <x-adminlte-options :options="$responsibilities" :selected="$candidate->responsibility_id ?? old('responsibility_id')" empty-option="Selecione um Cargo..."/>
</x-adminlte-select>

@php
    $config = [
        'animate' => true,
        'state' => false,
    ];
    if($candidate->main ?? old('main')) {
        $config['state'] = true;
    }
@endphp
<x-adminlte-input-switch name="main" data-on-text="Sim" data-off-text="Não" label="Candidato Principal" :config="$config"/>
