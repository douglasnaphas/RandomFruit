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

Route::any('/', function(){
	return Redirect::route('login');
});
Route::any('login', array('as' => 'login', 'uses' => 'UserController@loginAction'));

Route::any('dash', array('as' => 'dash', function(){
	return View::make('instructordash');
}));

Route::any('project/{project_name}/ticket/{ticket_number}', function($project_name, $ticket_number){
	//$project = Project::where('name', '=', $project_name)->with('tickets')->get()->first();
        $project = Project::find(1);
	$ticket = Ticket::where('project_id', '=', $project->id)->where('number', '=', $ticket_number)->with('owner')->with('creator')->get()->first();
	return View::make('ticket')->with('project', $project)->with('ticket', $ticket);
        //echo "Ticket name: " . $ticket->title . "    Creator: " . $ticket->creator->username; 


});

Route::any('project/{project_name}/tickets', function($project_name){
	$project = Project::where('name', '=', $project_name)->with('tickets')->get()->first();
	return View::make('viewtickets')->with('project', $project);


});
