<?php


class Course extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table ='courses';

	public static $validation_rules = array(
		'code' => 'required',
		'description' => 'required'
	);
	
	public static function fromCode($code){
		return self::where('code','=', $code)->get()->first();
	}

	public function projects(){
		return $this->hasMany('Project');
	}

	public function getDeleteUrl(){
		return URL::action(
			'CourseController@deleteCourse',
			array(
				'course_id' => $this->id
			)
		);
	}

}
