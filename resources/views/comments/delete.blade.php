
@extends('main')

{{--Lekcija 42 : Part 42 - Managing Comments [How to Build a Blog with Laravel 5 Series]--}}
{{--vju koji sluzi za brisanje jednog komentara--}}
{{--komentar stize iz metoda delete() u CommentsControlleru--}}

@section('title', '| DELETE Comment')

@section('content')

  <div class="row">
  <div class="col-md-8 col-md-offset-2">
  	
    <h1>DELETE THIS COMMENT?</h1>
    <p>
      <strong>Name:</strong> {{ $comment->name }}<br>
      <strong>Email:</strong> {{ $comment->email }}<br>
      <strong>Comment:</strong> {{ $comment->comment }}
    </p>

    {{--forma u kojoj se potvrdjue brisanje komentara, kad se submituje salje request u destroy() metod CommentsControllera preko rute comments.destroy--}}
    {{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}

      {{ Form::submit('YES DELETE THIS COMMENT', ['class' => 'btn btn-block btn-danger']) }}

    {{ Form::close() }}
  </div> {{--kraj div .col-md-8 col-md-offset-2--}}
  </div> {{--kraj div .row--}}


@endsection

