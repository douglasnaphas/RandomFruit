<?php

class CourseController extends BaseController{


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


}
