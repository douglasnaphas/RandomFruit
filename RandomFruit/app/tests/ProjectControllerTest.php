<?php

class ProjectControllerTest extends TestCase{
	public function setUp(){
		parent::setUp();
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

	public function testCreateProject(){
		//Log in as admin
		$admin = User::fromUserName('admin');
		$this->be($admin);

		//Create a ticket (not from the frontend)
		$post_data = array(
			'project_name' => 'barbeque sause',
			'project_description' => 'barbeque sause',
			'course_id' => Course::fromCode('CIS 7228')->id
		);

		$response  = $this->action( "POST", "ProjectController@createProject", $post_data);
		$this->assertResponseOk();
		$response_json = json_decode($response->getContent());
		var_dump($response_json);
		$this->assertEquals($response_json->status, "success");
		$this->assertEquals($response_json->data->project->name, "barbeque sause");
		$this->assertTrue(Project::fromName('barbeque sause') != NULL);
		
	}

	public function testDeleteProject(){
		$admin = User::fromUserName('admin');
		$this->be($admin);

		$project = Project::create(
			array(
				'course_id' => Course::fromCode('CIS 3223')->id,
				'name' => 'testProject',
				'description' => 'testProject'
			)
		);

		$response = $this->call("GET", $project->getDeleteUrl());
		$this->assertResponseOk();
		$response_json =  json_decode($response->getContent());
		var_dump($response_json);
		$this->assertEquals("success", $response_json->status);
		$this->assertNull(Project::find($project->id));
    }

    public function testRemoveUser(){
        $admin = User::fromUserName('admin');
        $this->be($admin);
        $jeff = User::fromUserName('jeff');
        $project = Project::fromName('RandomFruit');
        $url = $project->getRemoveMemberUrl($jeff);


        $response = $this->call('GET', $url);
        $this->assertResponseOk();
        $response_json = json_decode($response->getContent());
        var_dump($response_json);
        $this->assertEquals($response_json->status, "success");
        $this->assertFalse($project->hasMember($jeff->id));
    }

}
