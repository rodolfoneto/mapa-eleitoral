<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityHomeResource;
use App\Models\Candidate;
use App\Models\City;
use App\Models\Responsibility;
use Illuminate\Http\Request;

class CityApiController extends Controller
{
    protected $repository;
    protected $candidate;
    protected $responsibility;

    public function __construct(City $city, Candidate $candidate, Responsibility $responsibility)
    {
        $this->repository = $city;
        $this->candidate = $candidate;
        $this->responsibility = $responsibility;
    }


    public function index()
    {
        // return CityHomeResource::collection($this->repository->all());
        $cities = $this->repository->all();
        $responsibilities = $this->responsibility->all();
        $result = [];
        foreach($cities as $city) {
            $cityResult = [];
            $cityResult['name'] = $city->name;
            $cityResult['slug'] = $city->slug;
            $cityResult['ibge_cod'] = $city->ibge_cod;
            $cityResult['cargo'] = [];
            foreach($responsibilities as $responsibility) {
                $responsibilityResult = [];
                $responsibilityResult = ['title' => $responsibility->title, 'id' => $responsibility->id];
                $candidate = $this->candidate->where('responsibility_id', $responsibility->id)->where('main', 1)->first();
                if(!empty($candidate)) {
                    $responsibilityResult['cadidate'] = [
                        'name' => $candidate->name ?? null,
                        'votes' => $candidate->votesByCityId($city->id)->votes_pp ?? null
                    ];
                }
                $cityResult['cargo'][] = $responsibilityResult;
            }
            $result[] = $cityResult;
        }
        return ['data' => $result];
    }
}
