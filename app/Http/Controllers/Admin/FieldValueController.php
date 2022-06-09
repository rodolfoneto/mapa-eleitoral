<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{City, FieldValue, Field};
use Illuminate\Http\Request;

class FieldValueController extends Controller
{
    protected FieldValue $repository;
    protected City $city;
    protected Field $field;

    public function __construct(FieldValue $fieldValue, City $city, Field $field)
    {
        $this->repository = $fieldValue;
        $this->city = $city;
        $this->field = $field;
    }

    public function store(Request $request, $cityId)
    {
        if(!$city = $this->city->find($cityId)) {
            return redirect()->route('cities.index')->with('error', 'Cidade não encontrada');
        }

        $fieldsValuesRequest = $request->except('_token');
        foreach($fieldsValuesRequest as $key => $value) {
            if($fieldValue = $this->repository->where('city_id', $city->id)->where('field_id', $key)->first()) {
                if(empty(trim($value))) {
                    $fieldValue->delete();
                } else {
                    $fieldValue->update(['value' => $value]);
                }
            } else {
                if(!empty(trim($value))) {
                    $this->repository->create([
                        'field_id' => $key,
                        'city_id' => $city->id,
                        'value' => $value,
                    ]);
                }
            }
        }
        return redirect()->route('cities.show', $city->id);
    }
}
