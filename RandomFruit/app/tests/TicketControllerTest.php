<?php

class TicketControllerTest extends TestCase{
	public function setUp(){
		parent::setUp();
		Artisan::call('migrate');
		$this->seed();
	}

	/**
	 * I'm actually going to create some ticket controller tests
	 */
	public function testCreateTicket(){
		$user = User::fromUsername('admin');
		$this->be($user);
		$post_input = array(
			'ticket-title' => 'ThisIsATest',
			'ticket-description' => 'Fix this test',
			'project' => Project::fromName('RandomFruit')->id,
			'owner' => $user->id,
			'planned-hours' => 4.0
		);
		$response = $this->action('POST', 'TicketController@createticketAction', $post_input);
		$response_json = json_decode($response->getcontent());
		var_dump($response_json);
		$this->assertResponseOk();
		$this->assertEquals('ThisIsATest', $response_json->title);
	}

	public function testEditTicketPlannedHours(){
		$user = User::fromUserName('admin');
		$this->be($user);
		$ticket = new Ticket();

		$ticket->title = 'OldName';
		$ticket->description = 'OldDescription';
		$ticket->creator_id = $user->id; 
		$ticket->owner_id = $user->id;
		$ticket->project_id = Project::fromName('RandomFruit')->id;
		$ticket->planned_hours = 4.0;
		$ticket->save();

		//Refresh the ticket values to get the number
		$ticket = Ticket::find($ticket->id);


		$post_input = array(
			'planned_hours' => 7.0,
		);

		$response = $this->call('POST', "/api/edit_ticket/RandomFruit/" . $ticket->number, $post_input);
		echo($response->getcontent());
		$response_message = json_decode($response->getcontent());
		var_dump($response_message);
		$this->assertEquals(7.0, $response_message->data->planned_hours);

	}
	public function testCreateTicketHours(){
		$user = User::fromUserName('admin');
		$this->be($user);
		$ticket = new Ticket();

		$ticket->title = 'OldName';
		$ticket->description = 'OldDescription';
		$ticket->creator_id = $user->id; 
		$ticket->owner_id = $user->id;
		$ticket->project_id = Project::fromName('RandomFruit')->id;
		$ticket->planned_hours = 4.0;
		$ticket->save();

		//Refresh the ticket values to get the number
		$ticket = Ticket::find($ticket->id);


		$post_input = array(
			'actual_hours' => 7.0,
		);

		$response = $this->call('POST', "/api/edit_ticket/RandomFruit/" . $ticket->number, $post_input);
		echo($response->getcontent());
		$response_message = json_decode($response->getcontent());
		var_dump($response_message);
		$this->assertEquals(7.0, $response_message->data->actual_hours);

	}
}
