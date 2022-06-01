@csrf
<div class="row">
    <x-adminlte-input name="title" value="{{ $groupField->title ?? old('title') }}"
        label="Nome do Grup de Área" placeholder="Nome" fgroup-class="col-md-6" />
</div>
