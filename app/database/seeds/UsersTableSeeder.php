<?php


class UsersTableSeeder extends Seeder {

    public function run() {

        DB::table('users')->delete();

        Sentry::getUserProvider()->create(array(
            'email' => 'gabormolnar92@gmail.com',
            'password' => 'andreas14',
            'activated' => 1,
            'first_name' => 'Gábor',
            'last_name' => 'Molnár',
            'phone' => '06306230312',
            'deletable' => false
        ));
    }

}
