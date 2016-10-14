<!DOCTYPE html>
<html lang="en">

  <head>

    @include('partials._head') {{--includuj '_head.blade.php' u kom je <head> tag--}}
    
  </head>

  <body>

    @include('partials._nav') {{--includuj '_nav.blade.php' u kom je navigacija--}} 
    
	  <div class="container">
      {{--Lekcija 13: Part 13 - Sessions & Flash Messages [How to Build a Blog with Laravel 5 Series]--}}
      {{--success poruka iz sesije ako je uspesno uneto u bazu--}}
      @include('partials._messages')
	    @yield('content')  {{--yielduj content section (svaki vju ga ima osim partialsa)--}}
	    @include('partials._footer') {{--includuj '_footer.blade.php' u kom je footer--}} 
    </div> <!-- end of div .container -->

    @include('partials._javascript') {{--includuj '_javascript.blade.php' u kom su linkovi za js fajlove--}}

    @yield('scripts')

  </body>
</html>

























































