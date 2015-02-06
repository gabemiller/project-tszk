<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration
{

    /**
     * Létrehozza az articles táblát.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            // Azonosító
            $table->increments('id');
            // Szerző azonosító
            $table->integer('author_id')->length(10)->unsigned()->nullable();
            // Galéria azonosító
            $table->integer('gallery_id')->length(10)->unsigned()->nullable();
            // Bejegyzés címe
            $table->string('title');
            // Bejegyzés slug neve
            $table->string('slug');
            // Bejegyzés tartalma
            $table->text('content');
            // Publikálva van-e?
            $table->boolean('published');
            // Létrehozva, frissítve
            $table->timestamps();
            // Unique, Index, Foreign key
            $table->unique('title','slug');
            $table->index(['author_id','gallery_id']);
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('set null');

        });


    }

    /**
     * Eldobja az articles táblát.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }

}
