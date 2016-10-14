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

// Lekcija 27 : Part 27 - Laravel Authentication Routes Views [How to Build a Blog with Laravel Series]
// rute za Autentifikaciju tj Login i Logout, pozivaju metode iz AuthControllera koji je dobijen sa Laravelom i nalazi se u folderu -
// - 'blogg\app\Http\Controllers\Auth'
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
//rute za registraciju
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Lekcija 30 : Part 30 - Password Reset Emails [How to Build a Blog with Laravel 5 Series]
// rute za resetovanj passworda ako ga user zaboravi
//ruta koja prikazuje formu za resetovanje passworda
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
// ruta poziva metod koji salje mail
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
// ruta poziva metod koji resetuje password
Route::post('password/reset', 'Auth\PasswordController@reset');

// Lekcija 32 : Part 32 - Categories CRUD [How to Build a Blog with Laravel Series]
// rute za CategoryController (koji je resource kontroller i sluzi za rad sa kategorijama postova)
Route::resource('categories', 'CategoryController', ['except' => ['create']]);

// Lekcija 36 : Part 36 - Starting our Tag CRUD [How to Build a Blog with Laravel 5 Series]
// rute za TagController (koji je resource kontroller i sluzi za rad sa tagovima postova)
Route::resource('tags', 'TagController', ['except' => ['create']]);

// Lekcija 41 : Part 41 - Adding Comments [How to Build a Blog with Laravel 5 Series]
//rute za CommentsController
Route::post('comments/{post_id}', ['uses' =>'CommentsController@store', 'as' => 'comments.store']);
// Lekcija 42 : Part 42 - Managing Comments [How to Build a Blog with Laravel 5 Series]
// rute za brisanje i editovanje komentara u backendu
Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

// Lekcija 24 : Parts 24 - Slugs in our URL Routes [How to Build a Blog with Laravel 5 Series]
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');

// Lekcija 25 : Part 25 - Adding Features to our Blog Controller [How to Build a Blog with Laravel 5 Series]
// ruta koja poziva vju koji prikazuje sve postove
Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogController@getIndex']);

// Lekcija3: Part 3 - Getting Started [How to Build a Blog with Laravel 5 Series]
Route::get('contact', 'PagesController@getContact'); // poziva getContact() metod PagesController-a koji prikazuje vju contact.blade.php

// Lekcija 40 : Part 40 - Sending Email from Contact Form [How to Build a Blog with Laravel 5 Series]
// ruta koja se poziva kad se submituje forma u vjuu contact.blade.php iz foldera 'blogg\resources\views\pages'
Route::post('contact', 'PagesController@postContact');

Route::get('about', 'PagesController@getAbout'); // poziva getAbout() metod PagesController-a koji prikazuje vju about.blade.php

Route::get('/', 'PagesController@getIndex'); // poziva getIndex() metod PagesController-a koji prikazuje vju welcome.blade.php



// rute za resorce PostController.php

// ja dodao, da bi se dodali metod i ruta u reource kontroller(u ovom slucaju PostController) mora se pre Route::resource(...) defifnisati - 
// - ruta da bi radilo, a u kontroleru se napravi metod koji radi sta vec treba.Znaci ovo ne radi ako je ruta posts/vlada ispod resorce rute
//Route::get('posts/vlada', 'PostController@vlada');

// Lekcija 10: Part 10 - CRUD and RESTful Routes [How to Build a Blog with Laravel 5 Series]
Route::resource('posts', 'PostController');















