<?php

class ProjectTableSeeder extends Seeder {
	public function run()
	{
		DB::table('projects')->delete();
		Project::create(
			array(
				'name' => 'RandomFruit',
				'description' => 'Project tracking software',
				'course_id' => Course::fromCode("CIS 3223")->id

			)
		);
		Project::create(
			array(
				'name' => 'Lightning',
				'description' => 'Something with phones.',
				'course_id' => Course::fromCode("CIS 7228")->id
			)
		);
	}
}
