<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

Route::filter('user_only', function(){
	if(!Auth::check())
		return Redirect::to('login');

});

Route::filter('guest_only', function(){
	if(Auth::check())
		return Redirect::to('dash');
});


Route::any('/', array('before' => 'user_only', function(){
	return Redirect::route('dash');
}));

Route::any('login', array('as' => 'login', 'uses' => 'UserController@loginAction', 'before' => 'guest_only'));

//Ticket editing 
Route::post('api/create_ticket', array('as' => 'createTicket', 'uses' => 'TicketController@createticketAction'));
Route::post('api/edit_ticket/{project_name}/{ticket_number}', array('as' => 'createTicket', 'uses' => 'TicketController@editTicketAction'));
Route::post('api/owner_assign/{project_name}/{ticket_number}', array('as' => 'ownerAssign', 'uses' => 'TicketController@assignTicketOwner'));

//Getting ticket info
Route::get('api/owner_select/{project_name}/{ticket_number}', array('as' => 'ownerList', 'uses' => 'TicketController@getOwnerSelectedInList'));
Route::get('api/ticket_description/{project_name}/{ticket_number}', array('as' => 'getDescription', 'uses' => 'TicketController@getTicketDescription'));
Route::get('api/week_due_select/{project_name}/{ticket_number}', array('as' => 'weekDueList', 'uses' => 'TicketController@getWeekDueSelectedInList'));
Route::get('api/week_completed_select/{project_name}/{ticket_number}', array('as' => 'weekCompletedList', 'uses' => 'TicketController@getWeekCompletedSelectedInList'));
Route::post('api/week_due_assign/{project_name}/{ticket_number}', array('as' => 'assignWeekDue', 'uses' => 'TicketController@assignWeekDue'));
Route::post('api/week_completed_assign/{project_name}/{ticket_number}', array('as' => 'assignWeekCompleted', 'uses' => 'TicketController@assignWeekCompleted'));

//Getting and creating comments
Route::get('api/get_comments/{project_name}/{ticket_number}', array('as' => 'getComments', 'uses' => 'TicketController@showCommentsHTML'));
Route::post('api/create_comment/{project_name}/{ticket_number}', array('as' => 'createComment', 'uses' => 'TicketController@createComment'));

//Logging work
Route::post('api/add_work_log/{project_name}/{ticket_number}', array('as' => 'addWorkLog', 'uses' => 'WorkLogController@addWorkLog'));

Route::any('dash', array('as' => 'dash', 'before' => 'user_only', function(){
	return View::make('instructordash');
}));

Route::any('project/{project_name}/ticket/{ticket_number}', function($project_name, $ticket_number){
	//$project = Project::where('name', '=', $project_name)->with('tickets')->get()->first();
        $project = Project::fromName($project_name);
	$ticket = Ticket::where('project_id', '=', $project->id)->where('number', '=', $ticket_number)->with('owner')->with('creator')->get()->first();
	return View::make('ticket')->with('project', $project)->with('ticket', $ticket);
        //echo "Ticket name: " . $ticket->title . "    Creator: " . $ticket->creator->username; 


});

Route::any('project/{project_name}/tickets', function($project_name){
	$project = Project::where('name', '=', $project_name)->with('tickets')->get()->first();
	return View::make('viewtickets')->with('project', $project);
});

Route::any('courses', function(){
    return View::make('viewcourse');
});

Route::any('logout', array('uses' => 'UserController@logout'));

