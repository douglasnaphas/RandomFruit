<?php

class WorkLogController extends BaseController
{
	public function addWorkLog($project_name, $ticket_number){
		$project;
		$ticket;
		if(!($project = Project::fromName($project_name)){
			return new Resoponse("The selected project does not exist", 404); 
		}
		else if(!($ticket = $project->getTicketFromNumber($ticket_number)){
			return new Response("The selected ticket does not exist", 404); 
		}

		try{
			$work_log = new WorkLog();
			$work_log->week_id = Input::get('week');
			$work_log->value = Input::get('hours_worked');
			$ticket->workLogs()->save($work_log);
		}catch(Exception $e){
			return new Response("A server side error occurred", 504);
		}


	}
}
