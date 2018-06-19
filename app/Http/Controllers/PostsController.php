<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Http\RedirectResponse;
use Redirect;
use DB;

use App\Post;
use App\Category;
use App\User;
use Validator;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod vadi sve postove iz 'posts' tabele i vraca vju index.blade.php iz 'lcbtest\resources\views\posts' u kom je forma za 
    //upis novog posta u 'posts' tabelu
    public function index(Request $request){
    	$posts = Post::orderBy('updated_at', 'DESC')->paginate(4);
    	$categories = Category::orderBy('title')->get();
        return view('posts/index')->withPosts($posts)->withCategories($categories);
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod za upis clanka tj posta u 'posts' tabelu
    public function addpost(Request $request){
    	//validacija
        $messages = [
            'required' => 'Polje je obavezno', 
            'max' => 'U polje možete uneti najviše :max karaktera',
            'unique' => 'Već postoji članak tog naslova'
        ];
        $this->validate($request, array(
            'title' => 'required|max:255|unique:posts,title',
            'tekst' => 'required',
            'category' => 'required'
        ), $messages);
        //upisujemo novi post u 'posts' tabelu
    	$post = new Post();
    	$post->title = $request->get('title');
    	$post->content = $request->get('tekst');
    	$post->user_id = $request->get('userid');
    	$post->category_id = $request->get('category');
        $post->save();
        $success = "Uspešno ste uneli novi Članak - " . $post->title . ".";
        Session::flash('success', $success);
        return redirect('/posts');
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod vadi post koji treba da se edituje
    public function postdata(Request $request){
    	$post = Post::where('id', $request->get('postid'))->first();
    	return response()->json(['post' => $post]);
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod se poziva kad se sabmituje forma za edit posta u index.blade.php iz 'lcbtest\resources\views\posts'
	public function editpost(Request $request){
		$post = Post::where('id', $request->get('postid'))->first();//nalazimo post po id-u koji je stigao
		if(Auth::user()->id == $post->user_id){
			//validacija
	        $messages = [
	            'required' => 'Polje je obavezno', 
	            'max' => 'U polje možete uneti najviše :max karaktera',
	            'unique' => 'Već postoji članak tog naslova'
	        ];
	        $this->validate($request, array(
	            'title' => ($request->get('title') != $post->title) ? 'required|max:255|unique:posts,title' : 'required|max:255',
	            'tekst' => 'required',
	            'category' => 'required'
	        ), $messages);
	        //menjamo post
	        $post->title = $request->get('title');
	    	$post->content = $request->get('tekst');
	    	$post->category_id = $request->get('category');
	        $post->save();
	        $success = "Uspešno ste izmenili Članak - " . $post->title . ".";
	        Session::flash('success', $success);
	        return redirect('/posts');
		}else{
			$error = "Nemate pravo da menjate ovaj Članak.";
        	Session::flash('error', $error);
        	return redirect('/posts');
		}	
	}    

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

	//metod za brisanje posta, poziva se kad se klikne btn(link) Obrisi u index.blade.php iz 'lcbtest\resources\views\posts'
    public function deletepost(Request $request, $id){
        $post = Post::find($id);//po id-u koji je stigao nalazimo post koju treba obrisati
        if(Auth::user()->id == $post->user_id){
        	$title = $post->title;//uzimamo title posta(da bi napravili success msg)
        	$post->delete();//brisemo post
        	$success = "Uspešno ste izbrisali post - " . $title . ".";
        	Session::flash('success', $success);
        	return redirect('/posts');//idemo opet na /posts sa success msg-om
        }else{
        	$error = "Nemate pravo da obrisete ovaj Članak.";
        	Session::flash('error', $error);
        	return redirect('/posts');
        }
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

}




















