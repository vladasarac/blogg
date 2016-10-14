@extends('main')

{{--Lekcija 36 : Part 36 - Starting our Tag CRUD [How to Build a Blog with Laravel 5 Series]--}}
{{--vju koji prikazuje sve postojece tagove i ima formu za kreiranje novog, poziva ga index() metod TagControllera--}}

@section('title', '| All Tags')

@section('content')

  <div class="row">

  	<div class="col-md-8">
  	 <h1>Tags</h1> 
  	 {{--tabela u kojoj se prikazuju postojece kategorije--}}
  	 <table class="table">
  	   <thead>
  	   	  <tr>
  	   	  	<th>#</th>
  	   	  	<th>Name</th>
  	   	  </tr>
  	   </thead>	
  	   <tbody>
  	     @foreach($tags as $tag)
  	     <tr>
  	   	  	<td>{{ $tag->id }}</td>
  	   	  	<td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
  	   	  </tr>
  	   	  @endforeach	
  	   </tbody>
  	 </table>	

  	</div>{{--kraj div-a .col-md-8--}}

  	<div class="col-md-3">
  	  <div class="well">
  	  {{--forma za unos nove kategorije, salje unos u store() metod CategoryControllera preko rute categories.store --}}
  	  	{!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}
  	  	  <h2>New Tag</h2>
  	  	  {{ Form::label('name', 'Name:') }} {{--polje za unos nove kategorije--}}
  	  	  {{ Form::text('name', null, ['class' => 'form-control']) }}
  	  	  {{ Form::submit('Create New Tag', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }} {{--submit btn--}}
  	  	{!! Form::close() !!}
  	  </div>	
  	</div>

  </div>{{--kraj div-a .row--}}

@endsection