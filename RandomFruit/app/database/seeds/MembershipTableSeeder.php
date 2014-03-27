<?php

class MemberShipTableSeeder extends Seeder {
	public function run()
	{
		DB::table('memberships')->delete();
		$users = User::all();
		$projects = Project::where('name', '=', 'RandomFruit')->get();
		$project = $projects[0];
	}
}
