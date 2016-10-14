
@extends('main')

{{--Lekcija 42 : Part 42 - Managing Comments [How to Build a Blog with Laravel 5 Series]--}}
{{--vju koji sluzi za editovanje jednog komentara--}}
{{--komentar stize iz metoda edit() u CommentsControlleru--}}

@section('title', '| Edit Comment')

@section('content')

  <div class="row">
  <div class="col-md-8 col-md-offset-2">
  	
    <h1>Edit Comment</h1>

    {{--forma u kojoj se edituje komentar, kad se submituje salje unos u update() metod CommentsControllera preko rute comments.upadate--}}
    {{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}
    
      {{ Form::label('name', 'Name:') }}
      {{ Form::text('name', null, ['class' => 'form-control', 'disabled' => '']) }} {{--disabled znaci da ovo polje ne mozemo editovati--}}

      {{ Form::label('email', 'Email:') }}
      {{ Form::text('email', null, ['class' => 'form-control', 'disabled' => '']) }}{{--disabled znaci da ovo polje ne mozemo editovati--}}

      {{ Form::label('comment', 'Comment:') }}
      {{ Form::textarea('comment', null, ['class' => 'form-control']) }}

      {{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-success', 'style' => 'margin-top: 15px;']) }}

    {{ Form::close() }}
  </div> {{--kraj div .col-md-8 col-md-offset-2--}}
  </div> {{--kraj div .row--}}


@endsection

