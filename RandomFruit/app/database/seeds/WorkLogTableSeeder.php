<?php

class WorkLogTableSeeder extends Seeder {
	public function run()
	{
		DB::table('work_logs')->delete();
//		$ticket = Ticket::where('owner_id', '=', 'jeff')->where('description', '=', 'Construct UI wireframes')->get()->first();
		
//		$user = User::where('username', '=', 'jeff')->get()->first();

		$mysqli = new mysqli( "localhost", "root", "root", "RandomFruit");
		$result = $mysqli->query("select t.id from tickets t join users u on t.owner_id = u.id where t.title like 'Construct UI wireframes' and u.username like 'jeff'");
		$row = $result->fetch_assoc();
		$ticket_id = $row['id'];
		$result = $mysqli->query("select id from users where username like 'jeff'");
		$row = $result->fetch_assoc();
		$user_id = $row['id'];
		$mysqli->close();


		$work_log = WorkLog::create(array( 'ticket_id' => $ticket_id, 'user_id' => $user_id, 'week_id' => 1, 'value' => 5));


	}
}
