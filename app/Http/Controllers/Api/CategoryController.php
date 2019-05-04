<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Helpers\Helper;
use App\Http\Resources\Administration\CategoryResource;
use App\Http\Resources\Administration\CategoryCollection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CategoryCollection(Category::orderBy('name','ASC')->paginate(8));
    }

    public function search($field, $query)
    {
        return new CategoryCollection(Category::where($field,'LIKE',"%$query%")->latest()->paginate(8));
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
            'picture'           => 'required|mimes:jpeg,png',
        ]);

        $category = Category::create($request->all());

        if($request->file('picture')){
            //Se crea el path y se sube el archivo al servidor
            $path = Helper::uploadFile('picture', 'public/categories');
            //Se actualiza el campo en la DB con la ruta de la image ($path)
            $category->fill(['picture' => $path])->save();
        }

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CategoryResource(Category::findOrFail($id));
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
            'picture'           => 'mimes:jpeg,png',
        ]);

        $category = Category::findOrfail($id);

        $category->update($request->only(['name']));

        if($request->file('picture')){
            //Eliminamos la imagen anterior del servidor
            \Storage::delete('public/categories/' . $category->picture);
            //Se crea el path y se sube el archivo al servidor
            $path = Helper::uploadFile('picture', 'public/categories');
            //Se actualiza el campo en la DB con la ruta de la image ($path)
            $category->fill(['picture' => $path])->save();
        }

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        //Eliminamos la imagen del servidor
        \Storage::delete('public/categories/' . $category->picture);
        
        $category->delete();

        return new CategoryResource($category);
    }
}
