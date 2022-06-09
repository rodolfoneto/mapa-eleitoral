<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateResponsibilityRequest;
use App\Models\Responsibility;

class ResponsibilityController extends Controller
{

    protected Responsibility $repository;

    public function __construct(Responsibility $responsibility)
    {
        $this->repository = $responsibility;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsibilities = $this->repository->paginate();
        return view('admin.pages.responsibilities.index', ['responsibilities' => $responsibilities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.responsibilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateResponsibilityRequest $request)
    {
        if(!$this->repository->create($request->all()))
        {
            return redirect()->back();
        }
        return redirect()->route('responsibilities.index')->with('message', 'Cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('responsibilities.index')->with('info', 'Metodo Show não existe nesse Controller');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$responsibility = $this->repository->find($id)) {
            return redirect()->route('responsibilities.index')->with('info', 'Cargo não encontrado');
        }
        return view('admin.pages.responsibilities.edit', ['responsibility' => $responsibility]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateResponsibilityRequest $request, $id)
    {
        if(!$responsibility = $this->repository->find($id)) {
            return redirect()->route('responsibilities.index')->with('info', 'Cargo não encontrado');
        }
        $responsibility->update($request->all());
        return redirect()->route('responsibilities.index')->with('message', 'Editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$responsibility = $this->repository->find($id)) {
            return redirect()->route('responsibilities.index')->with('errors', 'Cargo não encontrado');
        }
        $responsibility->delete();
        return redirect()->route('responsibilities.index')->with('message', 'Cergo excluído com sucesso');
    }
}
