<?php

class MemberShipTableSeeder extends Seeder {
	public function run()
	{
		DB::table('memberships')->delete();
		Membership::create(
			array( 
				'user_id' => User::fromUserName('admin')->id,
				'project_id' => Project::fromName('RandomFruit')->id
			)
		);
		$projects = Project::where('name', '=', 'RandomFruit')->get();
	}
}
