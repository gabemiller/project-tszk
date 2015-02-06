<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalleryTable extends Migration {

    /**
     * Létrehozza a gallery táblát.
     *
     * @return void
     */
    public function up() {
        Schema::create('gallery', function(Blueprint $table) {
            // Azonosító
            $table->increments('id');
            // Galéria neve
            $table->string('name');
            // Galéria leírása
            $table->text('description');
            // Publikálva van-e?
            $table->boolean('published');
            // Létrehozva, frissítve
            $table->timestamps();
            // Unique
            $table->unique(['name']);
        });
    }

    /**
     * Eldobja a gallery táblát.
     *
     * @return void
     */
    public function down() {
        Schema::drop('gallery');
    }

}
