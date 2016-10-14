 <!--OVO JE FAJL U KOM JE <nav> TAG KOJI CE BITI include-ovan U LAYOUT 'main.blade.php'-->

 <!-- Bootstrap Default Navbar link: http://getbootstrap.com/components/#navbar -->
	<nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Laravel Blog</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
          {{--Lekcija 25 : Part 25 - Adding Features to our Blog Controller [How to Build a Blog with Laravel 5 Series]--}}
          <li class="{{ Request::is('blog') ? 'active' : '' }}"><a href="/blog">Blog</a></li>
          <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="/about">About</a></li>
		      <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact</a></li>
        </ul>
       
        <ul class="nav navbar-nav navbar-right">

          {{--Lekcija 29 : Part 29 - Authentication User Experience [How to Build a Blog with Laravel 5 Series]--}}
          @if(Auth::check()) {{--ako je user ulogovan--}}
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::user()->name }}<span class="caret"></span></a>
              <ul class="dropdown-menu">
                {{--link koji poziva posts.index rutu tj index() metod PostsControllera--}}
                <li><a href="{{ route('posts.index') }}">Posts</a></li>
                {{--Lekcija 32 : Part 32 - Categories CRUD [How to Build a Blog with Laravel Series]--}}
                {{--link koji poziva categories.index rutu tj index() metod CategoriesControllera--}}
                <li><a href="{{ route('categories.index') }}">Categories</a></li>
                {{--Lekcija 36 : Part 36 - Starting our Tag CRUD [How to Build a Blog with Laravel 5 Series]--}}
                {{--link koji poziva tags.index rutu tj index() metod TagControllera--}}
                <li><a href="{{ route('tags.index') }}">Tags</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>{{--link poziva logout rutu koja radi logout --}}
              </ul>
            </li>
          @else {{--ako nije ulogovan, daj mu link za login--}}
            <a href="{{ route('login') }}" class="btn btn-default">LogIn</a>
          @endif
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>