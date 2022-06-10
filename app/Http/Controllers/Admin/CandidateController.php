<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCandidateRequest;
use App\Models\Candidate;
use App\Models\Responsibility;
use Illuminate\Http\Request;

class CandidateController extends Controller
{

    protected Candidate $repository;
    protected Responsibility $responsibility;

    /**
     * 
     */
    public function __construct(Candidate $cadidate, Responsibility $responsibility)
    {
        $this->repository = $cadidate;
        $this->responsibility = $responsibility;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = $this->repository->paginate();
        return view('admin.pages.candidates.index', ['candidates' => $candidates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responsibilities = $this->responsibilityToOption($this->responsibility->all());
        return view('admin.pages.candidates.create', ['responsibilities' => $responsibilities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCandidateRequest $request)
    {
        $data = $request->except('_token');
        
        $data['main'] = isset($data['main']) ? 1 : 0;

        if(!$this->repository->create($data)) {
            return redirect()->back()->with('error', 'Erro no cadastro do candidato');
        }
        
        return redirect()->route('candidates.index')->with('message', 'Cadastro efetuado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('candidates.index')->with('info', 'Metodo show não existe neste controller');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$candidate = $this->repository->find($id)) {
            return redirect()->route('candidates.index')->with('info', 'Candidato não existe');
        }
        $responsibilities = $this->responsibilityToOption($this->responsibility->all());
        return view('admin.pages.candidates.edit', ['candidate' => $candidate, 'responsibilities' => $responsibilities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCandidateRequest $request, $id)
    {
        if(!$candidate = $this->repository->find($id)) {
            return redirect()->route('candidates.index')->with('info', 'Candidato não existe');
        }
        $data = $request->except('_token');
        $data['main'] = isset($data['main']) ? 1 : 0;

        if(!$candidate->update($data)) {
            return redirect()->back()->with('error', 'Erro na edição do candidato');
        }
        
        return redirect()->route('candidates.index')->with('message', 'Edição efetuada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$candidate = $this->repository->find($id)) {
            return redirect()->route('candidates.index')->with('info', 'Candidato não existe');
        }

        if(!$candidate->delete()) {
            return redirect()->back()->with('error', 'Erro na exclusão do candidato');
        }

        return redirect()->route('candidates.index')->with('message', 'Candidato excluído com sucesso');
    }

    private function responsibilityToOption($responsibilities)
    {
        $responsibilitiesArray = [];
        foreach($responsibilities as $responsibility) {
            $responsibilitiesArray[$responsibility->id] = $responsibility->title;
        }
        return $responsibilitiesArray;
    }
}
