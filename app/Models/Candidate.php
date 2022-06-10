<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['responsibility_id', 'name', 'political_party', 'main'];

    public function responsibility()
    {
        return $this->belongsTo(Responsibility::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }

    public function votesByCityId($cityId)
    {
        return CityCandidate::where('city_id', $cityId)->where('candidate_id', $this->id)->first();
    }
}
