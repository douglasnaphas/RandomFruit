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
}
