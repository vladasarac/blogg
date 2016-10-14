<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Session;

class CategoryController extends Controller
{

    //  Lekcija 32 : Part 32 - Categories CRUD [How to Build a Blog with Laravel Series]
    //  posto imamo autentifikaciju u aplikaciji tj register i LogIn usera, ovom kontroleru ce pristup imati samo ulogovani useri
    // tj samo registrrovani ce moci da se igraju sa kategorijama
    public function __construct(){
      $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // metod vadi sve postojece kategorije iz 'categories' tabele i salje ih u vju index.blade.php iz foldera -
    // - 'blogg\resources\views\categories' koji prikazuje sve kategorije i nudi formu za kreiranje nove
    public function index(){
      $categories = Category::all();
      return view('categories.index')->withCategories($categories);
    }

    // ovde je bio create() metod koji smo obrisali posto ce index() metod raditi i njegov posao

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // metod upisuje novu kategoriju u categories tabelu kad se submituje forma u vjuu index.blade.php iz foldera - 
    // - 'blogg\resources\views\categories
    public function store(Request $request){
      //prvo se radi validacija 
      $this->validate($request, array(
        'name' => 'required|max:255' 
      ));
      //zatim upisujemo novu kategoriju u 'categories' tabelu 
      $category = New Category;
      $category->name = $request->name;
      $category->save();
      // upisi u session flash poruku koju ce prikazati _messages.blade.php
      Session::flash('success', 'New Category Has Been Created.');
      //redirectuj na vju index.blade.php iz foldera 'blogg\resources\views\categories'
      return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
