<?php

class GroupsTableSeeder extends Seeder {

    public function run() {
        DB::table('groups')->delete();

        Sentry::getGroupProvider()->create(array(
            'name' => 'Admin',
            'permissions' => array(
                'admin' => 1,
                'users' => 1,
        )));
    }

}
