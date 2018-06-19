<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Redirect;

use App\Post;
use App\Comment;

class FrontController extends Controller
{

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

	//metod vadi postove(4 po stranici) i vraca vju welcome.blade.php koji ih prikazuje
	public function index(Request $request){
		$posts = Post::orderBy('updated_at', 'DESC')->paginate(4);
		return view('welcome')->withPosts($posts);
	}

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

	//metod vadi jedan post salje ga u vju show.blade.php
	public function show(Request $request, $id){
		$post = Post::where('id', $id)->first();
		$comments = Comment::where('post_id', $id)->orderBy('updated_at', 'DESC')->get();
		return view('show')->withPost($post)->withComments($comments);
	}

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------


}		














































