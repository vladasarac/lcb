<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title'
    ];

    //one to many relacija sa Post.php modelom tj tabelom 'posts'
    public function posts(){
        return $this->hasMany('App\Post', 'category_id');
    }
}
