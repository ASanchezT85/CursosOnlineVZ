<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Status;
use App\Http\Resources\Administration\StatusResource;
use App\Http\Resources\Administration\StatusCollection;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StatusCollection(Status::orderBy('name','ASC')->paginate(8));
    }

    public function search($field, $query)
    {
        return new StatusCollection(Status::where($field,'LIKE',"%$query%")->latest()->paginate(8));
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
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required',
            'description'       => 'required',
        ]);

        $status = new Status();
        $status->name = $request->name;
        $status->description = $request->description;
        $status->save();

        return new StatusResource($status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new StatusResource(Status::findOrFail($id));
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
        $this->validate($request,[
            'name'              => 'required',
            'description'       => 'required',
        ]);
        
        $status = Status::findOrfail($id);
        $status->name = $request->name;
        $status->description = $request->description;
        $status->save();

        return new StatusResource($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::findOrfail($id);
        $status->delete();
        return new StatusResource($status);
    }
}
