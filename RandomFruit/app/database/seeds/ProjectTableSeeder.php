<?php

class ProjectTableSeeder extends Seeder {
	public function run()
	{
		DB::table('projects')->delete();
		Project::create(
			array(
				'name' => 'RandomFruit',
				'description' => 'Project tracking software'
			)
		);
	}
}
