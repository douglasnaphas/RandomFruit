<?php

class CourseTableSeeder extends Seeder {
	public function run()
	{
		DB::table('courses')->delete();
		Course::create(array( "code" => "CIS 3223", "description" => "Projects in Comp Sci", "active" => true, "planning" => true));
		Course::create(array( "code" => "CIS 7228", "description" => "Programming Sentient Robots", "active" => true, "planning" => true));
	}
}
