<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration
{

    /**
     * Létrehozza az events táblát az adatbázisban.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {

            // Azonosító
            $table->increments('id');
            // Felhasználó azonosító
            $table->integer('author_id')->length(10)->unsigned()->nullable();
            // Galéria azonosító
            $table->integer('gallery_id')->length(10)->unsigned()->nullable();
            // Esemény címe
            $table->string('title');
            // Esemény tartalma
            $table->text('content');
            // Publikálva van-e?
            $table->boolean('published');
            // Esemény kezdete
            $table->timestamp('start_at');
            // Esemény vége
            $table->timestamp('end_at');
            // Létrehozva
            // Frissítve
            $table->timestamps();

            // Unique, Index, Foreign key
            $table->unique('title', 'slug');
            $table->index(['author_id', 'gallery_id']);
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('set null');
        });
    }

    /**
     * Eldobja az events táblát.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }

}
