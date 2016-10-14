@extends('main')

{{--Lekcija 32 : Part 32 - Categories CRUD [How to Build a Blog with Laravel Series]--}}
{{--vju koji prikazuje sve postojece kategorije i ima formu za kreiranje nove, poziva ga index() metod CategoryControllera--}}

@section('title', '| All Categories')

@section('content')

  <div class="row">

  	<div class="col-md-8">
  	 <h1>Categories</h1> 
  	 {{--tabela u kojoj se prikazuju postojece kategorije--}}
  	 <table class="table">
  	   <thead>
  	   	  <tr>
  	   	  	<th>#</th>
  	   	  	<th>Name</th>
  	   	  </tr>
  	   </thead>	
  	   <tbody>
  	     @foreach($categories as $category)
  	     <tr>
  	   	  	<td>{{ $category->id }}</td>
  	   	  	<td>{{ $category->name }}</td>
  	   	  </tr>
  	   	  @endforeach	
  	   </tbody>
  	 </table>	

  	</div>{{--kraj div-a .col-md-8--}}

  	<div class="col-md-3">
  	  <div class="well">
  	  {{--forma za unos nove kategorije, salje unos u store() metod CategoryControllera preko rute categories.store --}}
  	  	{!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
  	  	  <h2>New Category</h2>
  	  	  {{ Form::label('name', 'Name:') }} {{--polje za unos nove kategorije--}}
  	  	  {{ Form::text('name', null, ['class' => 'form-control']) }}
  	  	  {{ Form::submit('Create New Cateogry', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }} {{--submit btn--}}
  	  	{!! Form::close() !!}
  	  </div>	
  	</div>

  </div>{{--kraj div-a .row--}}

@endsection