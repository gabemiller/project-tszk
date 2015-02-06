<?php

use Divide\CMS\Menu;

class MenusTableSeeder extends Seeder {

	public function run()
	{
		Menu::create([
            'name'=>'Főmenü'
        ]);
	}

}