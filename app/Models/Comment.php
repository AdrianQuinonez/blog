<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    //Relacion inversa de uno a muchos (comment-user)
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion inversa de uno a muchos (comments-Article)
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
