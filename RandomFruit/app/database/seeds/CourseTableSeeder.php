<?php

class CourseTableSeeder extends Seeder {
	public function run()
	{
		DB::table('courses')->delete();
		Course::create(array( "code" => "CIS 3223", "description" => "Algorithms", "active" => true, "planning" => true, "start_date" => "2014-02-10", "week_number" => "12"));
		Course::create(array( "code" => "CIS 7228", "description" => "Programming Sentient Robots", "active" => true, "planning" => true, "start_date" => "2014-02-10", "week_number" => "12"));
		Course::create(array( "code" => "CIS 4398", "description" => "Projects in computer science", "active" => true, "planning" => true, "start_date" => "2014-02-10", "week_number" => "12"));
	}
}
