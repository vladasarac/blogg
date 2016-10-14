
@extends('main')

{{--Lekcija 13: Part 13 - Sessions & Flash Messages [How to Build a Blog with Laravel 5 Series]--}}

@section('title', '| View Post')
  
@section('content')
  {{-- Lekcija 14:  Part 14 - Reading from our Database [How to Build a Blog with Laravel 5 Series] --}}
  <div class="row">

    <div class="col-md-8">
  	  <h1>{{ $post->title }}</h1> {{--prikazi title kolonu iz 'posts' tabele tj naslov posta--}}
      <p class="lead">{!! $post->body !!}</p><hr> {{--prikazi body kolonu iz 'posts' tabele tj sadrzaj posta--}}
      {{--Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]--}}
      {{--div koji ce prikazivati tagove posta ako ih ima--}}
      <div class="tags">
        @foreach($post->tags as $tag)
          <span class="label label-default">{{ $tag->name }}</span>
        @endforeach
      </div>{{--kraj div-a .tags--}}

      {{--Lekcija 42 : Part 42 - Managing Comments [How to Build a Blog with Laravel 5 Series]--}}
      {{--prikaz komentara dodatih postu od citalaca--}}
      <div id="backend-comments" style="margin-top": 50px;>
        <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>{{--broj komentara dodatih postu--}}
        <table class="table"> {{--tabela koja prikazuje kmentare dodate postu--}}
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Comment</th>
              <th width="70px"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($post->comments as $comment) {{--iteriraj kroz komentara i prikazuj ih--}}
              <tr>
                <td>{{ $comment->name }}</td>
                <td>{{ $comment->email }}</td>
                <td>{{ $comment->comment }}</td>
                <td> {{--u ovoj koloni su linkovi za edit i delete--}}
                  <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                  <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
              </tr>
            @endforeach           
          </tbody>
        </table>
      </div>{{--kraj div-a #backend-comments--}}

    </div>{{--kraj div-a .col-md-8--}}

    {{--Lekcija 15: Part 15 - Working with Dates from Database [How to Build a Blog with Laravel 5 Series]--}} 
    <div class="col-md-4">
      <div class="well">

        {{--Lekcija 23 : Part 23 - Adding Slugs to our Posts CRUD [How to Build a Blog with Laravel 5 Series]--}}
        <dl class="dl-horizontal">
          <label>URL:</label>
          {{--link koji poziva rutu blog.single, salje joj slug kolonu posta koja preko metoda getSinge() BLoggControllera prikazuje jedan post u vjuu single.blade.php--}} 
          <p><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></p> 
        </dl>

        {{--Lekcija 33 : Part 33 - Assigning Categories to Posts [How to Build a Blog with Laravel Series]--}}
        <dl class="dl-horizontal">
          <label>Category:</label>
          {{--posto postovi sada imaju i kategoriju prikazacemo je ovde koristeci category() metod Post.php modela--}} 
          <p>{{ $post->category->name }}</p> 
        </dl>

        <dl class="dl-horizontal">
          <label>Created At:</label>
          <p>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p> {{--napravi lepo citljiv datum--}}	
        </dl>

        <dl class="dl-horizontal">
          <label>Last Update:</label>
          <p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>	{{--napravi lepo citljiv datum--}}
        </dl><hr>

        <div class="row">
          <div class="col-md-6">{{--link ka edit() metodu PostController-a, salje mu se $id posta--}}
            {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
          </div>{{--kraj div-a col-md-6--}}	
          <div class="col-md-6">{{--forma za brisanje posta, ima samo btn za Delete i salje $id posta destroy() metodu PostController-a--}}
            {!! Form::open(['route' => ['posts.destroy', $post->id], "method" => "DELETE"]) !!}{{--method mora biti 'DELETE' da bi radilo--}}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
            {!! Form::close() !!}
          </div>{{--kraj div-a col-md-6--}}	
        </div>{{--kraj div-a row--}}
        {{--Lekcija 21 : Part 21 - Query Builder [How to Build a Blog with Laravel Series], link ka index.blade.php--}}
        <div class="row">
          <div class="col-md-12">
            {{ Html::linkRoute('posts.index', '<< See All Posts', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}  
          </div>
        </div>{{--kraj div-a row--}}

      </div>{{--kraj div-a well--}}	
    </div>{{--kraj div-a col-md-4--}}

  </div>{{--kraj div-a row--}}
@endsection








