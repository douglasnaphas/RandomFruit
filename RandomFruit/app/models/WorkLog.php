<?php

/**
*  An instance of a user logging work against a ticket. The work occurs in a Week. A Work Log is like a work event.
*/
class WorkLog extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table ='work_logs';

	/**
	*  Get the ticket this Work Log belongs to.
	*  @return Ticket
	*/
	public function ticket(){
		return $this->belongsTo('Ticket');
	}

	/**
	*  Get the user who logged this Work Log.
	*  @return User
	*/
	public function user(){
		return $this->belongsTo('User');
	}

	/**
	*  Get the week that this Work Log occurred.
	*  @return Week
	*/
	public function week(){
		return $this->belongsTo('Week');
	}

}
