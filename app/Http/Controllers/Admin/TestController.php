<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Candidate,
    Responsibility,
    City,
    GroupField
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestController extends Controller
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


        // $result = DB::table('cities')
        //     ->select(
        //         'cities.*',
        //         'candidates.name AS candidate_name',
        //         'city_candidates.votes_pp',
        //         'candidates.responsibility_id AS cargo_id',
        //         'responsibilities.title AS cargo',
        //     )
        //     ->join('city_candidates', 'cities.id', '=', 'city_candidates.city_id')
        //     ->join('candidates', 'city_candidates.candidate_id', '=', 'candidates.id')
        //     ->join('responsibilities', 'candidates.responsibility_id', '=', 'responsibilities.id')
        //     ->orderBy('cities.name')
        //     ->where('candidates.main', 1)->get();
        // $a = [];
        // foreach($result as $city) {
        //     // $a[$city->slug] = [];
        //     $a[$city->slug]['slug'] = $city->slug;
        //     $a[$city->slug]['name'] = $city->name;
        //     $a[$city->slug]['ibge_cod'] = $city->ibge_cod;
        //     $ll = Str::slug($city->cargo, '_');
        //     $a[$city->slug][$ll] = [];
        //     $a[$city->slug][$ll]['candidate_name'] = $city->candidate_name;
        //     $a[$city->slug][$ll]['votes'] = $city->votes_pp;
        // }

        // return ['data' => $a];
        // return ['data' => $result];
        // return view('admin.pages.cities.create', ['data' => $result]);


        $cities = $this->repository->all();//orderBy('name', 'asc')->get();
        $result = [];
        foreach($cities as $city) {
            $cityResult = [];
            $cityResult['name'] = $city->name;
            $cityResult['slug'] = $city->slug;
            $cityResult['ibge_cod'] = $city->ibge_cod;
            // $cityResult['candidate'] = [];
            $candidates = [];
            foreach($city->candidates()->where('candidates.main', 1)->withPivot('votes_pp')->get() as $candidate) {
                
                $can = $candidate->toArray();
                $can['votes'] = $can['pivot']['votes_pp'] ?? null;
                unset($can['pivot']);
                $cargo = $candidate->responsibility->toArray();
                $can['responsibility'] = $cargo['title'] ?? null;//$candidate->responsibility->toArray();

                $candidates[] = $can;
            }
            $cityResult['candidates'] = $candidates;
            $result[] = $cityResult;
        }
        // dd($result);
        return view('admin.pages.cities.create', ['data' => $result]);




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
        return view('admin.pages.cities.create', ['data' => $result]);
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
        return view('admin.pages.cities.create', ['data' => $city]);

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
