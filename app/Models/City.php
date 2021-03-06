<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state_id',
        'tse_id',
        'mayor_name',
        'habitant_qty',
        'electures_qty'
    ];

    public function state()
    {
        $this->belongsTo(State::class);
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'city_candidates');
    }

    public function fieldValue()
    {
        return $this->hasMany(FieldValue::class);
    }
}
