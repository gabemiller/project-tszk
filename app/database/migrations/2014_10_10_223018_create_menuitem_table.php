<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuitemTable extends Migration {

	/**
	 * Létrehozza a menuitem táblát.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menuitem', function(Blueprint $table)
		{
            // Azonosító
			$table->increments('id');
            // Menu azonosító
            $table->integer('menu_id')->length(10)->unsigned();
            // Szülő azonosító
            $table->integer('parent_id')->length(10)->unsigned()->nullable();
            // Menüpont név
            $table->string('name');
            // Menüpont típus
            $table->string('type');
            // Url az adott oldalhoz
            $table->string('url');
            // A menü sorrendje
            $table->integer('order')->unsigned();
			$table->timestamps();

            // Foreign key
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('menuitem')->onDelete('cascade');
		});
	}


	/**
	 * Eldobja a menuitem táblát.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menuitem');
	}

}
