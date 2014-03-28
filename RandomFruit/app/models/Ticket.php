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
