<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    //Relacion inversa de uno a muchos (Article-user)
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion de uno a muchos (article-comments)
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //Relacion de uno a muchos inversa (category-article)
    public function article(){
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
