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
			'ticket-description' => 'Fix this test'
		);
		$response = $this->action('POST', 'TicketController@createticketAction', $post_input);
		$this->assertResponseOk();
		$response_json = json_decode($response->getcontent());
		$this->assertEquals('ThisIsATest', $response_json->title);
	}

	public function testEditTicketName(){
		$user = User::fromUserName('admin');
		$this->be($user);
		$ticket = new Ticket();

		$ticket->title = 'OldName';
		$ticket->description = 'OldDescription';
		$ticket->creator_id = $user->id; 
		$ticket->owner_id = $user->id;
		$ticket->project_id = Project::fromName('RandomFruit')->id;
		$ticket->save();

		//Refresh the ticket values to get the number
		$ticket = Ticket::find($ticket->id);


		$post_input = array(
			'ticket-title' => 'NewName',
		);

		$response = $this->call('POST', "/api/edit_ticket/RandomFruit/" . $ticket->number, $post_input);
		$response_message = json_decode($response->getcontent());
		var_dump($response_message);

	}
}
