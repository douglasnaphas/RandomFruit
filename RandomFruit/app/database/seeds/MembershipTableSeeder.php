<?php

class MemberShipTableSeeder extends Seeder {
	public function run()
	{
		DB::table('memberships')->delete();
		$users = User::all();
		$projects = Project::where('name', '=', 'RandomFruit')->get();
		$project = $projects[0];
		$roles = Role::all();
		for( $i = 0; $i < count($users); $i++){
			Membership::create(array(
				'user_id' => $users[$i]->id,
				'project_id' => $project->id,
				'role_id' => $roles[$i % count($users)]->id
			));
		}
	}
}
