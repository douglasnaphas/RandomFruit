<?php


class Role extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';
	public function project(){
		return $this->hasOne('Project');
	}

}
