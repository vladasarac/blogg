<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Lekcija 41 : Part 41 - Adding Comments [How to Build a Blog with Laravel 5 Series]
    // pravimo relaciju sa posts tabelom (tj komentar moze pripadati jednom postu)
    public function post(){
      return $this->belongsTo('App\Post');
    }
}
