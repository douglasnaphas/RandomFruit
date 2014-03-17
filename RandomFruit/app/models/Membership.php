<?php


class Membership extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'memberships';
	public function project(){
		return $this->hasOne('Project');
	}

	public function user(){
		return $this->hasOne('User');
	}

	public function role(){
		return $this->hasOne('Role');
	}

}
