<?php

class TicketTableSeeder extends Seeder {
	public function run()
	{
		DB::table('tickets')->delete();
		$project = Project::where('name', '=', 'RandomFruit')->get()->first();
		$ticket_name = "It's broken";
		$ticket_description = "fix_it";
		$user = User::where('username', '=', 'admin')->get()->first();
		$ticket = Ticket::create(array( 'title' => $ticket_name, 'description' => $ticket_description, 'planned_hours' => 4, 'actual_hours' => 0, 'owner_id' => $user->id, 'creator_id' =>$user->id, 'project_id' => $project->id));
	}
}
