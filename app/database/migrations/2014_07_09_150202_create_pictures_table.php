<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePicturesTable extends Migration
{

    /**
     * Létrehozza a pictures táblát.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            // Azonosító
            $table->increments('id');
            // Galéria azonosító
            $table->integer('gallery_id')->length(10)->unsigned();
            // Thumbnail útvonail
            $table->string('thumbnail_path');
            // Normálkép útvonal
            $table->string('picture_path');
            // Kép neve
            $table->string('name');
            // Kép slug neve
            $table->string('slug');
            // Kép kiterjesztése
            $table->string('extension');
            // Létrehozva, frissítve
            $table->timestamps();
            // Index, Foreign key
            $table->index(['gallery_id']);
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');

        });
    }


    /**
     * Eldobja a pictures táblát.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pictures');
    }

}
