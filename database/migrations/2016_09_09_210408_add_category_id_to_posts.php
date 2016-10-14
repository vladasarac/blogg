<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // Lekcija 31 : Part 31 - Blog Categories and Learning Relationships [How to Build a Blog with Laravel 5 Series]
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
          $table->integer('category_id')->nullable()->after('slug')->unsigned();
          //ovako mozemo napraviti od kolone category_id foreign key koji se referencira na id kolonu 'categories' tabele
          // $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
          $table->dropColumn('category_id');
        });
    }
}
