
{{--Lekcija 13: Part 13 - Sessions & Flash Messages [How to Build a Blog with Laravel 5 Series]--}}
{{--ovaj fajl prikazuje poruke iz sesije ako ih ima, inkluduje ga main.blade.php --}}


{{--ako u sesiji ima nesto pod kljucem success, a ima ako smo npr uneli novi post--}}
@if(Session::has('success')) 
  <div class="alert alert-success" role="alert">
    <strong>Success:</strong>{{ Session::get('success') }}
  </div>
@endif
{{--ako ima nesto u $errors arrayu tj ako npr nije prosla validacija u kontroleru, prikazi te errore--}}
@if(count($errors) > 0)
  <div class="alert alert-danger" role="alert">
    <strong>Errors:</strong>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach	
    </ul>
  </div>
@endif




