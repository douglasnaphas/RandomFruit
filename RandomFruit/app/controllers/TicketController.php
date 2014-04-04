<?php

class TicketController extends BaseController
{
    public function createticketAction()
    {
        $error_message = "";
	$con = mysqli_connect("localhost", "RandomFruit", "Durian", "RandomFruit");
	// Check connection                                                                                                                            
	if (mysqli_connect_errno()) {
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$subject = Input::get('ticket-subject');
	$subject = $con->real_escape_string( $subject );
	$description = Input::get('ticket-description');
	$description = $con->real_escape_string( $description );

	/* Mock forgeign key values. */
	$user = Auth::user();
	foreach($user->projects as $project){
		echo $project->id;
	}
	$project_id = 1;
	$creator_id = $user->id;
	$owner_id = $user->id;


	$sql = "INSERT INTO tickets (title, description, project_id, creator_id, owner_id) VALUES ('$subject', '$description', 1, 1, 1)";

	if (!mysqli_query($con, $sql)) {
	    die('Error: ' . mysqli_error($con));
	}
	//echo "<html><head><script>top.location = '../../instructordash.php';</script></head><body></body></html>";

	mysqli_close($con);

/*
        if (Input::server("REQUEST_METHOD") == 'POST') {
            $validator = Validator::make(Input::all(), Ticket::$validation_rules);
            if ($validator->passes()) {
                $ticket = array(
                    'ticket-subject' => Input::get("ticket-subject"),
                    'ticket-reporter' => Input::get("ticket-reporter"),
                    'ticket-description' => Input::get("ticket-description"),
                    'ticket-type' => Input::get("ticket-type"),
                    'ticket-priority' => Input::get("ticket-priority"));


                {
                    return Redirect::route("dash");
                }

            }
            $error_message = "<strong>Oops! You've incorrectly filled the fields out.</strong><br />Please try again.";
        }
*/
        //return View::make('dash/modals/action_createticket')->with('post_data', Input::all());
	return View::make('instructordash'); // We could remember the page where we start.
    }
}
