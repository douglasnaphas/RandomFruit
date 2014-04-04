<?php


class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
	

	public function users(){
		return $this->belongsToMany('User', 'memberships');
	} 

	public function tickets(){
		return $this->hasMany('Ticket');
	}

	/**
	 * Searches for a project with the given name
	 *
	 * @param string name - The project name
	 * @return Project - The project if it exists. Otherwise null
	 */
	public static function fromName($name){
		return self::where('name', '=', $name)->get()->first();
	}

}
