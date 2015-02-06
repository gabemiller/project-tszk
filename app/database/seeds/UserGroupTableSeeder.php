<?php

class UserGroupTableSeeder extends Seeder {

    public function run() {
        DB::table('users_groups')->delete();

        $adminUser = Sentry::getUserProvider()->findByLogin('gabormolnar92@gmail.com');

        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');

        // Assign the groups to the users
        $adminUser->addGroup($adminGroup);
    }

}
