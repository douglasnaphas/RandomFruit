<?php

class CourseController extends BaseController{


	/**
	 * Creates a course given code and description from post data
	 *
	 */
	public function createCourse(){
		$input_array = array(
			'code' => Input::get('code'),
			'description' => Input::get('description')
		);
		$validator = Validator::make($input_array, Course::$validation_rules);

		if($validator->passes()){
			try{
				$course = new Course();
				$course->code = $input_array['code'];
				$course->description = $input_array['description'];
				$course->save();
				return Response::json(array('status' => 'success', 'data' => $course->toArray()));
			}
			catch(Exception $e){
				return Response::json(array('status' => 'fail', 'error' => $e->getMessages()));
			}
		}else{
			return Response::json(array('status' => 'fail', 'messages' => $validator->messages->all()));
		}

	}

	/**
	 * Adds an existing project to a course from post data
	 */
	public function addProject(){

		$input_array = array(

			'name' => Input::get('project_name'),
			'description' => Input::get('project_description'),
			'course_id' => Input::get('course_id')

		);
		$validator = Validator::make($input_array, Project::$validation_rules);

		if($validator->passes()){
			try{
				$course = Course::find($course_id);
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

	public function toggleActive($course_id){
		if(!($course = Course::find($course_id))){
			return Response::json(
				array(
					'status' => 'fail',
					'message' => "The course $course_id does not exist"
				), 404);
		}
		try{
			$course->active = !($course->active);
			$course->save();
			return Response::json(
				array(
					'status' => 'success',
					'data' => $course->active
				)
			);

		}
		catch(Exception $e){
			return Response::json(
				array(
					'status' => 'fail',
					'message' => $e->getMessage() 
				), 404);
		}
	}


}
