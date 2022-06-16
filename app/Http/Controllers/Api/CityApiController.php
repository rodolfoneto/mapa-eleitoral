<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityHomeResource;
use App\Models\Candidate;
use App\Models\City;
use App\Models\GroupField;
use App\Models\Responsibility;

class CityApiController extends Controller
{
    protected City $repository;
    protected Candidate $candidate;
    protected Responsibility $responsibility;

    public function __construct(
        City $city,
        Candidate $candidate,
        Responsibility $responsibility,
        protected GroupField $groupField,
    ) {
        $this->repository = $city;
        $this->candidate = $candidate;
        $this->responsibility = $responsibility;
    }


    public function index()
    {
        // return CityHomeResource::collection($this->repository->all());
        $cities = $this->repository->orderBy('name', 'asc')->get();
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



    public function byCity($slug)
    {

        $city = $this->repository->where('slug', $slug)->first();

        $candidates = $this->candidate->all();
        foreach($candidates as $candidate) {
            $candidate['vote'] = $candidate->votesByCityId($city->id);
            $candidate['responsibility'] = $candidate->responsibility;
        }
        $city['candidates'] = $candidates;

        $groupFields = $this->groupField->all();
        foreach($groupFields as $groupField) {
            $fields = $groupField->fields;
            foreach($fields as $field) {
                $field['value'] = $field->fieldValueByCity($city);
            }
            $groupField['field'] = $field;
        }
        $city['groupFields'] = $groupFields;

        return $city;


        // return CityHomeResource::collection($this->repository->all());
        // $cities = $this->repository->orderBy('name', 'asc')->get();
        // $responsibilities = $this->responsibility->all();
        // $result = [];
        // foreach($cities as $city) {
        //     $cityResult = [];
        //     $cityResult['name'] = $city->name;
        //     $cityResult['slug'] = $city->slug;
        //     $cityResult['ibge_cod'] = $city->ibge_cod;
        //     $cityResult['cargo'] = [];
        //     foreach($responsibilities as $responsibility) {
        //         $responsibilityResult = [];
        //         $responsibilityResult = ['title' => $responsibility->title, 'id' => $responsibility->id];
        //         $candidate = $this->candidate->where('responsibility_id', $responsibility->id)->where('main', 1)->first();
        //         if(!empty($candidate)) {
        //             $responsibilityResult['cadidate'] = [
        //                 'name' => $candidate->name ?? null,
        //                 'votes' => $candidate->votesByCityId($city->id)->votes_pp ?? null
        //             ];
        //         }
        //         $cityResult['cargo'][] = $responsibilityResult;
        //     }
        //     $result[] = $cityResult;
        // }
        // return ['data' => $result];
    }
}
