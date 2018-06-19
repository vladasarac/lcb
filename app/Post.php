<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'content'
    ];

    //one to many relacija sa User.php modelom tj tabelom 'users'
  	public function user(){
    	return $this->belongsTo('App\User', 'user_id');	
  	}
  	//one to many relacija sa Category.php modelom tj tabelom 'categories'
  	public function category(){
    	return $this->belongsTo('App\Category', 'category_id');	
  	}
    //one to many relacija sa Comment.php modelom tj tabelom 'comments'
    public function comments(){
        return $this->hasMany('App\Comment', 'post_id');
    }
}
