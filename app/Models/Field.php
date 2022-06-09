<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['group_field_id', 'type', 'uuid', 'placeholder'];

    public function groups()
    {
        return $this->belongsTo(GroupField::class);
    }

    public function fieldValue()
    {
        return $this->hasMany(FieldValue::class);
    }

    public function fieldValueByCity(City $city)
    {
        return FieldValue::
            where('city_id', $city->id)
            ->where('field_id', $this->id)->first();
    }

    public function fieldValueByFieldAndCity($fieldId, City $city)
    {
        return FieldValue::
            where('city_id', $city->id)
            ->where('field_id', $fieldId)->first();
    }
}
