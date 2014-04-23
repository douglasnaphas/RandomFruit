<?php

class ProjectController extends BaseController
{
	public function addUser(){
		$user;
		$project;
		if(($user = User::find(Input::get('user_id'))) == NULL)
			return Response::json(
				array(
					'status' => 'fail',
					'message' => array( 'user_id' => "User does not exist")
				)
		);
		if(($project = Project::find(Input::get('project_id'))) == NULL)
			return Response::json(
				array(
					'status' => 'fail',
					'message' => array( 'project_id' => "Project does not exist")
				)
		);

		try{
			$project->users()->attach($user->id);
			return Response::json(
				array(
					'status' => 'success',
					'data' => array('project' => $project->toArray(), 'user' => $user->toArray())
				)
			);
		}
		catch(Exception $e){
			return Response::json(
				array(
					'status' => 'fail',
					'error' => array( $e->getMessage())
				)
			);
		}
	}
}
