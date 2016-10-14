<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{
  
  // Lekcija 31 : Part 31 - Blog Categories and Learning Relationships [How to Build a Blog with Laravel 5 Series]
  // ovom funkcijom pravimo one-to-many relaciju izmedju categories i posts tabela, mada mislim da nije neophodno posto vec imamo - 
  // - funkciju u Category.php modelu koja pravi relaciju	
  public function category(){
    return $this->belongsTo('App\Category');

  }

  //  Lekcija 35 : Part 35 - Building Our Tag Model [How to Build a Blog with Laravel 5 Series]
  //metod koji pravi many-to-many relaciju sa 'tags' tabelom, u Tag.php modelu bice metod posts u kom pise isto ovo za posts model
  public function tags(){
    return $this->belongsToMany('App\Tag');
  }

  //  Lekcija 41 : Part 41 - Adding Comments [How to Build a Blog with Laravel 5 Series]
  // pravimo one-to-many relaciju sa 'comments' tabelom (jedan post moze imati mnogo komentara)
  public function comments(){
    return $this->hasMany('App\Comment');
  }


}




































