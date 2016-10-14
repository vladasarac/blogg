<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Lekcija 35 : Part 35 - Building Our Tag Model [How to Build a Blog with Laravel 5 Series]
class Tag extends Model
{
    // metod koji pravi many-to-many relaciju sa 'posts' tabelom, u Post.php modelu je metod tags() koji radi isto ovo sa duge-
    // - strane relacije
    public function posts(){
      return $this->belongsToMany('App\Post');	
    }
}
