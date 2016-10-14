@extends('main')
{{--Lekcija 11: Part 11 - "Create" function and Forms in Laravel [How to Build a Blog with Laravel 5 Series], Vju za kreiranje novog posta poziva ga create() metod PostController-a --}}


@section('title', '| Create New Post')

{{--Lekcija 12½:Part 12½-Javascript Form Validation [How to Build a Blog with Laravel 5 Series],ovaj section yielduje _head.blade.php--}}
@section('stylesheets')  
  {!! Html::style('css/parsley.css') !!} {{--ucitaj css za parsley js validaciju koji je u folderu 'blogg\public\css'--}}
  {{--Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]--}}
  {{--ucitavamo css fajl paketa select2 kojim cemo napraviti <select> za dodavanje vise tag-ova postu --}}
  {!! Html::style('css/select2.min.css') !!}

  {{--Lekcija 43 : Part 43 - Adding a WYSIWYG Editor [How to Build a Blog with Laravel 5 Series]--}}
  {{--plugin tinyMCE za lepse formatiranje teksta unetog u formu--}}
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      height : 700,
      plugins: 'link code image media code',
      toolbar: 'undo redo | styleselect | bold italic bullist, numlist| link image media code'
    });
  </script>

@endsection

@section('content')
  
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Create New Post</h1><hr>
        {{-- forma za pravljenje novog posta napravljena pomocu laravelcollective paketa --}}
        {{--forma salje request store() metodu PostControllera preko rute posts.store--}}
        {{--'data-parsley-validate' => '' je da bi radila parsley.js validacija koju smo skinuli sa neta--}}
        {!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '')) !!}
          {{--naslov posta--}}
          {{ Form::label('title', 'Title:') }}  {{--'required' => '' i 'maxlength' => '255' je za parsley validaciju--}}
          {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
          {{--Lekcija 23 : Part 23 - Adding Slugs to our Posts CRUD [How to Build a Blog with Laravel 5 Series]--}}
          {{--input za slug kolonu 'posts' tabele--}}
          {{ Form::label('slug', 'Slug:') }}  {{--'required','minlength' i 'maxlength' je za parsley validaciju--}}
          {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}

          {{--Lekcija 33 : Part 33 - Assigning Categories to Posts [How to Build a Blog with Laravel Series]--}}
          {{--posto sada imamo i kategorije dodacemo select za biranje kategorije--}}
          {{ Form::label('category_id', 'Category:') }}
          <select class="form-control" name="category_id">
            @foreach($categories as $category) {{--u category_id kolonu posts tabele upisujemo id kategorije--}}
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>

          {{--Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]--}}
          {{--<select> za dodavanje vise tagova postu,koristi select2 plug-in obavezno dodati tag multiple="multiple"
              a u <script> tagu na dnu selectovati select2-multi i pozvati mu funkciju select2(); --}}
          {{ Form::label('tags', 'Tags:') }}
          <select class="form-control select2-multi" name="tags[]" multiple="multiple">
            @foreach($tags as $tag) 
              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
          </select>

          {{--body posta--}}
          {{ Form::label('body', 'Post Body:') }}  {{--'required' je za parsley validaciju--}}
          {{ Form::textarea('body', null, array('class' => 'form-control')) }}
          {{--submit btn--}}
          {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block' , 'style' => 'margin-top: 20px;')) }}
		{!! Form::close() !!}
    </div> {{--kraj div-a .col-md-8 col-md-offset-2--}}
  </div>{{--kraj div-a .row--}}

@endsection


{{--Lekcija 12½:Part 12½-Javascript Form Validation [How to Build a Blog with Laravel 5 Series],ovaj section yielduje _head.blade.php--}}
@section('scripts'){{--ovaj section yielduje _head.blade.php--}}
  {!! Html::script('js/parsley.min.js') !!}   {{--ucitaj js za parsley js validaciju koji je u folderu 'blogg\public\js'--}}
  {{--Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]--}}
  {{--ucitavamo js fajl paketa select2 kojim cemo napraviti <select> za dodavanje vise tag-ova postu --}}
  {!! Html::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $('.select2-multi').select2();
  </script>
@endsection