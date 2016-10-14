@extends('main')
{{-- ovaj vju extenduje main.blade.php layout i prikazuje contact stranicu --}}

@section('title', '| Contact') {{--definisi <title> stranice, yielduje se u <title> tagu u main.blade.php--}}

@section('content')
	
	
	  <div class="row">
	    <div class="col-md-12">
            <h1>Contact Me</h1>
            <hr>
            {{--Lekcija 40 : Part 40 - Sending Email from Contact Form [How to Build a Blog with Laravel 5 Series]--}}
			<form action="{{ url('contact') }}" method="POST">
			{{ csrf_field() }} {{--ovo je obavzno--}}
			  <div class="form-group">
			    <label name="email">Email:</label>
				<input id="email" name="email" class="form-control">
			  </div>
			  <div class="form-group">
			    <label name="subject">Subject:</label>
				<input id="subject" name="subject" class="form-control">
			  </div>
			  <div class="form-group">
			    <label name="message">Message:</label>
				<textarea id="message" name="message" class="form-control">Type yout message here...</textarea>
			  </div>
			  <input type="submit" value="Send Message" class="btn btn-success">
			</form>
		</div> <!-- end of div .col-md-12 -->
	  </div> <!-- end of div .row -->
	  
@endsection























