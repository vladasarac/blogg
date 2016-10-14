<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;


class BlogController extends Controller
{
  
  // Lekcija 25 : Part 25 - Adding Features to our Blog Controller [How to Build a Blog with Laravel 5 Series]
  public function getIndex(){
  	$posts = Post::paginate(5); // izvuci po 5 postova iz 'posts' tabele
  	return view('blog.index')->withPosts($posts); // i salji ih u vju index.blade.php iz foldera 'blogg\resources\views\blog' 
  }

  //Lekcija 24 : Parts 24 - Slugs in our URL Routes [How to Build a Blog with Laravel 5 Series] 
  public function getSingle($slug){
  	// izvuci post iz 'posts' tabele koristeci $slug posta koji je stigao 
    $post = Post::where('slug', '=', $slug)->first(); 
    // posalji ga u vju single.blade.php iz foldera 'blogg\resources\views\blog' da ga prikaze
    return view('blog.single')->withPost($post);   
  } 


    
}
