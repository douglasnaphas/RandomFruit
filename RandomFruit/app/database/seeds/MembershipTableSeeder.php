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
		Membership::create(
			array(
				'user_id' => User::fromUserName('admin')->id,
				'project_id' => Project::fromName('Lightning')->id
			)
		);
		Membership::create(
			array(
				'user_id' => User::fromUserName('jeff')->id,
				'project_id' => Project::fromName('RandomFruit')->id
			)
		);
		Membership::create(
			array(
				'user_id' => User::fromUserName('greg')->id,
				'project_id' => Project::fromName('Lightning')->id
			)
		);
		Membership::create(
			array(
				'user_id' => User::fromUserName('alex')->id,
				'project_id' => Project::fromName('RandomFruit')->id
			)
		);
		Membership::create(
			array(
				'user_id' => User::fromUserName('dave')->id,
				'project_id' => Project::fromName('RandomFruit')->id
			)
		);
		Membership::create(
			array(
				'user_id' => User::fromUserName('greg')->id,
				'project_id' => Project::fromName('RandomFruit')->id
			)
		);
		Membership::create(
			array(
				'user_id' => User::fromUserName('doug')->id,
				'project_id' => Project::fromName('RandomFruit')->id
			)
		);
		$projects = Project::where('name', '=', 'RandomFruit')->get();
	}
}
