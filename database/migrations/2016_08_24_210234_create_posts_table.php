<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{



    /**
     * Run the migrations.
     *
     * @return void
     */
    // Lekcija9:  Part 9 - Migration Basics [How to Build a Blog with Laravel 5 Series]
    public function up(){
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); //dodajemo kolonu za 'title' posta
            $table->text('body'); //dodajemo kolonu za 'body' posta
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('posts');
    }


}







































