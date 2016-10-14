@extends('main')
{{--Lekcija 30 : Part 30 - Password Reset Emails [How to Build a Blog with Laravel 5 Series]--}}
{{--vju koji prikazuje formu za slanje maila u slucaju da smo zaboravili password--}}
@section('title', '| Forgot my Password')

@section('content')

  <div class="row">
    <div class="col-md-6 col-md-offset-3"> 
      <div class="panel panel-default">
        <div class="panel-heading">Reset Password</div>{{--kraj div-a .panel-heading--}} 
        <div class="panel-body">
          {{--forma za slanje maila u slucaju da smo zaboravili password--}}
          {!! Form::open(['url' => 'password/email', 'method' => 'POST']) !!}
          {{--ovo samo stampa success porurku ako uspesno posalje mail--}}
          @if(session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          
            {{ Form::label('email', 'Email:') }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}

            {{ Form::submit('Reset Password', ['class' => 'btn btn-primary']) }}

          {!! Form::close() !!}
        </div>{{--kraj div-a .panel-body--}} 
      </div>{{--kraj div-a .panel panel-default--}} 	
    </div>{{--kraj div-a .col-md-6 col-md-offset-3--}}
  </div>{{--kraj div-a .row--}}

@endsection