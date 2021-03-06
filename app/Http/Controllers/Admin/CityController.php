<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCityRequest;
use App\Models\Candidate;
use App\Models\City;
use App\Models\GroupField;
use App\Models\Responsibility;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{

    protected City $repository;
    protected State $state;
    protected GroupField $groupFields;
    protected Candidate $candidate;
    protected Responsibility $responsibility;

    public function __construct(City $city, State $state, GroupField $groupFields, Candidate $candidate, Responsibility $responsibility)
    {
        $this->repository = $city;
        $this->state = $state;
        $this->groupFields = $groupFields;
        $this->candidate = $candidate;
        $this->responsibility = $responsibility;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->repository;
        $filters = [];
        if($startWith = filter_input(INPUT_GET, 'startWith')) {
            $query = $query->where('name', 'LIKE', "{$startWith}%");
            $filters['startWith'] = $startWith;
        }
        if($q = filter_input(INPUT_GET, 'q')) {
            $query = $query
                ->where('name', 'LIKE', "%{$q}%");
            $filters['q'] = $q;
        }
        $cities = $query->paginate();
        $states = $this->state->all();

        return view('admin.pages.cities.index',
            [
                'cities' => $cities,
                'states' => $states,
                'filters' => $filters,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = $this->state->all();
        return view('admin.pages.cities.create', ['states' => $states]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCityRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$city = $this->repository->find($id)) {
            return redirect()->route('cities.index')->with('error', 'Cidade n??o encontrada');
        }
        $groupFields = $this->groupFields->all();
        $responsibilities = $this->responsibility->all();
        return view('admin.pages.cities.show', ['city' => $city, 'groupFields' => $groupFields, 'responsibilities' => $responsibilities]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$city = $this->repository->find($id)) {
            return redirect()->route('cities.index')->with('error', 'Cidade n??o encontrada');
        }
        // $states = $this->state->all();
        return view('admin.pages.cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCityRequest $request, $id)
    {
        if(!$city = $this->repository->find($id)) {
            return redirect()->route('cities.index')->with('error', 'Cidade n??o encontrada');
        }
        $city->update($request->all());
        return redirect()->route('cities.index')->with('message', 'Cidade editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$city = $this->repository->find($id)) {
            return redirect()->route('cities.index')->with('errors', 'Cidade n??o encontrada');
        }
        $city->delete();
        return redirect()->route('cities.index')->with('message', 'Cidade exclu??da com sucesso');
    }
}
