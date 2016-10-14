
@extends('main')

{{-- Lekcija 17 : Part 17 - Model-Form Binding [How to Build a Blog with Laravel 5 Series] --}}
{{-- vju za editovanje postova, moze se ozvait iz index.blade.php ili show.blade.php iz foldera 'blogg\resources\views\posts'--}}

@section('title', '| Edit Blog Post')

@section('stylesheets')  
  {{--Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]--}}
  {{--ucitavamo css fajl paketa select2 kojim cemo napraviti <select> za dodavanje vise tag-ova postu --}}
  {!! Html::style('css/select2.min.css') !!}

  {{--Lekcija 44 : Part 44 - Output HTML from Database [How to Build a Blog with Laravel 5 Series]--}}
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
  {{--Otvaramo formu(Form::model posto koristimo $post koji je stigao iz PostController-a u kom je objekat izvucen iz posts tabele)--}}
  {{--kad se submituje forma salje request update() metodu PostControllera(tj salje ruti post.update) i salje mu id posta koji treba da --}}
  {{--updateuje, 'method'=>'PATCH' je obavezno tj moze biti i 'method'=>'PUT' ali mora biti tu da bi kontroler odradio svoje--}}
  {!! Form::model($post, ['route' => ['posts.update', $post->id], "method" => "PUT"]) !!}
    <div class="col-md-8">
      {{ Form::label('title', 'Title:') }}{{--input za naslov posta--}}
      {{ Form::text('title', null, ["class" => "form-control input-lg"]) }}

      {{--Lekcija 23 : Part 23 - Adding Slugs to our Posts CRUD [How to Build a Blog with Laravel 5 Series]--}}
      {{ Form::label('slug', 'Slug:', ["class" => "form-spacing-top"]) }}{{--input za slug posta--}}
      {{ Form::text('slug', null, ["class" => "form-control"]) }}

      {{--Lekcija 33 : Part 33 - Assigning Categories to Posts [How to Build a Blog with Laravel Series]--}}
      {{--posto postovi sada imaju i kategoriju prikazacemo ih ovde da bi user mogao da promeni kategoriju posta, u kontroleru
           je napravljen od njih array i samo smo ih ubacili ovde i blade ih sam prikazuje i selektuje automatski kategoriju koja
           je dodata postu u bazi--}}
      {{ Form::label('category_id', 'Category:', ["class" => "form-spacing-top"]) }}
      {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

      {{--Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]--}}
      {{--<select> za dodavanje vise tagova postu,koristi select2 plug-in obavezno dodati tag multiple="multiple"
            a u <script> tagu na dnu selectovati select2-multi i pozvati mu funkciju select2(); --}}
      {{ Form::label('tags', 'Tags:', ["class" => "form-spacing-top"]) }}
      {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

      {{ Form::label('body', 'Body:', ["class" => "form-spacing-top"]) }}{{--textarea za body posta--}}
      {{ Form::textarea('body', null, ["class" => "form-control"]) }}
    </div>{{--kraj div-a col-md-8--}}

    {{--Lekcija 15: Part 15 - Working with Dates from Database [How to Build a Blog with Laravel 5 Series]--}} 
    <div class="col-md-4">
      <div class="well">

        <dl class="dl-horizontal">
          <dt>Created At:</dt>
          <dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd> {{--napravi lepo citljiv datum--}} 
        </dl>
        <dl class="dl-horizontal">
          <dt>Last Update:</dt>
          <dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>  {{--napravi lepo citljiv datum--}}
        </dl><hr>
        <div class="row">
          <div class="col-md-6">{{--link ka show() metodu PostController-a, ako user odustane od editovanj posta tj cancel-uje radnju--}}
            {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
          </div>{{--kraj div-a col-md-6--}} 
          <div class="col-md-6">{{--link ka update() metodu PostController-a ako user hoce da sacuva unetu promenu, salje mu se $id posta--}}
            {!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) !!}
          </div>{{--kraj div-a col-md-6--}} 
        </div>{{--kraj div-a row--}}

      </div>{{--kraj div-a well--}} 
    </div>{{--kraj div-a col-md-4--}}
  {!! Form::close() !!} {{--kraj forme za update posta--}}
  </div>{{--kraj div-a row--}}

@stop

@section('scripts'){{--ovaj section yielduje _head.blade.php--}}
  {{--Lekcija 37 : Part 37 - Adding Tag UI/UX [How to Build a Blog with Laravel 5 Series]--}}
  {{--ucitavamo js fajl paketa select2 kojim cemo napraviti <select> za dodavanje vise tag-ova postu --}}
  {!! Html::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $('.select2-multi').select2();
    $('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
  </script>
@endsection






