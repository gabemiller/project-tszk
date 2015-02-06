<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentcategoryTable extends Migration
{

    /**
     * Létrehozza a documentcategory táblát.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentcategory', function (Blueprint $table) {
            // Azonosító
            $table->increments('id');
            // Szülő azonosító
            $table->integer('parent_id');
            // Kategória név
            $table->string('name');
            // Kategória ékezetes és egyéb speciális karakter nélküli neve
            $table->string('slug');
            // Létrehozva
            // Frissítve
            $table->timestamps();

            // Unique, Index
            $table->unique(['name']);
            $table->index(['parent_id']);
        });
    }


    /**
     * Eldobja a documentcategory táblát.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('documentcategory');
    }

}
