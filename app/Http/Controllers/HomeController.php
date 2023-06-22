<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Obtener los articulos publicos (1)
        $articles = Article::where('status', '1')
                    ->orderBy('id', 'desc')
                    ->simplePaginate(10); #Muestra solo 10 y sigue una flecha si hay mas de 10 articulos
        
        //Obtener las categorias con estado publico (1) y destacadas (1)
        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3); 


        return view('home', compact('articles','navbar'));
    }

    //Todas las categorias
    public function all(){
        $categories = Category::where('status', '1')
                   ->simplePaginate(20);
        
        //Obtener las categorias con estado publico (1) y destacadas (1).all-categories
        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);

        return view('home', compact('categories', 'navbar'));
    }
}
