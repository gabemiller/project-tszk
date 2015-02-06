<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

    /**
     * Létrehozza a pages táblát.
     *
     * @return void
     */
    public function up() {
        Schema::create('pages', function(Blueprint $table) {

            // Azonosító
            $table->increments('id');
            // Galéria azonosító
            $table->integer('gallery_id')->length(10)->unsigned()->nullable();
            // Oldal címe
            $table->string('title');
            // Oldal tartalma
            $table->text('content');
            // Publikálva van-e?
            $table->boolean('published');
            // Létrehozva, frissítve
            $table->timestamps();

            // Index, Foreign key
            $table->index(['gallery_id']);
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('set null');
        });
    }

    /**
     * Eldobja a pages táblát.
     *
     * @return void
     */
    public function down() {
        Schema::drop('pages');
    }

}
