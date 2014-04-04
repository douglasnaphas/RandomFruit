<?php

class TicketController extends BaseController
{
    public function createticketAction()
    {
        $error_message = "";
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
        return View::make('login')->with('error_message', $error_message);
    }
}
