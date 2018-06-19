<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = [
        'user_id', 'post_id', 'title', 'content'
    ];
    //one to many relacija sa User.php modelom tj tabelom 'users'
  	public function user(){
    	return $this->belongsTo('App\User', 'user_id');	
  	}
  	//one to many relacija sa Post.php modelom tj tabelom 'posts'
  	public function post(){
    	return $this->belongsTo('App\User', 'post_id');	
  	}
}
