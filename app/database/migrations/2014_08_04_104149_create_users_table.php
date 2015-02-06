<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Hozzáad két oszlopot a users táblához.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function($table) {
            // Telefonszám
            $table->string('phone');
            // Törölhető-e?
            $table->boolean('deletable')->default(true);
        });
    }

    /**
     * Eldob két oszlopot a users táblából.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function($table) {

            //if ($table->hasColumn('phone', 'deletable')) {
                $table->dropColumn(['phone', 'deletable']);
            //}
        });
    }

}
