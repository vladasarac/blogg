@extends('main')

{{--Lekcija 38 : Part 38 - Show, Edit, Update our Tags [How to Build a Blog with Laravel 5 Series]--}}
{{--vju u kom se edituje jedan tag, poziva ga Edit btn u show.blade.php iz foldera 'blogg\resources\views\tags'--}}

@section('title', "| Edit")

@section('content')
  {{--forma za editovanje taga, radi se Form::model posto treba u input polju da prikaza postojeci naslov taga iz baze--}}
  {!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) !!}

    {{ Form::label('name', "Title:") }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}

    {{ Form::submit('Save Changes', ['class' => 'btn btn-success', 'style' => 'margin-top:20px;']) }}

  {!! Form::close() !!}
    

@endsection


