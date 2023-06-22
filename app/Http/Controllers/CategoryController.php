<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        //Mostrar categorias en el admin
        $categories = Category::ordrBy('id', 'desc')
                                ->simplePaginate(8);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request){
        $category = $request->all();

        if($request->hasFile('image')){
            $category['image'] = $request->file('image')->store('categories');
        }

        //Guardamos la informacion
        Category::create($category);

        return redirect()->action([CategoryController::class, 'index'])
                        ->with('success-create', 'Categoria creado con exito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category){
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //si el usuario sube una nueva imagen
        if($request->hasFile('image')){
            //Eliminar imagen
            File::delete(public_path('storage/'. $category->image));
            //asigna la nueva imagen
            $article['image'] = $request->file('image')->storage('categories');
        }

        //Actualizar los datos'image' => $request->image,
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'is_featured' => $request->is_featured,
            'status' => $request->status
        ]);

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                        ->with('success-update', 'Categoria modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //Eliminar la imagen del categoria
        if($category->image){
            File::delete(public_path('storage/'. $category->image));
        }

        //Eliminamos la categoria
        $category->delete();

        return redirect()->action([categoryController::class, 'index'], compact('category'))
                        ->with('success-delete', 'Categoria eliminado con exito');
    }

    //Filtrar articulo por categoria
    public function detail(Category $category){
        
        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1']
        ])->orderBy('id','desc')
        ->simplePaginate(5);

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3); 

        return view('subscriber.categories.detail', compact('articles','category','navbar'));
    }
}
