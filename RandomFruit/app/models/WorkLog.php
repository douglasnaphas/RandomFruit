<?php


class WorkLog extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table ='work_logs';
	
	public function ticket(){
		return $this->belongsTo('Ticket');
	}

	public function user(){
		return $this->belongsTo('User');
	}

	public function week(){
		return $this->belongsTo('Week');
	}

}
