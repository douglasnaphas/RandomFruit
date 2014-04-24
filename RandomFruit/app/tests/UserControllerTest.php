<?php

class UserControllerTest extends TestCase{
	public function setUp(){
		parent::setUp();
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		$this->seed();
	}

	public function testCreateUser(){
		//Log in as jeff
		$admin = User::fromUserName('admin');
		$this->be($admin);

		//Create a ticket (not from the frontend)
		$post_data = array(
			'username' => 'testUser',
			'password' => 'testPassword',
			'email' => 'testEmail@testsite.com'
		);

		$response  = $this->action( "POST", "UserController@createUser", $post_data);
		$this->assertResponseOk();
		$response_json = json_decode($response->getContent());
		$this->assertEquals($response_json->status, "success");
		$this->assertEquals($response_json->data->username, 'testUser');
		$this->assertEquals($response_json->data->email, 'testEmail@testsite.com');
		$this->assertTrue(User::fromUserName('testUser') != NULL);
	}

}
