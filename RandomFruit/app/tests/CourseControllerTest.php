<?php

class CourseControllerTest extends TestCase{
	public function setUp(){
		parent::setUp();
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		$this->seed();
	}

	public function testCreateCourse(){
		//Log in as admin
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

	public function testToggleActive(){
		//Log in as admin
		$admin = User::fromUserName('admin');
		$this->be($admin);

		//Get course
		$course = Course::fromCode('CIS 3223');

		$old_value = $course->active ? true : false;

		$response = $this->action("GET", "CourseController@toggleActive", array('course_id' => $course->id));
		$this->assertResponseOk();
		$response_json = json_decode($response->getContent());
		var_dump($response_json);
		$this->assertEquals($response_json->status, "success");
		$this->assertEquals($response_json->data, !($old_value));

		$course = Course::fromCode('CIS 3223');
		$this->assertEquals($response_json->data, $course->active ? true : false);


		$old_value = $course->active ? true : false;

		$response = $this->action("GET", "CourseController@toggleActive", array('course_id' => $course->id));
		$this->assertResponseOk();
		$response_json = json_decode($response->getContent());
		$this->assertEquals($response_json->status, "success");
		$this->assertEquals($response_json->data, !($old_value));

		$course = Course::fromCode('CIS 3223');
		$this->assertEquals($response_json->data, $course->active);

	}

}
