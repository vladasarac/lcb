<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //one to many relacija sa Post.php modelom tj tabelom 'posts'
    public function posts(){
        return $this->hasMany('App\Post', 'user_id');
    }
    //one to many relacija sa Comment.php modelom tj tabelom 'comments'
    public function comments(){
        return $this->hasMany('App\Comment', 'user_id');
    }
}
