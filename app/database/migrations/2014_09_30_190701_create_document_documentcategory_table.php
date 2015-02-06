<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentDocumentcategoryTable extends Migration
{

    /**
     * Létrehozza a document_documentcategory táblát.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_documentcategory', function (Blueprint $table) {

            // Azonosító
            $table->increments('id');
            // Dokumentum azonosító
            $table->integer('document_id')->unsigned();
            // Foreign key
            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
            // Dokumentum kategória azonosító
            $table->integer('documentcategory_id')->unsigned();
            // Foreign key
            $table->foreign('documentcategory_id')->references('id')->on('documentcategory')->onDelete('cascade');
            // Létrehozva
            // Frissítve
            $table->timestamps();
            // Index
            $table->index(['document_id', 'documentcategory_id']);
        });
    }


    /**
     * Eldobja a document_documentcategory táblát.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('document_documentcategory');
    }

}
