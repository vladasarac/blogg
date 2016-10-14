<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Purifier;

class PostController extends Controller
{
    
    // Lekcija 28 : Part 28 - Authentication Methods [How to Build a Blog with Laravel 5 Series]
    // posto smo sada napravili autentifikaciju tj register i LogIn usera, ovom kontroleru ce pristup imati samo ulogovani useri 
    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Lekcija 16: Part 16 - Read our CRUD [How to Build a Blog with Laravel 5 Series]
    // ruta je posts.index, URL je http://blogg.dev/posts 
    public function index(){
      //$posts = Post::all(); // izvuci sve postove iz 'posts' tabele

      //Lekcija 20 : Part 20 - Pagination in Laravel [How to Build a Blog with Laravel 5 Series], dodavanje paginacije i orderovanje
      $posts = Post::orderBy('id', 'desc')->paginate(3);//SELECT * FROM posts ORDER BY id DESC LIMIT 3 OFFSET ?
      return view('posts.index')->withPosts($posts); // posalji sve u vju index.blade.php iz foldera'blogg\resources\views\posts'
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Lekcija 11: Part 11 - "Create" function and Forms in Laravel [How to Build a Blog with Laravel 5 Series]
    public function create(){
      // Lekcija 33 : Part 33 - Assigning Categories to Posts [How to Build a Blog with Laravel Series]
      // posto smo u aplikaciju dodali kategorije za postove prvo cemo izvuci sve kategorije da bi user pri kreiranju novog - 
      // - posta mogao da mu doda kategoriju
      $categories = Category::all();

      // Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]
      // posto smo u aplikaciju dodali tagove za postove prvo cemo izvuci sve tagove da bi user pri kreiranju novog - 
      // - posta mogao da mu doda tag
      $tags = Tag::all();

      // pozovi vju create.blade.php koji je u folderu, URL je http://blogg.dev/posts/create, ruta je posts.create
      return view('posts.create')->withCategories($categories)->withTags($tags); // i posalji mu kategorije i tagove
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Lekcija 12:  Part 12 - Inserting Data and Validating [How to Build a Blog with Laravel 5 Series]
    public function store(Request $request){
      //dd($request); //samo provera sta je stiglo kroz request
      // validacija unosa u formu u create.blade.php za kreiranje novog posta
      $this->validate($request, array(
        'title' => 'required|max:255', // polje title je obavezno i maksimalno 255 karaktera 
        // polje slug je obavezno,alpha_dash dozvoljava alfa-numericke karaktere najmaje 5 karaktera, najvise 255 i mora biti unique
        'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        // Lekcija 33 : Part 33 - Assigning Categories to Posts [How to Build a Blog with Laravel Series] 
        'category_id' => 'required|integer', // obavezno|broj
        'body'  => 'required'          // polje body je obavezno 
      ));
      // ako prodje validacija upisi novi post u tabelu 'posts'
      $post = new Post; // instanciraj Post klasu
      $post->title = $request->title; // uzmi naslov koji je user uneo
      $post->slug = $request->slug;  // uzmi slug koji je user uneo
      // Lekcija 33 : Part 33 - Assigning Categories to Posts [How to Build a Blog with Laravel Series]
      $post->category_id = $request->category_id; // uzimamo category_id iz <select> elementa u formi
      //Lekcija 45 : Part 45 - Security Concerns with WYSIWYG Editors [How to Build a Blog with Laravel 5 Series]
      // koristimo plug-in Purifier da ocistimo unos u body element forme posto sada koristimo tinyMCE za unos texta u textarea za body posta
      $post->body = Purifier::clean($request->body, 'youtube'); // uzmi body koji je user uneo
      $post->save(); // upisi red u 'posts' tabelu

      // Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]
      // upisi koji su tagovi dodati postu  u pivot tabelu 'post_tag' koja prima id posta i id taga
      $post->tags()->sync($request->tags, false);

      // napravi poruku koja ce se prikazati useru kad ucita stranicu koju prikaze show() metod i ubaci je u session flash 
      // poruku prikazuje _messages.blade.php kog include-uje main.blade.php
      Session::flash('success', 'The blog post was successfully saved!');
      // redirektuj na show() metod i posalji mu id koji je dodeljen postu u bazi posto ovaj zahteva $id posta da bi mogao da ga nadje
      return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Lekcija 14: Part 14 - Reading from our Database [How to Build a Blog with Laravel 5 Series]
    // metod poziva vju show.blade.php da prikaze jedan post(ruta- posts.show, URL- blogg.dev/posts/$id)
    public function show($id){
      $post = Post::find($id); // izvuci red sa datim id iz 'posts' tabele
      return view('posts.show')->withPost($post); // posalji post izvucen iz tabele u vju show.blade.php

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Lekcija 17: Part 17 - Model-Form Binding [How to Build a Blog with Laravel 5 Series]
    // metod nalazi vju za editovanje i salje ga u vju edit.blade.php iz foldera 'blogg\resources\views\posts', moze se pozvati iz - 
    // - index.blade.php i show.blade.php, ruta -  posts.edit, URL - posts/{posts}/edit  
    public function edit($id){
      $post = Post::find($id); // nadji post za editovanje 

      // Lekcija 33 : Part 33 - Assigning Categories to Posts [How to Build a Blog with Laravel Series]
      // posto smo u aplikaciju dodali kategorije za postove prvo cemo izvuci sve kategorije da bi user pri editovanju - 
      // - posta mogao da mu edituje i kategoriju i ubaciti ih u array
      $categories = Category::all()->lists('name', 'id');

      // Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]
      // posto smo u aplikaciju dodali tagove za postove prvo cemo izvuci sve tagove da bi user pri editovanju - 
      // - posta mogao da mu doda tag
      $tags = Tag::all()->lists('name', 'id');

      // posalji post u vju edit.blade.php iz foldera 'blogg\resources\views\posts' sa svim kategorijama 
      return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($tags); 
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Lekcija 18 : Part 18 - Updating Form Data to Database [How to Build a Blog with Laravel 5 Series]
    // metod ce biti pozvan kad se sabmituje forma u edit.blade.php iz foldera 'blogg\resources\views\posts' za editovanje postojeceg posta - 
    // - stizwe userov unos u formu($request) i $id posta  
    public function update(Request $request, $id){
      //$input = $request->all();// ovo sam ja dodo
      //$title = $request->get('title');
      //$body = $request->get('body');
      //return "Title posta: ".$title.",<br> body posta: ".$body;
      // validacija unosa u formu u edit.blade.php za update posta
      // ako u edit.blade.php nije menjan slug tj ako je isti kao u tabeli nemoj da ga validiras
      $post = Post::find($id);
      if($request->input('slug') == $post->slug){
        $this->validate($request, array(
        'title' => 'required|max:255', // polje title je obavezno i maksimalno 255 karaktera 
        'category_id' => 'required|integer', // validiramo select za kategorije
        'body'  => 'required'          // polje body je obavezno 
      ));   
      }else{ // ako je menjan slug validiraj ga, prvenstveno da bi bio unique
        $this->validate($request, array(
          'title' => 'required|max:255', // polje title je obavezno i maksimalno 255 karaktera 
          // polje slug je obavezno,alpha_dash dozvoljava alfa-numericke karaktere najmaje 5 karaktera, najvise 255 i mora biti unique
          'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug', 
          'category_id' => 'required|integer', // validiramo select za kategorije
          'body'  => 'required'          // polje body je obavezno 
        ));   
      }
      
      $post = Post::find($id); // nadji u 'posts' tabeli post koji treba update-ovati
      $post->title = $request->input('title');  // uzmi userov input za title polje 
      $post->slug = $request->input('slug');  // uzmi slug koji je user uneo
      $post->category_id = $request->input('category_id'); // uzmi category_id
      //Lekcija 45 : Part 45 - Security Concerns with WYSIWYG Editors [How to Build a Blog with Laravel 5 Series]
      // koristimo plug-in Purifier da ocistimo unos u body element forme posto sada koristimo tinyMCE za unos texta u textarea za body posta
      $post->body = Purifier::clean($request->input('body'), 'youtube'); // uzmi userov input za body polje
      $post->save(); // updateuj posts tabelu tj red koji je izvadjen po $id
      // Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]
      // ako su postu uopste dodati neki tagovi ( if(isset($request->tags)) )
      // upisi koji su tagovi dodati postu  u pivot tabelu 'post_tag' koja prima id posta i id taga isto kao u stroe() metodu -
      // samo je ovoga puta sync() funkcija nema argument false tj dozvoljavamo da override-uje ako smo obrisali neki tag koji -
      // - je bio dodat postu
      // ako postu nisu dodati tagovi ili ako su mu obrisani oni koje je vec imao posalji sync() metodu prazan array
      if(isset($request->tags)){
        $post->tags()->sync($request->tags);       
      }else{
        $post->tags()->sync(array());
      }

      Session::flash('success', 'This post was seccessfully saved.');// podesi poruku koju ce prikazati _messages.blade.php  
      return redirect()->route('posts.show', $post->id); // redirectuj na show.blade.php tj pozovi show($id) metod ovog kontrolera
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Lekcija 19 : Part 19 - Deleting Resources with CRUD [How to Build a Blog with Laravel 5 Series]
    // klik na link Delete u show.blade.php iz foldera 'blogg\resources\views\posts' poziva ovaj metod i salje mu id posta za brisanje
    public function destroy($id){
      //return "obrisi post sa id :  ".$id;  
      $post = Post::find($id); // nadji post za briasanje u 'posts' tabeli
      // Lekcija 39 : Part 39 - Deleting Tags Safely [How to Build a Blog with Laravel 5 Series]
      // posto sada imamo tagove na postovima obrisi u 'post_tag' tabeli red ili redove kojima je post_id kolona jednaka postu koji se brise
      $post->tags()->detach(); 
      $post->delete(); // obrisi ga
      Session::flash('success', 'The post was successfully deleted.');// podesi poruku koju ce prikazati _messages.blade.php
      return redirect()->route('posts.index'); // redirectuj na index.blade.php tj na rutu 'posts.index'
    }
    
    // ja dodao (ruta posts/vlada u routes.php poziva ovaj metod koji sluzi samo da se testira dodavanje ruta i metoda resource kontroleru)
    /*public function vlada(){
      //
      return 'Ovo je metod koji je vlada dodao u resorce kontroller';
    }*/


}















