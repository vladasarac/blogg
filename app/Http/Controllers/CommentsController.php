<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Post;
use Session;

class CommentsController extends Controller
{
    // Lekcija 42 : Part 42 - Managing Comments [How to Build a Blog with Laravel 5 Series]
    // posto je za neke metode potrebna autentifikacija a za neke ne u constructu cemo reci da za store() nije potrebna posto -
    // i useri koji nisu ulogovani mogu da pisu komentare ali samo ulogovani mogu da ih brisu i edituju 
    public function __construct(){
      $this->middleware('auth', ['except' => 'store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //  Lekcija 41 : Part 41 - Adding Comments [How to Build a Blog with Laravel 5 Series]
    // stize POST iz forme za unos komentara na post u single.blade.php iz foldera 'htdocs\blogg\resources\views\blog' 
    public function store(Request $request, $post_id){
      // prvo validacija unosa u formu
      $this->validate($request, array(
        'name'     => 'required|max:255',
        'email'    => 'required|email|max:255',
        'comment'  => 'required|min:5|max:2000'
      ));
      $post = Post::find($post_id); // izvuci post ciji je id stigao da bi mogli da poppunimo post_id polje koristeci associate()
      // popuni kolone 'comments' tabele
      $comment = new Comment();
      $comment->name = $request->name;
      $comment->email = $request->email;
      $comment->comment = $request->comment;
      $comment->approved = true;
      $comment->post()->associate($post); // ovo je valjda post_id kolona koja je foreign key na id kolonu 'posts' tabele
      // upisi komentar u 'comments' tabelu
      $comment->save();
      // session flash message
      Session::flash('success', 'Comment was added');
      return redirect()->route('blog.single', [$post->slug]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Lekcija 42 : Part 42 - Managing Comments [How to Build a Blog with Laravel 5 Series]
    // dobija request iz show.blade.php iz foldera 'blogg\resources\views\posts' kad se klikne link u tabeli za prikaz komentara za edit komentrara
    public function edit($id){
      $comment = Comment::find($id); //izvlacimo komentar po id koji je stigao preko rute comments.edit
      return view('comments.edit')->withComment($comment);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Lekcija 42 : Part 42 - Managing Comments [How to Build a Blog with Laravel 5 Series]
    // kad se submituje forma za editovanje komentara u edit.blade.php iz foldera 'blogg\resources\views\comments'
    public function update(Request $request, $id){
      $comment = Comment::find($id); //nadji komentar koji updateujemo
      $this->validate($request, array('comment' => 'required')); // validira se samo polje comment iz forme posto su osta disable-ovana
      $comment->comment = $request->comment;
      $comment->save();
      // session flash poruka i redirect na show.blade.php koji prikazuje post ciji komentar je editovan 
      Session::flash('success', 'Comment Updated!');
      return redirect()->route('posts.show', $comment->post->id);
    }

    //Lekcija 42 : Part 42 - Managing Comments [How to Build a Blog with Laravel 5 Series]
    // metod se poziva kad se klikne delete ikona u show.blade.php za prikaz jednog posta u tabeli sa komentarima 
    // metod koji izvlaci komentar za brisanje i salje ga u vju delete.blade.php iz foldera 'blogg\resources\views\comments' u kom je satro -
    // -konfirmacija brisanja a u stvari forma koja kad se sabmituje poziva destry() metod, ovaj ispod
    public function delete($id){
      $comment = Comment::find($id);
      return view('comments.delete')->withComment($comment);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Lekcija 42 : Part 42 - Managing Comments [How to Build a Blog with Laravel 5 Series]
    // metod brise komentar iz 'comments' tabele kad se klikne forma od jednog btn-a iz vjua delete.blade.php iz foldera -
    // - 'blogg\resources\views\comments' koji sluzi da potvrdi brisanje
    public function destroy($id){
      $comment = Comment::find($id);
      $post_id = $comment->post->id; // izvuci id posta koji se brise posto nam treba da ucitamo vju show.blade.php 
      $comment->delete(); // obrisi komentar
      // session flash poruka i redirect na show.blade.php koji prikazuje post ciji komentar je izbrisan 
      Session::flash('success', 'Comment Deleted!');
      return redirect()->route('posts.show', $post_id);
    }
}
