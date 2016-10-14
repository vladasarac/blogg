@extends('main')
{{-- ovaj vju extenduje main.blade.php layout i prikazuje glavnu stranicu  --}}

@section('title', '| Homepage') {{--definisi <title> stranice, yielduje se u <title> tagu u main.blade.php--}}

@section('content')
	  <div class="row">
	    <div class="col-md-12">
		  <div class="jumbotron">
            <h1>Welcome to My Blogg!</h1>
            <p class="lead">Thank You so much for visiting. This is my test website built with Laravel. Please read my latest post!</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
          </div>
		</div> <!-- end of div .col-md-12 -->
	  </div> <!-- end of div .row -->
	  
	  <div class="row">
	    <div class="col-md-8">
   		  {{-- Lekcija 21 : Part 21 - Query Builder [How to Build a Blog with Laravel Series] --}}
   		  {{-- prikazujemo 4 najnovija posta koji stizu iz getIndex() metoda PagesController-a --}}
   		  @foreach($posts as $post)
		    <div class="post">
		      <h3>{{ $post->title }}</h3> {{--naslov posta--}}
			  <p>{{ substr(strip_tags($post->body), 0, 300) }} {{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }}</p> {{--body tj sadrzaj posta--}}
			  {{-- Lekcija 24 : Parts 24 - Slugs in our URL Routes [How to Build a Blog with Laravel 5 Series] --}}
			  {{--ovaj link tj btn poziva rutu blog.single i salje joj slug posta koja poziva getSingle() metod BlogCOntrollera da prikaze postu single.blade.php--}}
			  <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
	        </div>
		    <hr>
		  @endforeach
	    </div> <!-- end of div .col-md-8 -->
		
		<div class="col-md-3 col-md-offset-1">
		  <h2>Sidebar</h2>
		</div> <!-- end of div .col-md-3 col-md-offset-1 -->
	  </div> <!-- end of div .row -->
	  
@endsection






















