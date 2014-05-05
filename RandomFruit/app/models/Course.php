<?php


class Course extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table ='courses';

    /**
     * The validation rules used to validate course creation form data
     *
     * @var array
     */
	public static $validation_rules = array(
		'code' => 'required',
        'description' => 'required',
        'start_date' => 'date|required',
        'week_number' => 'numeric'
	);
	
    /**
     * Retrieves a course model based on the course code
     *
     * @return Course
     */
	public static function fromCode($code){
		return self::where('code','=', $code)->get()->first();
	}

    /**
     * Defines the relation to the courses projects
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany The relation used to retrieve the author
     */
	public function projects(){
		return $this->hasMany('Project');
	}

    /**
     * Gets the url that can be used to delete the course
     *
     * @return string
     */
	public function getDeleteUrl(){
		return URL::action(
			'CourseController@deleteCourse',
			array(
				'course_id' => $this->id
			)
		);
	}

}
