<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentTable extends Migration
{

    /**
     * Létrehozza a document táblát.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document', function (Blueprint $table) {
            // Azonosító
            $table->increments('id');
            // Dokumentum neve
            $table->string('name');
            // Dokumentum leírása
            $table->text('description');
            // Dokumentum útvonala
            $table->string('path');
            // Létrehozva
            // Frissítve
            $table->timestamps();
            // Unique
            $table->unique(['name', 'path']);
        });
    }


    /**
     * Eldobja a document táblát.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('document');
    }

}
