@extends('main')
{{--Lekcija 25 : Part 25 - Adding Features to our Blog Controller [How to Build a Blog with Laravel 5 Series]--}}
{{--vju koji prikazuje sve postove poziva ga getIndex() metod BlogController-a, tj prikazuje po 5 jer radimo paginaciju --}}
@section('title', '| Blog')

@section('content')
  <div class="row">
  	<div class="col-md-8 col-md-offset-2">
  	  <h1>Blog</h1>  	
  	</div>{{--kraj div-a .col-md-8 col-md-offset-2--}}
  </div>{{--kraj div-a .row--}}

  @foreach($posts as $post)
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
  	  <h2>{{ $post->title }}</h2>
  	  <h5>Published: {{ date('M j, Y', strtotime($post->created_at)) }}</h5>
  	  <p>{{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 250 ? '...' : ""}}</p>
  	  <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read More</a> <hr> 	
    </div>{{--kraj div-a .col-md-8 col-md-offset-2--}}
  </div>{{--kraj div-a .row--}}  
  @endforeach
  {{--paginacija--}}
  <div class="row">
  	<div class="col-md-12">
  	  <div class="text-center">
  	  	{!! $posts->links() !!}
  	  </div> {{--kraj div-a .text-center--}}	
  	</div>{{--kraj div-a .col-md-12--}}
  </div>{{--kraj div-a .row--}}

@endsection