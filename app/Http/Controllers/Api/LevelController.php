<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Level;
use App\Http\Resources\LevelResource;
use App\Http\Resources\LevelCollection;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new LevelCollection(Level::orderBy('name','ASC')->paginate(8));
    }

    public function search($field, $query)
    {
        return new LevelCollection(Level::where($field,'LIKE',"%$query%")->latest()->paginate(8));
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

        $level = new Level();
        $level->name = $request->name;
        $level->description = $request->description;
        $level->save();

        return new LevelResource($level);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new LevelResource(Level::findOrFail($id));
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
        
        $level = Level::findOrfail($id);
        $level->name = $request->name;
        $level->description = $request->description;
        $level->save();

        return new LevelResource($level);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::findOrfail($id);
        $level->delete();
        return new LevelResource($level);    }
}
