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
}
