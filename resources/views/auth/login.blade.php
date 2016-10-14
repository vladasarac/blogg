@extends('main')
{{--Lekcija 27 : Part 27 - Laravel Authentication Routes Views [How to Build a Blog with Laravel Series]--}}
{{--vju koji prikazuje formu za login --}}
@section('title', '| Login')

@section('content')

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      {{--forma za login napravljena pomocu laravelcollective paketa--}}
      {!! Form::open() !!}
        
        {{ Form::label('email', 'Email:') }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}

        {{ Form::label('password', 'Password:') }}
        {{ Form::password('password', ['class' => 'form-control']) }}
        <br>	
        {{ Form::checkbox('remember') }}{{ Form::label('remember', 'Remember:') }} {{--remember me checkbox--}}
        <br>
        {{ Form::submit('Login', ['class' => 'btn btn-primary btn-block']) }}

        {{--Lekcija 30 : Part 30 - Password Reset Emails [How to Build a Blog with Laravel 5 Series]--}}
        {{--ako je user zaboravio password--}}
        <p><a href="{{ url('password/reset') }}">Forgot My Password</a></p>

      {!! Form::close() !!}	
    </div>{{--kraj div-a .col-md-6 col-md-offset-3--}}
  </div>{{--kraj div-a .row--}}

@endsection