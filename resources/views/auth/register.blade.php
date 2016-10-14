@extends('main')
{{--Lekcija 27 : Part 27 - Laravel Authentication Routes Views [How to Build a Blog with Laravel Series]--}}
{{--vju koji prikazuje formu za registraciju --}}
@section('title', '| Register')

@section('content')

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      {{--forma za registraciju napravljena pomocu laravelcollective paketa--}}
      {!! Form::open() !!}

        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        
        {{ Form::label('email', 'Email:') }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}

        {{ Form::label('password', 'Password:') }}
        {{ Form::password('password', ['class' => 'form-control']) }}

        {{ Form::label('password_confirmation', 'Confirm Password:') }}
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        
        {{ Form::submit('Register', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

      {!! Form::close() !!}	
    </div>{{--kraj div-a .col-md-6 col-md-offset-3--}}
  </div>{{--kraj div-a .row--}}

@endsection