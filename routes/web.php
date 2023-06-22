<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');


//Articulos
Route::resource('articles', ArticleController::class)
                ->except('show')
                ->names('articles');

// Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

// Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
// Route::delete('/articles/{article}',[ArticleController::class, 'destroy'])->name('articles.destroy');

//Categorias
Route::resource('categories', CategoryController::class)
                ->except('show')
                ->names('categories');

//Commentarios
Route::resource('comments', CommentController::class)
       ->only('index', 'destroy')
       ->names('comments');

//Perfiles
Route::resource('profiles', ProfileController::class)
                ->only('edit','update')
                ->names('profiles');

//Ver articulos
Route::get('article/{article}', [ArticleController::class, 'show'])->name('articles.show');
//Ver articulo por categoria
Route::get('category/{category}', [CategoryController::class,'detail'])->name('categories.detail');

//guardar los comentarios
Route::get('/comment', [CommentController::class, 'store'])->name('comments.store');

Auth::routes();