<?php

class UserControllerTest extends TestCase{
	public function setUp(){
		parent::setUp();
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		$this->seed();
	}

	public function testCreateUser(){
		//Log in as admin
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

	public function testChangeUserPasswordPasses(){
		//Log in as jeff
		$jeff = User::fromUserName('jeff');
		$this->be($jeff);

		$post_data = array(
			'old-password' => 'ffej',
			'new-password' => 'testPassword',
			'new-password-copy' => 'testPassword'
		);

		$response = $this->action("POST", "UserController@changePassword", $post_data);
		$this->assertResponseOk();
		$response_json = json_decode($response->getContent());
		var_dump($response_json);
		$this->assertEquals($response_json->status, "success");

		$jeff = User::find($jeff->id);
		$this->assertTrue(Hash::check('testPassword', $jeff->password));
	}

	public function testChangeUserPasswordWrongOld(){
		//Log in as jeff
		$jeff = User::fromUserName('jeff');
		$this->be($jeff);


		$post_data = array(
			'old-password' => 'incorrect',
			'new-password' => 'testPassword',
			'new-password-copy' => 'testPassword'
		);

		$response = $this->action("POST", "UserController@changePassword", $post_data);
		$response_json = json_decode($response->getContent());
		$this->assertEquals($response_json->status, "fail");
		$this->assertTrue($response_json->messages->{'old-password'} != NULL);
	}

	public function testChangeUserPasswordMissmatch(){
		//Log in as jeff
		$jeff = User::fromUserName('jeff');
		$this->be($jeff);


		$post_data = array(
			'old-password' => 'ffej',
			'new-password' => 'testPassword',
			'new-password-copy' => 'testPyssword'
		);

		$response = $this->action("POST", "UserController@changePassword", $post_data);
		$response_json = json_decode($response->getContent());
		$this->assertEquals($response_json->status, "fail");
		$this->assertTrue($response_json->messages->{'new-password-copy'} != NULL);
	}
}
