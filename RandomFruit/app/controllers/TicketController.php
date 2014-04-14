<?php
use \Michelf\MarkdownExtra;

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
			'week_due_id' => Input::get("week_due")
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
		if(Input::has('description')){
			$modified_attribute = 'description';
			$selected_ticket->description = Input::get('description');
		}
		if(Input::has('owner_id')){
			$modified_attribute = 'owner_id';
			$selected_ticket->owner_id = Input::get('owner_id');
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
					$modified_attribute => htmlspecialchars($selected_ticket->getAttribute($modified_attribute))
				)
			);
			if($modified_attribute == "description"){
				$payload['data'][$modified_attribute] = $selected_ticket->parsedDescription();
			}
			return Response::json($payload, 200);

		}catch(Exception $e){
			return Response::json(array( 'error' => 'Unable to process request', 'debug' => $e->getMessage()), 501);
		}
	}

	/**
	 * given a project_name, ticket number from a url, and an owner id from post data, re-assign a ticket
	 *
	 */
	public function assignTicketOwner($project_name, $ticket_number)
	{
		$project = Project::fromName($project_name);
		$ticket = $project->getTicketFromNumber($ticket_number);
		if($project == null){
			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested project '$project_name' does not exist"
				)
			);
		}
		if($ticket == NULL ){

			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested ticket '$ticket_number' does not exist"
				)
			);

		}
		$modified_attribute = "owner_id";
		$validator = Validator::make(array($modified_attribute => Input::get($modified_attribute)), Ticket::$validation_rules);
		if($validator->fails()){
			$original = $ticket->getOriginal();
			$payload = array(
				'status' => 'fail',
				'messages' => $validator->messages()->toArray(),
				'data' => array(
					$modified_attribute => $original[$modified_attribute]
				)
			);
			return Response::JSON($payload);

		}
		try{
			$ticket->owner_id = Input::get($modified_attribute);
			$ticket->save();
			$ticket = Ticket::find($ticket->id);
			$payload = array( 
				'status' => 'success',
				'data' => array( 
					$modified_attribute => $ticket->owner->username
				)
			);
			return Response::JSON($payload, 200);

		}catch(Exception $e){
			return Response::JSON(array( 'error' => 'Unable to process request', 'debug' => $e->getMessage()), 501);
		}
	}

	/**
	 * given a project_name, ticket number from a url, and an owner id from post data, re-assign a ticket
	 *
	 */
	public function assignWeekDue($project_name, $ticket_number)
	{
		$project = Project::fromName($project_name);
		$ticket = $project->getTicketFromNumber($ticket_number);
		if($project == null){
			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested project '$project_name' does not exist"
				)
			);
		}
		if($ticket == NULL ){

			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested ticket '$ticket_number' does not exist"
				)
			);

		}
		$modified_attribute = "week_due";
		$validator = Validator::make(array($modified_attribute => Input::get($modified_attribute)), Ticket::$validation_rules);
		if($validator->fails()){
			$original = $ticket->getOriginal();
			$payload = array(
				'status' => 'fail',
				'messages' => $validator->messages()->toArray(),
				'data' => array(
					$modified_attribute => $original[$modified_attribute]
				)
			);
			return Response::JSON($payload);

		}
		try{
			$week_due_id = Input::get($modified_attribute);
			$ticket->week_due_id = ($week_due_id === 'NULL')? NULL : $week_due_id;
			$ticket->save();
			$ticket = Ticket::find($ticket->id);
			$payload = array( 
				'status' => 'success',
				'extra' => $week_due_id,
				'data' => array( 
					$modified_attribute => $ticket->week_due_id
				)
			);
			return Response::JSON($payload, 200);

		}catch(Exception $e){
			return Response::JSON(array( 'error' => 'Unable to process request', 'debug' => $e->getMessage()), 501);
		}
	}

	/**
	 * Gets a list of users for a project as a json response
	 *
	 */
	public function getOwnerSelectedInList($project_name, $ticket_number){
		$project = Project::fromName($project_name);
		$ticket = $project->getTicketFromNumber($ticket_number);
		if($project == null){
			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested project '$project_name' does not exist"
				)
			);
		}
		if($ticket == NULL ){

			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested ticket '$ticket_number' does not exist"
				)
			);

		}
		else
		{
			try{
				$payload = array();
				$owner_id = $ticket->owner->id;
				foreach($project->users as $user){
					$payload[$user->id] = $user->username;
				}
				$payload['selected'] = $owner_id;
				return Response::JSON($payload);
			}catch (Exception $e){
				return Response::JSON(
					array(
						"status"=>"error",
						"message"=>"An internal server error occurred."
					)
				);
			}

		}
	}
	/**
	 * Gets a list of users for a project as a json response
	 *
	 */
	public function getWeekDueSelectedInList($project_name, $ticket_number){
		$project = Project::fromName($project_name);
		$ticket = $project->getTicketFromNumber($ticket_number);
		if($project == null){
			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested project '$project_name' does not exist"
				)
			);
		}
		if($ticket == NULL ){

			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested ticket '$ticket_number' does not exist"
				)
			);

		}
		else
		{
			try{
				$payload = array();
				$week_id = $ticket->week_due_id ? $ticket->week_due_id : 'NULL';
				$payload['NULL'] = "Unset (Click to assign) $ticket->week_due_id";
				foreach($project->weeks as $week){
					$payload[$week->id] = "$week->number ($week->end_date)";
				}
				$payload['selected'] = $week_id;
				return Response::JSON($payload);
			}catch (Exception $e){
				return Response::JSON(
					array(
						"status"=>"error",
						"message"=>"An internal server error occurred."
					)
				);
			}
		}
	}
	/**
	 * Gets a list of users for a project as a json response
	 *
	 */
	public function getWeekCompletedSelectedInList($project_name, $ticket_number){
		$project = Project::fromName($project_name);
		$ticket = $project->getTicketFromNumber($ticket_number);
		if($project == null){
			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested project '$project_name' does not exist"
				)
			);
		}
		if($ticket == NULL ){

			return Response::JSON(
				array(
					"status" => "fail",
					"message" => "Requested ticket '$ticket_number' does not exist"
				)
			);

		}
		else
		{
			try{
				$payload = array();
				$week_id = $ticket->week_completed_id ? $ticket->week_completed_id : 'NULL';
				$payload['NULL'] = "Not Complete";
				foreach($project->weeks as $week){
					$payload[$week->id] = "$week->number ($week->end_date)";
				}
				$payload['selected'] = $week_id;
				return Response::JSON($payload);
			}catch (Exception $e){
				return Response::JSON(
					array(
						"status"=>"error",
						"message"=>"An internal server error occurred."
					)
				);
			}
		}
	}

	/**
	 * Returns, in plain text(markdown) the description of a ticket.
	 *
	 */
	public function getTicketDescription($project_name, $ticket_number){
		$selected_ticket;
		if(!($selected_ticket = Project::fromName($project_name)->getTicketFromNumber($ticket_number))){
			return "Could not load description"; //error
		}
		return $selected_ticket->description;
	}

	public function showCommentsHTML($project_name, $ticket_number){
		$selected_ticket;
		if(!($selected_ticket = Project::fromName($project_name)->getTicketFromNumber($ticket_number))){
			return "Could not load comments"; //error
		}
		return View::make('ajax/listComments')->with(array('ticket' => $selected_ticket));
	}
	public function createComment($project_name, $ticket_number){
		//Get the current user
		$comment_author = Auth::user();
		$project = Project::fromName($project_name);
		$ticket = $project->getTicketFromNumber($ticket_number);
		if(!($project || $ticket)){ //If project or ticket is null
			return new Response('Project/ticket combination does not exist', Response::HTTP_NOT_FOUND);
		}
		//Make sure that the user can create a comment
		if(!($project->hasMember($comment_author->id))){
			throw new Exception('Boop!');
			return new Response('You cannot comment on a project unless you are a member', Response::HTTP_FORBIDDEN);
		}
		//Create a comment
		try{
			$comment = new Comment();
			$comment->content = Input::get('content');
			$comment->ticket()->associate($ticket);
			$comment->user()->associate($comment_author);
			$comment->save();
			return View::make('ajax/listComments')->with(array('ticket' => $ticket));
		}catch(Exception $e){
			throw $e;
			return new Response('A server side error occurred', 506);
		}
	}

}
