<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // Lekcija 22 : Part 22 - Adding Slug URLs to Our Blog [How to Build a Blog with Laravel Series]
    public function up(){
      Schema::table('posts', function($table){
        $table->string('slug')->unique()->after('body'); // dodajemo kolonu slug u 'posts' tabelu, (unique() je metod koji pravi index na koloni)
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
      Schema::table('posts', function($table){
        $table->dropColumn('slug'); // obrisi kolonu slug u 'posts' tabelu
      });
    }



}


















