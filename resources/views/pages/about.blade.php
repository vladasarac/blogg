@extends('main')
{{-- ovaj vju extenduje main.blade.php layout i prikazuje about stranicu --}}

@section('title', '| About') {{--definisi <title> stranice, yielduje se u <title> tagu u main.blade.php--}}

@section('content')
	
	  <div class="row">
	    <div class="col-md-12">
            <h1>About Me</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's fghhfhfhfghfghfghf
			   standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
		</div> <!-- end of div .col-md-12 -->
	  </div> <!-- end of div .row -->
	  
@endsection























