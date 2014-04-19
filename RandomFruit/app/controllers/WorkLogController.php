<?php

class WorkLogController extends BaseController
{
	public function addWorkLog($project_name, $ticket_number){
		$project;
		$ticket;
		$successArray = array("status" => "success");
		$failureArray = array("status" => "fail");
		if(!($project = Project::fromName($project_name))){
			return new Response("The selected project does not exist", 404); 
		}
		else if(!($ticket = $project->getTicketFromNumber($ticket_number))){
			return new Response("The selected ticket does not exist", 404); 
		}

		try{
			$work_log = new WorkLog();
			$work_log->week_id = Input::get('week');
			$work_log->value = Input::get('hours_worked');
			$work_log->user_id = Auth::user()->id;
			$ticket->workLogs()->save($work_log);
			$payload = array("status" => "success", 
				"data" => array(
					"work_log" => $work_log->toArray(),
					"actual_hours" =>  $ticket->computeActualHours()
				)
			);

			return Response::JSON($payload, 200);
		}catch(Exception $e){
			$failureArray['message'] = "A server side error occurred";
			$failureArray['debug'] = $e->getMessage();
			return Response::JSON($failureArray, 504);
		}
	}
}
