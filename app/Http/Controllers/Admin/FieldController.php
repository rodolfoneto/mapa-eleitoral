<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFieldRequest;
use App\Models\Field;
use App\Models\GroupField;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    protected Field $repository;
    protected GroupField $groupField;

    public function __construct(Field $field, GroupField $groupField)
    {
        $this->repository = $field;
        $this->groupField = $groupField;
    }


    public function store(StoreUpdateFieldRequest $request, $id)
    {
        $groupField = $this->groupField->find($id);
        $this->repository->create($request->all());
        return redirect()->route('groupfields.show', $groupField->id);
    }


    public function destroy($id, $fieldId)
    {
        if(!$this->groupField->find($id)) {
            return redirect()->back()->with('error', 'Group de Campos não encontrado');
        }
        if(!$field = $this->repository->find($fieldId)) {
            return redirect()->back()->with('error', 'Campo não encontrado');
        }
        $field->delete();
        return redirect()->back()->with('success', 'Campo excluído');
    }
}
