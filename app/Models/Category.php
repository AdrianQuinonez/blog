<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    //Relacion de uno a muchos (Article-category)
    public function articles(){
        return $this->hasMany(Article::class);
    }

    //Utilizanos el slug en lugar del id
    public function getRouteKeyName(){
        return 'slug';
    }
}
