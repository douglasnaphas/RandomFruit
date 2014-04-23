<?php

class CourseControllerTest extends TestCase{
	public function setUp(){
		parent::setUp();
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		$this->seed();
	}

	public function testCreateCourse(){
		//Log in as jeff
		$admin = User::fromUserName('admin');
		$this->be($admin);

		//Create a ticket (not from the frontend)
		$post_data = array(
			'code' => 'CIS 1111',
			'description' => 'Not a real course.'
		);

		$response  = $this->action( "POST", "CourseController@createCourse", $post_data);
		$this->assertResponseOk();
		$response_json = json_decode($response->getContent());
		$this->assertEquals($response_json->status, "success");
		$this->assertEquals($response_json->data->code, "CIS 1111");
		$this->assertEquals($response_json->data->description, "Not a real course.");
		
	}

}
