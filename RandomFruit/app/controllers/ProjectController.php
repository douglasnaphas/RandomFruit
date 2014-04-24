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

	/**
	 * Adds an existing project to a course from post data
	 */
	public function createProject(){

		$input_array = array(

			'name' => Input::get('project_name'),
			'description' => Input::get('project_description'),
			'course_id' => Input::get('course_id')

		);
		$validator = Validator::make($input_array, Project::$validation_rules);

		if($validator->passes()){
			try{
				$course = Course::find($input_array['course_id']);
				$project = new Project();
				$project->name = $input_array['name'];
				$project->description = $input_array['description'];
				$course->projects()->save($project);

				return Response::json(
					array(
						'status' => 'success',
						'data' => array(
							'project' => $project->toArray(),
						)
					)
				);
			}
			catch(Exception $e){
				return Response::json(array('status' => 'fail', 'message' => $e->getMessage()));
			}
		}
		else{
			return Response::json(array('status' => 'fail', 'messages' => $validator->messages->all()));
		}
	}
}
