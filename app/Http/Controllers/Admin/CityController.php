<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCityRequest;
use App\Models\City;
use App\Models\State;

class CityController extends Controller
{

    protected City $repository;
    protected State $state;

    public function __construct(City $city, State $state)
    {
        $this->repository = $city;
        $this->state = $state;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->repository->paginate();
        $states = $this->state->all();

        return view('admin.pages.cities.index',
            [
                'cities' => $cities,
                'states' => $states,
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
            return redirect()->route('cities.index')->with('error', 'Cidade não encontrada');
        }
        return view('admin.pages.cities.show', ['city' => $city]);
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
            return redirect()->route('cities.index')->with('error', 'Cidade não encontrada');
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
            return redirect()->route('cities.index')->with('error', 'Cidade não encontrada');
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
            return redirect()->route('cities.index')->with('errors', 'Cidade não encontrada');
        }
        $city->delete();
        return redirect()->route('cities.index')->with('message', 'Cidade excluída com sucesso');
    }
}
