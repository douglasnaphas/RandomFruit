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

	public function tickets_due(){
		return $this->hasMany('Ticket', 'week_due_id');
	}
	public function tickets_completed(){
		return $this->hasMany('Ticket', 'week_completed_id');
	}

}
