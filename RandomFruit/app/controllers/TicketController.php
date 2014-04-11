<?php

class TicketController extends BaseController
{
	/**
	 * Creates a ticket from POST data and returns the ticket in json
	 *
	 * Route:  api/createticket
	 *
	 * @return Response 500 if validator fails 501 if sql fails
	 */
	public function createticketAction()
	{

		/* Convert form input names to mysql field names */

		$ticket_attributes = array(
			'title' => Input::get("ticket-title"),
			'creator_id' => Auth::user()->id,
			'owner_id' => Input::get("owner"),
			'project_id' => Input::get("project"),
			'planned_hours' => Input::get("planned-hours"),
			/* Project::fromName('RandomFruit')->id, */
			'description' => Input::get("ticket-description"),
			// 'ticket-type' => Input::get("ticket-type"),
			// 'ticket-priority' => Input::get("ticket-priority"));
		);
		$due_date = Input::get('due-date');

		if($due_date != '' && $due_date != NULL){
			$due_date = new DateTime($due_date);
			$ticket_attributes['due_date'] = $due_date->format('Y-m-d');

		}
		



		/* Create a validator using the rules defined in the tickets model */
		
		$validator = Validator::make($ticket_attributes, Ticket::$validation_rules);

		// If the input from the form wasn't valid, return an error message
		if($validator->fails()){

			// According to http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
			// 406 = "Not Acceptable"

			return Response::json($validator->messages()->toArray(), 406);
		}
		else{ 

			// Otherwise, attempt to create the ticket
			try{

				// Creates the ticket and returns the new ticket model
				$ticket = Ticket::create($ticket_attributes);
				
				// Returns json response with return code "OK"
				return Response::json($ticket, 200); //Return the ticket as a json file

			}catch(Exception $e){

				//If we hit an exception, then we have to revise our validator
				//500 -- "Internal Server error"
				return Response::json(
					array("message" => "An sql error has occured", 
					"debug" =>  $e->getMessage()), 501);
			}

		}

	}

	/**
	 * Edits a ticket!
	 *
	 * @param string $project_name
	 * @param string $ticket_number
	 *
	 * @returns Response 200 with ticket model if successfull, 406 with error messages if validation fails, 
	 * 	501 with {error: "human readable", debug: "exception message"} if sql satements fail
	 */
	public function editTicketAction($project_name, $ticket_number)
	{
		$values_to_edit = array();
		$rules_to_check = array();
		$selected_ticket;
		$validator;
		if(!($selected_ticket = Project::fromName($project_name)->getTicketFromNumber($ticket_number))){
			return; //error
		}
		if(Input::has('planned_hours')){
			$modified_attribute = 'planned_hours';
			$selected_ticket->planned_hours = Input::get('planned_hours');
		}
		if(Input::has('actual_hours')){
			$modified_attribute = 'actual_hours';
			$selected_ticket->actual_hours = Input::get('actual_hours');
		}
		$validator = Validator::make(array($modified_attribute => Input::get($modified_attribute)), Ticket::$validation_rules);
		if($validator->fails()){
			$original = $selected_ticket->getOriginal();
			$payload = array(
				'status' => 'fail',
				'messages' => $validator->messages()->toArray(),
				'data' => array(
					$modified_attribute => $original[$modified_attribute]
				)
			);
			return Response::json($payload);

		}
		try{

			$selected_ticket->save();
			$selected_ticket = Ticket::find($selected_ticket->id);
			$payload = array( 
				'status' => 'success',
				'data' => array( 
					$modified_attribute => $selected_ticket->getAttribute($modified_attribute)
				)
			);
			return Response::json($payload, 200);

		}catch(Exception $e){
			return Response::json(array( 'error' => 'Unable to process request', 'debug' => $e->getMessage()), 501);
		}
	}
}
