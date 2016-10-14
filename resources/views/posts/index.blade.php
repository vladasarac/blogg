@extends('main')

{{--Lekcija 16: Part 16 - Read our CRUD [How to Build a Blog with Laravel 5 Series]--}}
{{--vju koji prikazuje sve postove iz 'posts' tabele, poziva ga index() metod PostController-a --}}
@section('title', '| All Posts')

@section('content')

  <div class="row">

  	<div class="col-md-10">
  	  <h1>All Posts</h1>	
  	</div>{{--kraj div-a col-md-10--}}
  	<div class="col-md-2">{{--link koji poziva create() metod postContorller-a --}}
  	  <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Post</a>	
  	</div>{{--kraj div-a col-md-2--}}
  	<div class="col-md-12">{{--ovaj div prikazuje samo jedan hr--}}
   	  <hr> 		
  	</div>{{--kraj div-a col-md-12--}}


  </div>{{--kraj div-a row--}}

  <div class="row">

  	<div class="col-md-12">
  	  <table class="table"> {{--tabela koja prikazuje sve postove iz 'posts' tabele koje je poslao index() u PostController-u--}}
  	  	<thead>
  	  	  <th>#</th> {{--u ovoj koloni ce biti id posta--}}
  	  	  <th>Title</th>  
  	  	  <th>Body</th>  
  	  	  <th>Created At</th>
  	  	  <th></th>  {{--u ovoj koloni ce biti linkovi ka show() i edit() u PostController-u --}} 	
  	  	</thead>
  	  	<tbody>
          @foreach($posts as $post) {{--iteriraj kroz postove koju su stigli iz index() u PostController-u--}}
            <tr>
              <th>{{ $post->id }}</th>
              <td>{{ $post->title }}</td>
              {{--skrati body string na 50 karaktera, ako je duzi od toga dodaj 3 tacke na kraju--}}
              <td>{{ substr(strip_tags($post->body), 0, 50) }}{{ strlen(strip_tags($post->body)) > 50 ? "..." : "" }}</td> 
              <td>{{ date('M j, Y', strtotime($post->updated_at)) }}</td> {{--napravi lepo citljiv datum--}}
              <td> {{--linkovi ka show() i edit() u PostController-u --}}
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a> 
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a>
              </td> 
            </tr>
          @endforeach
  	  	</tbody>
  	  </table>  {{--kraj tabele--}}	
      {{--Lekcija 20 : Part 20 - Pagination in Laravel [How to Build a Blog with Laravel 5 Series], dodavanje paginacije--}}
      <div class="text-center">
        {!! $posts->links() !!} {{--prikazuj linkove za paginaciju posto metod index() vadi po 3 posta--}}
      </div>{{--kraj div-a text-center--}}
  	</div>{{--kraj div-a col-md-12--}}

  </div>{{--kraj div-a row--}}

@stop




