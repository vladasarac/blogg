<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use Session;

class TagController extends Controller
{

    // Lekcija 36 : Part 36 - Starting our Tag CRUD [How to Build a Blog with Laravel 5 Series]
    // posto smo sada imamo autentifikaciju tj register i LogIn usera, ovom kontroleru ce pristup imati samo ulogovani useri 
    public function __construct(){
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // metod vadi sve tagove iz 'tags' tabele i salje ih u index.blade.php iz foldera 'blogg\resources\views\tags'
    public function index(){
      $tags = Tag::all();
      return view('tags.index')->withTags($tags);
    }

    //ovde je bila create() funkcija koja nam ne treba posto cemo praviti tagove u index.blade.php koji i prikazuje postojece

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // upisuje novi tag koji je kreiran u index.blade.php iz foldera 'blogg\resources\views\tags'
    public function store(Request $request){
      $this->validate($request, array('name' => 'required|max:255')); //prvo validacija unosa u formu u index.blade.php
      $tag = new Tag; // upisi tag u tags tabelu 
      $tag->name = $request->name;
      $tag->save();
      // upisi poruku session flash koju ce prikazati _messages.blade.php
      Session::flash('success', 'New Tag was successfully Created.');
      // redirectuj na index.blade.php iz foldera 'blogg\resources\views\tags'
      return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Lekcija 38 : Part 38 - Show, Edit, Update our Tags [How to Build a Blog with Laravel 5 Series]
    public function show($id){
      $tag = Tag::find($id);
      return view('tags.show')->withTag($tag); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Lekcija 38 : Part 38 - Show, Edit, Update our Tags [How to Build a Blog with Laravel 5 Series]
    public function edit($id){
      $tag = Tag::find($id); // kad se klikne btn Edit u show.blade.php iz foldera 'blogg\resources\views\tags' izvuci tag- 
      return view('tags.edit')->withTag($tag); // i posalji ga u edit.blade.php iz istog foldera  na editovanje
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Lekcija 38 : Part 38 - Show, Edit, Update our Tags [How to Build a Blog with Laravel 5 Series]
    // kad se submituje forma u edit.blade.php iz foldera 'blogg\resources\views\tags' za editovaje taga
    public function update(Request $request, $id){
      $tag = Tag::find($id); // izvuci tag koji updateujemo 
      $this->validate($request, ['name' => 'required|max:255']); //validiraj pristigli unos
      $tag->name = $request->name; // podesi name kolonu (posto je jedina...)
      $tag->save(); // updateuj tj save-uj
      Session::flash('success', 'Tag was successfully updated.');// podesi poruku koju ce prikazati _messages.blade.php
      // redirectuj na show.blade.php tj na rutu 'tags.show' koja prikazuje tag koji smo updateovali
      return redirect()->route('tags.show', $tag->id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Lekcija 39 : Part 39 - Deleting Tags Safely [How to Build a Blog with Laravel 5 Series]
    // metod za brisanje taga
    public function destroy($id){
      $tag = Tag::find($id);
      $tag->posts()->detach(); // ovo brise redove u 'post_tag' tabeli kojima je tag_id = id-u taga koji brisemo
      $tag->delete();
      Session::flash('success', 'Tag was successfully updated.');// podesi poruku koju ce prikazati _messages.blade.php
      // redirectuj na index.blade.php tj na rutu 'tags.index' koja prikazuje  sve tagove
      return redirect()->route('tags.index', $tag->id); 
    }



}
