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
		/* Convert form input names to mysql field names
		 * @Todo rename fields to match forms
		 *
		 */
		$ticket_attributes = array(
			'title' => Input::get("ticket-subject"),
			'creator_id' => Auth::user->id,
			'owner_id' => Auth::owner->id,
			'project_id' => Project::fromName('RandomFruit'),
			'description' => Input::get("ticket-description"),
			// 'ticket-type' => Input::get("ticket-type"),
			// 'ticket-priority' => Input::get("ticket-priority"));
		));

		/* Create a validator using the rules defined in the tickets model */
		$validator = Validator::make($ticket_attributes, Ticket::$validator_rules);

		// If the input from the form wasn't valid, return an error message
		if($validator->fails()){
			return Response::json($validation->messages(), 500);
		}
		else{ // Otherwise, attempt to create the ticket
			try{
				$ticket = Ticket::create("$ticket_attributes");
				return $ticket->toJson(); //Return the ticket as a json file

			}catch(Exception e){
				//If we hit an exception, then we have to revise our validator
				return Response::json(array("message" => "An sql error has occured", "debug" =>  e->message()), 501);
			}

		}

	}
}
