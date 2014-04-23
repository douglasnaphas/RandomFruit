<?php

class ProjectControllerTest extends TestCase{
	public function setUp(){
		parent::setUp();
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		$this->seed();
	}

	public function testAddUserToProject(){
		//Log in as admin
		$admin = User::fromUserName('admin');
		$this->be($admin);

		//Create a ticket (not from the frontend)
		$post_data = array(
			'user_id' => User::fromUserName('jeff')->id,
			'project_id' => Project::fromName('Lightning')->id
		);

		$response  = $this->action( "POST", "ProjectController@addUser", $post_data);
		$this->assertResponseOk();
		$response_json = json_decode($response->getContent());
		$this->assertEquals($response_json->status, "success");
		$this->assertEquals($response_json->data->user->username, "jeff");
		$this->assertEquals($response_json->data->project->name, "Lightning");
		$this->assertTrue(Project::fromName('Lightning')->hasMember(User::fromUserName("jeff")->id));
		
	}

}
