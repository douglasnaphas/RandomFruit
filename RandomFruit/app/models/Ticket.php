<?php


class Ticket extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tickets';

	public function creator(){
		return $this->hasOne('User', 'creator_id');
	} 
	public function owner(){
		return $this->hasOne('User', 'owner_id');
	} 
	
	public function project(){
		return $this->hasOne('Project');
	}
}
