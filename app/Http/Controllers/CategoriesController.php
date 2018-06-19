<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Http\RedirectResponse;
use Redirect;

use App\Category;
use App\User;
use Validator;

class CategoriesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod vadi sve kategorije iz 'categories' tabele i vraca vju index.blade.php iz 'lcbtest\resources\views\categories' u kom je forma za 
    //upis nove kategorije u 'categories' tabelu
    public function index(Request $request){
        $categories = Category::all()->sortByDesc('updated_at');;
        return view('categories/index')->withCategories($categories);
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod upisuje novu kategoriju u 'categories' tabelu kad se sabmituje forma za dodavanje kategorije u index.blade.php iz 'lcbtest\resources\views\categories'
    public function addcategory(Request $request){
        //validacija
        $messages = [
            'required' => 'Polje je obavezno', 
            'max' => 'U polje možete uneti najviše :max karaktera',
            'unique' => 'Ta kategorija je vec uneta'
        ];
        $this->validate($request, array(
            'kategorija' => 'required|max:255|unique:categories,title'
        ), $messages);
        //upisujemo novu kategoriju i vracamo success msg u view
        $category = new Category();
        $category->title = $request->get('kategorija');
        $category->save();
        $success = "Uspešno ste uneli novu kategoriju - " . $category->title . ".";
        Session::flash('success', $success);
        return redirect('/categories');
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //edit kategorije poziva se kad se sabmituje forma za edit kategorije u index.blade.php iz 'lcbtest\resources\views\categories'
    public function editcategory(Request $request){
        //validacija
        $messages = [
            'required' => 'Polje je obavezno', 
            'max' => 'U polje možete uneti najviše :max karaktera',
            'unique' => 'Ta kategorija je vec uneta'
        ];
        $this->validate($request, array(
            'kategorija' => 'required|max:255|unique:categories,title'
        ), $messages);
        //upisujemo izmenjenu kategoriju i vracamo success msg u view
        $category = Category::where('id', $request->get('categoryid'))->first();
        $oldtitle = $category->title;
        $category->title = $request->get('kategorija');
        $category->save();
        $success = "Uspešno ste izmenili kategoriju - " . $oldtitle . " u " . $category->title . ".";
        Session::flash('success', $success);
        return redirect('/categories');
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

    //metod za brisanje kategorije, poziva se kad se klikne btn(link) Obrisi u index.blade.php iz 'lcbtest\resources\views\categories'
    public function deletecategory(Request $request, $id){
        $category = Category::find($id);//po id-u koji je stigao nalazimo kategoriju koju treba obrisati
        $title = $category->title;//uzimamo title kategorije(da bi napravili success msg)
        $category->delete();//brisemo kategoriju
        $success = "Uspešno ste izbrisali kategoriju - " . $title . ".";
        Session::flash('success', $success);
        return redirect('/categories');//idemo opet na /categories sa success msg-om
    }

//--------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------

}











































