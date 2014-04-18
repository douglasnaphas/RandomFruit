<?php


class Course extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table ='courses';
	
	public static function fromCode($code){
		return self::where('code','=', $code)->get()->first();
	}

	public function projects(){
		return $this->hasMany('Project');
	}

}
