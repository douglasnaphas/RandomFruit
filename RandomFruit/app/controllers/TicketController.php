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
			'owner_id' => Auth::user()->id,
			'project_id' => Project::fromName('RandomFruit')->id,
			'description' => Input::get("ticket-description")
			// 'ticket-type' => Input::get("ticket-type"),
			// 'ticket-priority' => Input::get("ticket-priority"));
		);

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
		if(false){
			//Todo: add validation rules for $project_name and $ticket_number
			return; //error
		}

		if(!($selected_ticket = Project::fromName($project_name)->ticketFromNumber($ticket_number))){
			return; //error
		}

		$editable_values = array('title', 'description', 'owner_id');

		foreach($editable_value as $form_field){
			if($maybe_value = Input::has("ticket-$form_field")){
				$values_to_edit[$form_field] = $maybe_value;
				$rules_to_check[$form_field] = Ticket::$validation_rules[$form_field];
				$ticket->attributes[$form_field] = $editable_value;
			}
		}

		$ticket_attribute_validator = Validator::make($rules_to_check, $values_to_edit);

		if($ticket_attribute_validator->fails()){
			return Response::json($ticket_attribute_validator->messages(), 406);
		}
		else{
			try{

				$selected_ticket->save();
				Response::json($selected_ticket, 200);

			}catch(Exception $e){
				return Response::json(array( 'error' => 'Unable to process request', 'debug' => $e->getMessage()), 501);
			}
		}
	}
}
