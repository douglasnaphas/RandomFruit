<?php


class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
	

	public static function users(){
		return $this->belongsToMany('User', 'memberships');
	} 
}
