<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Helpers\Helper;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->paginate(7);

        return view('admin.categories.index', compact('categories', 'swiperCategories'));
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
        \DB::beginTransaction();

        try{

            $this->validate($request, [
                'name'      => 'required',
                'slug'      => 'unique:categories',
                'picture'   => 'required'
            ]);

            $category = Category::create($request->all());

            if($request->file('picture')){
                //Se crea el path y se sube el archivo al servidor
                $path = Helper::uploadFile('picture', 'public/categories');
                //Se actualiza el campo en la DB con la ruta de la image ($path)
                $category->fill(['picture' => $path])->save();
            }

            $success = true;

        }catch (Exception $e) {
            $success = $e->getMessage();
            \DB::rollBack();
        }

        if($success === true) {
            \DB::commit();
            return 'Categoria guardada con exito';
        }
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
    public function destroy(Category $category)
    {
        \DB::beginTransaction();
        try{

            //Eliminamos el role 
            $category->delete();
            

            //Se devuelve la respuesta al AJAX
            $success = true;
            
        }catch(Exception $e){

            $success = $exception->getMessage();
            \DB::rollBack();
        }

        if($success === true) {
            //Eliminamos la imagen del servidor
            \Storage::delete('public/categories/' . $category->picture);
            \DB::commit();
            return 'Categoria guardada con exito';
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function getCategories(Request $request){

        $categories = Category::orderBy('id', 'DESC')->paginate(8);

        return [
            'pagination' => [
                'total'         => $categories->total(),
                'current_page'  => $categories->currentPage(),
                'per_page'      => $categories->perPage(),
                'last_page'     => $categories->lastPage(),
                'from'          => $categories->firstItem(),
                'to'            => $categories->lastItem(),
            ],
            'categories' => $categories
        ];

    }
}
