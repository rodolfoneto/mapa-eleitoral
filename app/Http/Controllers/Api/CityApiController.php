<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityHomeResource;
use App\Models\Candidate;
use App\Models\City;
use App\Models\GroupField;
use App\Models\Responsibility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                    $responsibilityResult['candidate'] = [
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


    public function index2()
    {
        $result = DB::table('cities')
            ->select(
                'cities.*',
                'candidates.name AS candidate_name',
                'city_candidates.votes_pp',
                'candidates.responsibility_id AS cargo_id',
                'responsibilities.title AS cargo',
            )
            ->leftJoin('city_candidates', 'cities.id', '=', 'city_candidates.city_id')
            ->leftJoin('candidates', function($join){
                $join->on('city_candidates.candidate_id', '=', 'candidates.id')
                ->where('candidates.main', 1);
            })
            ->leftJoin('responsibilities', 'candidates.responsibility_id', '=', 'responsibilities.id')
            ->orderBy('cities.name')->get();
        // dd($result);
        $a = [];
        for ($i=0; $i < count($result); $i++) {
            $city = $result[$i];
            $a[$city->slug]['slug'] = $city->slug;
            $a[$city->slug]['name'] = $city->name;
            $a[$city->slug]['ibge_cod'] = $city->ibge_cod;
            $ll = Str::slug($city->cargo, '_');
            $a[$city->slug][$ll] = [];
            $a[$city->slug][$ll]['candidate_name'] = $city->candidate_name;
            $a[$city->slug][$ll]['votes'] = $city->votes_pp;
            $a[$city->slug][$ll]['cargo'] = $city->cargo;
        }
        // foreach( as $city) {
        //     $a[$city->slug]['slug'] = $city->slug;
        //     $a[$city->slug]['name'] = $city->name;
        //     $a[$city->slug]['ibge_cod'] = $city->ibge_cod;
        //     $ll = Str::slug($city->cargo, '_');
        //     $a[$city->slug][$ll] = [];
        //     $a[$city->slug][$ll]['candidate_name'] = $city->candidate_name;
        //     $a[$city->slug][$ll]['votes'] = $city->votes_pp;
        // }

        return ['data' => $a];
    }


    public function index3()
    {
        $cities = $this->repository->all();//orderBy('name', 'asc')->get();
        $result = [];
        foreach($cities as $city) {
            $cityResult = [];
            $cityResult['name'] = $city->name;
            $cityResult['slug'] = $city->slug;
            $cityResult['ibge_cod'] = $city->ibge_cod;
            $candidates = [];
            foreach($city->candidates()->where('candidates.main', 1)->withPivot('votes_pp')->get() as $candidate) {
                
                $can = $candidate->toArray();
                $can['votes'] = $can['pivot']['votes_pp'] ?? null;
                unset($can['pivot']);
                $cargo = $candidate->responsibility->toArray();
                $can['responsibility'] = $cargo['title'] ?? null;

                $candidates[] = $can;
            }
            $cityResult['candidates'] = $candidates;
            $result[] = $cityResult;
        }
        return $result;
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
