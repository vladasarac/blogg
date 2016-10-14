<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Lekcija 31 : Part 31 - Blog Categories and Learning Relationships [How to Build a Blog with Laravel 5 Series]
class Category extends Model
{
  // ovo nije neophodno raditi, posto po automatizmu Laravel zna da se tabela zove categories ali ajde...
  // da se zvala recimo posts_categories bilo bi obavezno...  
  protected $table = 'categories';

  // ovom funkcijom pravimo one-to-many relaciju izmedju categories i posts tabela
  public function posts(){
  	return $this->hasMany('App\Posts');
  }
  


  
}











