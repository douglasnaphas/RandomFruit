<?php


class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

	public static $validation_rules =
		array(
			'name' => 'sometimes',
			'description' => 'sometimes',
			'course_id' => 'sometimes|exists:courses,id'
		);
	

	public function users(){
		return $this->belongsToMany('User', 'memberships');
	} 

	public function tickets(){
		return $this->hasMany('Ticket');
	}
        
        public function course(){
            return $this->belongsTo('Course');
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
        $results = DB::table('projects')
            ->join('tickets', 'tickets.project_id', '=', 'projects.id')
            ->join('weeks', 'weeks.id', '=', 'tickets.week_completed_id')
            ->where('projects.id', '=', $this->id)
            ->groupBy('weeks.number')
            ->select(DB::raw("weeks.number, sum(tickets.planned_hours) as hours"))
            ->get();
        $returnArray = array(0);
        foreach($results as $result){
            $offset = intval($result->number - count($returnArray));
            $current_sum = count($returnArray) ? max($returnArray) : 0;
            while($offset >= 1){
                $returnArray[] = $current_sum;
                $offset -= 1;
            }
            $returnArray[] = $current_sum + floatval($result->hours);
        }
        return $returnArray;

    }

    public function getActualValueData(){
        $results =  DB::table('projects')->join('tickets', 'tickets.project_id', '=', 'projects.id')
            ->join('work_logs', 'work_logs.ticket_id', '=', 'tickets.id')
            ->join('weeks', 'weeks.id', '=', 'work_logs.week_id')
            ->where('projects.id', '=', $this->id)
            ->orderBy('weeks.number')
            ->groupBy('weeks.number')
            ->select(DB::raw("weeks.number, sum(work_logs.value) as hours"))
            ->get();
        $returnArray = array(0);
        foreach($results as $result){
            $offset = intval($result->number - count($returnArray));
            $current_sum = count($returnArray) ? max($returnArray) : 0;
            while($offset >= 1){
                $returnArray[] = $current_sum;
                $offset -= 1;
            }
            $returnArray[] = $current_sum + floatval($result->hours);
        }
        return $returnArray;
    }

    public function getPlannedValueData(){
        $results = DB::table('projects')
            ->join('tickets', 'tickets.project_id', '=', 'projects.id')
            ->join('weeks', 'weeks.id', '=', 'tickets.week_due_id')
            ->where('projects.id', '=', $this->id)
            ->groupBy('weeks.number')
            ->select(DB::raw("weeks.number, sum(tickets.planned_hours) as hours"))
            ->get();

        $returnArray = array(0);
        foreach($results as $result){
            $offset = intval($result->number - count($returnArray));
            $current_sum = count($returnArray) ? max($returnArray) : 0;
            while($offset >= 1){
                $returnArray[] = $current_sum;
                $offset -= 1;
            }
            $returnArray[] = $current_sum + floatval($result->hours);
		}
		$weeksCount = count($this->weeks);
		$current_sum = count($returnArray) ? max($returnArray) : 0;
		while(count($returnArray) <= $weeksCount){
			$returnArray[] = $current_sum;
		}
        return $returnArray;
	}

    /**
     * Returns an array of y/m/d formatted week strings used for the project graph
     *
     * @return Array
     */
    public function weeksLegendArray(){
        //Placeholder in case there are no weeks defined
        $legendArray = array("Week 0");

        // The list of Week models for the project
        $weeks = $this->weeks()->orderBy('weeks.number')->get();

        // Zero the graph by setting a week before the end of the
        // first week.
        if($this->weeks()->count() > 0){
            $week_interval = new DateInterval("P1W");
            $week_zero = new DateTime($weeks[0]->end_date);
            $week_zero->sub($week_interval);
            $legendArray[0] = $week_zero->format('m/d/y');
        }

        // Add each week to the graph legend formatted m/d/y
        foreach($weeks as $week){
            $dateTime = new DateTime($week->end_date);
			$legendArray[] = $dateTime->format("m/d/y");
		}

        // Return the array of formatted dates
		return $legendArray;
	}

	public function getDeleteUrl(){
		return URL::action(
			'ProjectController@deleteProject',
			array(
				'project_id' => $this->id
			)
		);
	}

    public function getRemoveMemberUrl($user){
        return Url::action(
            'ProjectController@removeMember',
            array(
                'project_id' => $this->id,
                'user_id' => $user->id
            )
        );
    }
}
