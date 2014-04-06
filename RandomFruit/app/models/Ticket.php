<?php


class Ticket extends Eloquent {

	/**
	 * @var string The database table used by the model.
	 */
	protected $table = 'tickets';

	/* Defines values that cannot be filled from array */
	protected $guarded = array('id', 'number');

	public function creator(){
		return $this->belongsTo('User', 'creator_id');
	}

	/**
	 * @var array Array of rules used to validate form input prior to submitting
	 */
	public static $validation_rules = array(
		'title' => 'required',
		'creator_id' => 'required',
		'project_id' => 'required',
		'owner_id' => 'required',
		'description' => 'required',
	);


	/**
	 * Defines the tickets relationship to it's owner.
	 * This allows use of the 'owner' attribute as if it were a User model.
	 *
	 * @example: $owner = $ticket->owner; echo $owner->username;
	 * 
	 */
	public function owner(){
		return $this->belongsTo('User', 'owner_id');
	} 

	/**
	 * Defines the tickets relationship to it's project
	 * @example $project = $ticket->owner; echo $project->title
	 * 
	 */
	public function project(){
		return $this->belongsTo('Project');
	}

	/**
	 * Generate the url to the ticket's home page
	 *
	 * @return string The url to the tickets home page
	 */
	public function getUrl(){
		return URL::to("project/" . $this->project->title . "/ticket/" . $this->id);
	}

}
