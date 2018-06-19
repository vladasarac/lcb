<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Http\RedirectResponse;
use Redirect;
use DB;

use App\Comment;
use App\User;
use Validator;

class CommentsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod vadi sve komentare iz 'comments' tabele i vraca vju index.blade.php iz 'lcbtest\resources\views\comments' u kom je forma za 
    //editovanje postova i btn-i za brisanje komentara
    public function index(Request $request){
        $comments = Comment::orderBy('updated_at', 'DESC')->paginate(4);
        return view('comments/index')->withComments($comments);
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod se poziva kad se sabmituje forma za dodavanje komentara ispod nekog teksta u show.blade.php
    public function addcomment(Request $request){
    	//validacija
        $messages = [
            'required' => 'Polje je obavezno', 
            'max' => 'U polje možete uneti najviše :max karaktera',
            'unique' => 'Već postoji članak tog naslova'
        ];
        $this->validate($request, array(
            'commenttitle' => 'required|max:255',
            'commenttext' => 'required'
        ), $messages);
        //upisujemo novi post u 'posts' tabelu
    	$comment = new Comment();
    	$comment->title = $request->get('commenttitle');
    	$comment->content = $request->get('commenttext');
    	$comment->user_id = $request->get('userid');
    	$comment->post_id = $request->get('postid');
        $comment->save();
        $success = "Uspešno ste uneli novi Komentar.";
        Session::flash('success', $success);
        return redirect('/show/'.$request->get('postid'));
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod vadi komentar koji ce se editovati i salje ga u edit.blade.php iz 'lcbtest\resources\views\comments'
    public function commentedit(Request $request, $id){
        $comment = Comment::where('id', $id)->first();
        return view('comments/edit')->withComment($comment);
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod se poziva kad se sabmituje forma za editovanje komentara u edit.blade.php iz 'lcbtest\resources\views\comments'
    public function editcomment(Request $request){
        $comment = Comment::where('id', $request->get('commentid'))->first();
        if(Auth::user()->id == $comment->user_id){
            //validacija
            $messages = [
                'required' => 'Polje je obavezno', 
                'max' => 'U polje možete uneti najviše :max karaktera',
                'unique' => 'Već postoji članak tog naslova'
            ];
            $this->validate($request, array(
                'title' => 'required|max:255',
                'content' => 'required'
            ), $messages);
            //menjamo komentar
            $comment->title = $request->get('title');
            $comment->content = $request->get('content');
            $comment->save();
            $success = "Uspešno ste izmenili Komentar - " . $comment->title . ".";
            Session::flash('success', $success);
            return redirect('/comments');
        }else{
            $error = "Nemate pravo da menjate ovaj Članak.";
            Session::flash('error', $error);
            return redirect('/comments');
        }   
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod za brisanje komentara
    public function deletecomment(Request $request, $id){
        $comment = Comment::find($id);//po id-u koji je stigao nalazimo post koju treba obrisati
        if(Auth::user()->id == $comment->user_id){
            $title = $comment->title;//uzimamo title posta(da bi napravili success msg)
            $comment->delete();//brisemo post
            $success = "Uspešno ste izbrisali komentar - " . $title . ".";
            Session::flash('success', $success);
            return redirect('/comments');//idemo opet na /comemnts sa success msg-om
        }else{
            $error = "Nemate pravo da obrisete ovaj Komentar.";
            Session::flash('error', $error);
            return redirect('/comments');
        }
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

}

































