@extends('main')
{{--Lekcija 24 : Parts 24 - Slugs in our URL Routes [How to Build a Blog with Laravel 5 Series]--}}
{{--vju koji prikazuje jedan post poziva ga getSingle() metod BlogController-a --}}
<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', "| $titleTag")

@section('content')

  <div class="row">
  	<div class="col-md-8 col-md-offset-2">
  	  <h1>{{ $post->title }}</h1>
  	  <p>{!! $post->body !!}</p>  	
  	  <hr>
  	  {{-- Lekcija 31 : Part 31 - Blog Categories and Learning Relationships [How to Build a Blog with Laravel 5 Series] --}}
  	  {{--dodali smo categorie tabelu i kolonu categry_id u posts tabelu tako da sada prikazujemo kategoriju posta--}}
  	  <p>Posted In: {{ $post->category->name }}</p>
  	</div>{{--kraj div-a .col-md-8 col-md-offset-2--}}
  </div>{{--kraj div-a .row--}}

  {{--Lekcija 41 : Part 41 - Adding Comments [How to Build a Blog with Laravel 5 Series]--}}
  {{--prikaz komentara doatih postu--}}
  <div class="row">
    <div class="col-md-8 col-md-offset-2"><hr>
      <h3 class="comments-title text-success">
      <span class="glyphicon glyphicon-comment"></span>
        {{ $post->comments()->count() }} Comments
      </h3>
      @foreach($post->comments as $comment)
        <div class="comment">
          <div class="author-info">
            {{--ovo prikazuje sliku usera ako ima nalog na gravatar.com, ako nema prikazuje njihov logo BZVZ--}}
            <img src="{{"https://www.gravatar.com/avatar/".md5(strtolower(trim($comment->email)))."?s=50&d=wavatar"}}" class="author-image"> 
            <div class="author-name">
              <h4>{{ $comment->name }}</h4> {{--ime autora komentara--}}
              <p class="author-time">{{ date('F nS, Y - g:iA', strtotime($comment->created_at)) }}</p>{{--vreme postavljanja komentara--}}
            </div>           
          </div>
          <div class="comment-content">
            {{ $comment->comment }} {{--tekst komentara--}}
          </div>    
        </div>
      @endforeach
    </div>
  </div>
  
  {{--Lekcija 41 : Part 41 - Adding Comments [How to Build a Blog with Laravel 5 Series]--}}
  {{--forma za dodavanje komentara u comments tabelu , salje request u store() metod CommentsControllera preko rute comments.store--}}
  <div class="row">
    <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
      {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
        <div class="row">
          <div class="col-md-6">
            {{ Form::label('name', "Name:") }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
          </div>{{--kraj div-a .col-md-6--}}
          <div class="col-md-6">
            {{ Form::label('email', "Email:") }}
            {{ Form::text('email', null, ['class' => 'form-control']) }}
          </div>{{--kraj div-a .col-md-6--}}
          <div class="col-md-12">
            {{ Form::label('comment', "Comment:") }}
            {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

            {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }}
          </div>{{--kraj div-a .col-md-6--}}
        </div>{{--kraj div-a .row--}}
      {{ Form::close() }}
    </div>{{--kraj div-a .comment-form--}}
  </div>{{--kraj div-a .row--}}

@endsection