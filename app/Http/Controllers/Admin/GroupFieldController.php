<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateGroupRequest;
use App\Models\GroupField;

class GroupFieldController extends Controller
{

    protected GroupField $repository;

    public function __construct(GroupField $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupFields = $this->repository->paginate();
        return view('admin.pages.group-fields.index', ['groupFields' => $groupFields]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.group-fields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateGroupRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('groupfields.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$grooupField = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'GC não encontrado');
        }
        return view('admin.pages.group-fields.show', ['groupField' => $grooupField]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$grooupField = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'GC não encontrado');
        }
        return view('admin.pages.group-fields.edit', ['groupField' => $grooupField]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateGroupRequest $request, $id)
    {
        if(!$groupField = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'GC não encontrado');
        }
        $groupField->update($request->all());
        return redirect()->route('groupfields.index')->with('success', "GC #{$groupField->id} editado com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$groupField = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'GP não encontrado');
        }
        $groupField->delete();
        return redirect()->route('groupfields.index')->with('success', "GC #{$id} deletado com sucesso.");
    }
}
