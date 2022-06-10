<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{City, CityCandidate};
use Illuminate\Http\Request;

class CityCandidateController extends Controller
{
    protected CityCandidate $repository;
    protected City $city;

    public function __construct(CityCandidate $repository,  City $city)
    {
        $this->repository = $repository;
        $this->city = $city;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if(!$city = $this->city->find($id)) {
            return redirect()->back()->with('error', 'Problema no cadastro pois é cidade não foi encontrada');
        }
        
        $data = $request->except('_token');
        foreach($data as $candidateId => $vote) {
            // if(count($this->repository->getByCityIdAndCandidateId($city->id, $candidateId)->get()) == 0) {
            //     $this->repository->create(['city_id' => $city->id, 'candidate_id' => $candidateId, 'vote_pp' => $vote]);
            // } else {
            //     $this->repository->update(['city_id' => $city->id, 'candidate_id' => $candidateId, 'vote_pp' => $vote]);
            // }
            if(empty($vote)) {
                $this->repository->where('city_id', $city->id)->where('candidate_id', $candidateId)->delete();
            } else {
                $this->repository->updateOrCreate(['city_id' => $city->id, 'candidate_id' => $candidateId], ['votes_pp' => $vote]);
            }
        }
        return redirect()->back()->with('message', 'Informações cadastradas com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
