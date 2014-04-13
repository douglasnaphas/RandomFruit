<?php


class Week extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table ='weeks';
	

	public function project(){
		return $this->belongsTo('Project');
	}

	public function tickets(){
		return $this-hasMany('Ticket');
	}

}
