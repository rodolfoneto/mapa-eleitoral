<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityCandidate extends Model
{
    use HasFactory;

    protected $fillable = ['city_id', 'candidate_id', 'votes_pp'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function getByCityIdAndCandidateId($cityId, $candidateIt)
    {
        return $this->where('city_id', $cityId)->where('candidate_id', $candidateIt);
    }
}
