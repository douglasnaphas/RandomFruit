<?php


class Ticket extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tickets';

	public function creator(){
		return $this->belongsTo('User', 'creator_id');
	}

	/**
	 * @var array Array of rules used to validate form input prior to submitting
	 */
    public static $validation_rules = array(
        'name' => 'required',
        'creator_id' => 'required',
		'project_id' => 'required',
		'owner_id' => 'required',
		'description' => 'required',
    );


    public static function create(array $attributes){
		$ticket = parent::create($attributes);
		$ticket->number = Ticket::where('project_id', '=', $ticket->project_id)->count();
		$ticket->save();

	}
	public function owner(){
		return $this->belongsTo('User', 'owner_id');
	} 
	
	public function project(){
		return $this->belongsTo('Project');
	}

}
