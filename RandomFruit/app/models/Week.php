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

	public function ticketsDue(){
		return $this->hasMany('Ticket', 'week_due_id');
	}

	public function ticketsCompleted(){
		return $this->hasMany('Ticket', 'week_completed_id');
	}

	public function workLogs(){
		return $this->hasMany('WorkLog');
	}

}
