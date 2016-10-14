@extends('main')

{{--Lekcija 38 : Part 38 - Show, Edit, Update our Tags [How to Build a Blog with Laravel 5 Series]--}}
{{--vju koji prikazuje jedan tag--}}

@section('title', "| $tag->name Tag") {{--posto su dupli navodnici prikazace ime taga a ne $tag->name string--}}

@section('content')
  <div class="row">
    <div class="col-md-8">
      {{--u naslovu prikazujemo ime taga i broj postova kojima je dodat ($tag->posts()->count() ovako prebrojimo postove)--}}
      <h1>{{ $tag->name }} Tag <small>{{ $tag->posts()->count() }} Posts</small></h1>  
    </div>
    <div class="col-md-2">
      {{--link ka edit.blade.php iz foldera blogg\resources\views\tags tj vju za editovanje taga--}}
      <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary pull-right btn-block" style="margin-top: 20px;">Edit</a>   
    </div>
    {{--Lekcija 39 : Part 39 - Deleting Tags Safely [How to Build a Blog with Laravel 5 Series]--}}
    {{--mala forma od jednog btn-a koja sluzi za brisanje taga--}}
    <div class="col-md-2">
      {{ Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block',  'style' => 'margin-top: 20px;']) }}
      {{ Form::close() }}
    </div>
  </div>
  
  {{--tabela koja prikazuje sve postove kojima je dodat tag koji je gore prikazan--}}
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Tags</th>
            <th></th>
          </tr>
        </thead>
          <tbody>
          {{--posto Tag.php model ima metod posts() koristimo ga da listamo postove kojima je dodat ta ovaj tag--}}
            @foreach($tag->posts as $post)
              <tr>
                <th>{{ $post->id }}</th> {{--id posta--}}
                <td>{{ $post->title }}</td> {{--naslov posta--}}
                {{--posto Post.php model ima metod tags() koristimo ga da listamo tagove koji su dodati  ovom postu--}}
                <td>@foreach($post->tags as $tag) {{--ovde ide foreach koji prikazuje sve tagove dodate postu--}}
                      <span class="label label-default">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs">View</a></td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>

@endsection