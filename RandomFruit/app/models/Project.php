<?php


class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
	

	public function users(){
		return $this->belongsToMany('User', 'memberships');
	} 

	public function tickets(){
		return $this->hasMany('Ticket');
	}

	/**
	 * Searches for a project with the given name
	 *
	 * @param string name - The project name
	 * @return Project - The project if it exists. Otherwise null
	 */
	public static function fromName($name){
		return self::where('name', '=', $name)->get()->first();
	}


	/**
	 * Gets a project's ticket relative to it's number
	 * @param integer $ticket_number - The ticket number
	 *
	 * @return Ticket - The corresponding ticket number
	 */
	public function getTicketFromNumber($ticket_number){
		return Ticket::where('project_id', '=', $this->id)->where('number', '=', $ticket_number)->get()->first();
	}

	public function hasMember($user_id){
		return (Membership::where('project_id', '=', $this->id)->where('user_id', '=', $user_id)->count() == 1);
	}

	public function weeks(){
		return $this->hasMany('Week');
    }

    public function getEarnedValueData(){
        return DB::table('projects')->join('tickets', 'tickets.project_id', '=', 'projects.id')->join('weeks', 'weeks.id', '=', 'tickets.week_completed_id')->groupBy('weeks.number')->select(DB::raw("weeks.number, sum(tickets.planned_hours) as hours"))->get();

    }

    public function getActualValueData(){
        return DB::table('projects')->join('tickets', 'tickets.project_id', '=', 'projects.id')
            ->join('work_logs', 'work_logs.ticket_id', '=', 'tickets.id')
            ->join('weeks', 'weeks.id', '=', 'work_logs.week_id')
            ->groupBy('weeks.number')
            ->select(DB::raw("weeks.number, sum(work_logs.value) as hours"))
            ->get();
    }

    public function getPlannedValueData(){
        return DB::table('projects')->join('tickets', 'tickets.project_id', '=', 'projects.id')->join('weeks', 'weeks.id', '=', 'tickets.week_due_id')->groupBy('weeks.number')->select(DB::raw("weeks.number, sum(tickets.planned_hours) as hours"))->get();
    }
}
