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
	public function testBadTicketHours(){
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
			'actual_hours' =>  'burgers',
		);

		$response = $this->call('POST', "/api/edit_ticket/RandomFruit/" . $ticket->number, $post_input);
		echo($response->getcontent());
		$response_message = json_decode($response->getcontent());
		var_dump($response_message);
		$this->assertEquals("fail", $response_message->status);

	}
	public function testEditDescription(){
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
			'description' => 'NewDescription',
		);

		$response = $this->call('POST', "/api/edit_ticket/RandomFruit/" . $ticket->number, $post_input);
		echo($response->getcontent());
		$response_message = json_decode($response->getcontent());
		var_dump($response_message);
		$ticket->description = 'NewDescription';
		$this->assertEquals($ticket->parsedDescription(), $response_message->data->description);

	}

	public function testEditOwner(){
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
			'owner_id' => User::fromUserName('jeff')->id
		);

		try{
			$url = URL::route("ownerAssign", array("project_name" => 'RandomFruit', "ticket_number" => $ticket->number));
		}catch(Exception $e){
			vardump($e);
		}
		echo $url;
		$response = $this->call('POST', $url, $post_input);
		echo($response->getcontent());
		$response_message = json_decode($response->getcontent());
		var_dump($response_message);
		$this->assertEquals('jeff', $response_message->data->owner_id);

	}

	public function testCreateComent(){
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
			'content' => "this project sucks"
		);

		try{
			$url = URL::route("createComment", array("project_name" => 'RandomFruit', "ticket_number" => $ticket->number));
		}catch(Exception $e){
			return vardump($e);
		}
		echo $url;
		$response = $this->call('POST', $url, $post_input);
		echo($response->getcontent());
		$response_message = $response->getcontent();
		var_dump($response_message);
		$this->assertEquals($post_input['content'], $ticket->comments[0]->content);

	}

	public function testSetWeekDue(){
		$user = User::fromUserName('admin');
		$this->be($user);
		$post_input = array(
			'ticket-title' => 'ThisIsATest',
			'ticket-description' => 'Fix this test',
			'project' => Project::fromName('RandomFruit')->id,
			'owner' => $user->id,
			'planned-hours' => 4.0,
			'week_due' => Week::where('project_id','=',Project::fromName('RandomFruit')->id)->where('number', '=', 1)->get()->first()->id,
		);
		var_dump($post_input);
		$response = $this->action('POST', 'TicketController@createticketAction', $post_input);
		$response_json = json_decode($response->getcontent());
		var_dump($response_json);
		$this->assertResponseOk();
		$this->assertEquals(1, $response['week_due']);
	}
}
