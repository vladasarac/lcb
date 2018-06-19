<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//ruta ide na index() metod FrontControllera koji paginuje po 4 posta i poziva welcome.blade.php da ih prikaze
Route::get('/', 'FrontController@index');

//
Route::get('/show/{id}', 'FrontController@show');

Route::auth();

Route::get('/home', 'HomeController@index');

//ruta gadja metod index CategoryControllera, metod vraca vju index.blade.php iz 'lcbtest\resources\views\categories' koji se koristi za rad sa kategorijama
Route::get('/categories', 'CategoriesController@index');

//ruta gadja metod addcategory() CategoryControllera, metod upisuje nvu kategoriju u 'categories' tabelu 
Route::post('/addcategory', 'CategoriesController@addcategory');

//ruta gadja metod editcategory() CategoryControllera, metod menja neku kategoriju u 'categories' tabeli 
Route::post('/editcategory', 'CategoriesController@editcategory');

//ruta za brisanje kategorije, gadja deletecategory() metod CategoryControllera kad se klikn btn 'Obrisi' u index.blade.php iz 'lcbtest\resources\views\categories'
Route::get('/deletecategory/{id}', 'CategoriesController@deletecategory');

//ruta gadja index metod PostsControllera koji vadi sve do sada dodate postove i salje ih u index.blade.php iz 'lcbtest\resources\views\posts' 
Route::get('/posts', 'PostsController@index');

//ruta gadja addpost() metod PostsControllera, kad se sabmituje forma za dodavanje posta u index.blade.php iz 'lcbtest\resources\views\posts' 
Route::post('/addpost', 'PostsController@addpost');

//ruta gadja metod postdata PostsControllera koji vraca post koji treba henlderu u posts.js da bi popunio formu za edit posta
Route::post('/postdata', 'PostsController@postdata');

//kad se sabmituje forma za edit posta u index.blade.php iz 'lcbtest\resources\views\posts' (to je zapravo forma za dodavanje posta koja je izmenjena u posts.js kad se klikne btn za Editovanje nekog posta)
Route::post('/editpost', 'PostsController@editpost');

//ruta gadja deletepost() metod PostsControlelra koji brise post ciji id stigne
Route::get('deletepost/{id}', 'PostsController@deletepost');

//ruta se poziva kad se sabmituje forma za komentarisanje u show.blade.php koji prikazuje jedan post
Route::post('/addcomment', 'CommentsController@addcomment');

//vadi po 4 komentara i salje u view index.blade.php iz 'lcbtest\resources\views\comments'
Route::get('/comments', 'CommentsController@index');

//
Route::get('/commentedit/{id}', 'CommentsController@commentedit');

//kad se sabmituje forma za edit komentara
Route::post('/editcomment', 'CommentsController@editcomment');

//
Route::get('/deletecomment/{id}', 'CommentsController@deletecomment');