<?php

class WorkLogControllerTest extends TestCase{
	public function setUp(){
		parent::setUp();
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		$this->seed();
	}

	public function testUpdateWorkLogOnce(){
		//Log in as jeff
		$jeff = User::fromUserName('jeff');
		$project = Project::fromName('RandomFruit');
		$this->be($jeff);
		//Create a ticket (not from the frontend)
		$ticket = new Ticket();
		$ticket->title = "Work log test";
		$ticket->description = "";
		$ticket->owner_id = $jeff->id;
		$ticket->creator_id = $jeff->id;
		$ticket->planned_hours = 4.0;
		$ticket->project_id = $project->id;
		$ticket->save();

		//update ticket to get ticket number
		$ticket = Ticket::find($ticket->id);

		//Post to the ticket controller a work log entry for 4 hours
		$post_data = array(
			"week" => $project->weeks()->get()->first()->id,
			"hours_worked" => "4.0"
		);

		$response = $this->action(
			"POST",
			"WorkLogController@addWorkLog", //controller method
			array("project_name" => $project->name, "ticket_number" => $ticket->number), //url parameters,
			$post_data //well, post data
		);
			
		//Ensure that the response succeeds
		$response_json = json_decode($response->getContent());
		var_dump($response_json);
		$this->assertResponseOk();

		//Assert that the actual hours == 4.0 hours
		$this->AssertEquals($response_json->data->actual_hours,  4.0);


		//Assert that the work log has the same user_id as jeff
		$this->AssertEquals($response_json->data->work_log->user_id, $jeff->id);
	}

	/*
	public function testUpdateWorkLogMultipleTimes(){
		//Log in as admin
		//Create a ticket (not from the frontend)
		//Post to the ticket controller a work log entry for 4 hours
		//Ensure that the response succeeds
		//Assert that the actual hours == 4.0 hours
		//Post to the ticket controller a work log entry for 4 hours
		//Ensure that the response succeeds
		//Assert that the actual hours == 8.0 hours
		//Post to the ticket controller a work log entry for 4 hours
		//Ensure that the response succeeds
		//Assert that the actual hours == 12.0 hours
	}
	 */

}
