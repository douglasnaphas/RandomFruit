<?php


class Ticket extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
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
	 * Creates a Ticket model and then assigns the number.
	 * @return Ticket the newly created ticket model
	 */
	public static function create(array $attributes){
		$ticket = parent::create($attributes);
		$ticket->number = Ticket::where('project_id', '=', $ticket->project_id)->count();
		$ticket->save();
		return $ticket;

	}
	public function owner(){
		return $this->belongsTo('User', 'owner_id');
	} 

	public function project(){
		return $this->belongsTo('Project');
	}

}
