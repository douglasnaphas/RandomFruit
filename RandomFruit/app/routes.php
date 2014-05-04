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

Route::filter('admin_only', function(){
	if(!Auth::check())
		return Redirect::to('login');
	else if(!Auth::user()->is_admin)
		return Response::make("You must be an admin to do that", 401);
});

Route::filter('project_member_json', function($route){
    if(!Auth::user()->is_admin){
        $project_name = $route->getParameter('project_name');
        if($project = Project::fromName($project_name)){
            if(!($project->hasMember(Auth::user()->id) || Auth::user()->is_admin)){
                return Response::json(array(
                    status => "fail",
                    message => "You are not a member of $project_name"
                ), 
               401 
            );
            }
        }else{
            return Response::json(array(
                status => "fail",
                message => "$project_name does not exist"
            ), 
            404);
        }
    }
});

Route::filter('project_member_http', function($route){
    $project_name = $route->getParameter('project_name');
    if($project = Project::fromName($project_name)){
        if(!($project->hasMember(Auth::user()->id) || Auth::user()->is_admin)){
            return Response::make(
                "You are not a member of $project_name", 
                401
            );
        }
    }else{
        return Response::make(
            "Project $project_name does not exist"
            , 
            404);
    }
});


Route::any('/', array('before' => 'user_only', function(){
	return Redirect::route('dash');
}));

Route::any('login', array('as' => 'login', 'uses' => 'UserController@loginAction', 'before' => 'guest_only'));


Route::group(array('before' => 'admin_only'), function(){
	//Creating courses
	Route::post('api/create_course', array('as' => 'createCourse', 'uses' => 'CourseController@createCourse'));

	//Adding projects to courses
	Route::post('api/create_project', array('as' => 'createProject', 'uses' => 'ProjectController@createProject'));

	//Creating users
	Route::post('api/create_user', array('as' => 'createUser', 'uses' => 'UserController@createUser'));

	//Adding users to projects
	Route::post('api/add_user_to_project', array('as' => 'addUser', 'uses' => 'ProjectController@addUser'));
	
	Route::any('courses', function(){
		return View::make('viewcourse');
	});

	Route::any('api/toggle-active/{course_id}', array('as' => 'toggleActive', 'uses' =>'CourseController@toggleActive'));
	Route::any('api/toggle-planning/{course_id}', array('as' => 'togglePlanning', 'uses' =>'CourseController@togglePlanning'));
	Route::any(
		'api/delete-project/{project_id}',
		array('as' => 'deleteProject', 'uses' =>'ProjectController@deleteProject')
	);
	Route::any(
		'api/delete-course/{course_id}',
		array('as' => 'deleteCourse', 'uses' =>'CourseController@deleteCourse')
	);

	Route::any(
		'api/remove-member/{project_id}/{user_id}',
		array('as' => 'removeMember', 'uses' =>'ProjectController@removeMember')
	);
});

Route::group(array('before' => 'user_only'), function(){
    Route::any('dash', array('as' => 'dash', 'before' => 'user_only', function(){
        return View::make('instructordash');
    }));

    Route::group(array('before' =>  'project_member_http'), function(){
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
    });


    Route::any('logout', array('uses' => 'UserController@logout'));
    Route::any('search', array('as' => 'search', 'uses' => 'TicketController@search'));

    //Editing user info
    Route::post('api/change_password', array('as' => 'changePassword', 'uses' => 'UserController@changePassword'));

    //Ticket editing 
    Route::post('api/create_ticket', array('as' => 'createTicket', 'uses' => 'TicketController@createticketAction'));

    Route::group(array('before' => 'project_member_json'), function(){
        Route::post('api/edit_ticket/{project_name}/{ticket_number}', array('as' => 'editTicket', 'uses' => 'TicketController@editTicketAction'));
        Route::post('api/owner_assign/{project_name}/{ticket_number}', array('as' => 'ownerAssign', 'uses' => 'TicketController@assignTicketOwner'));

        //Getting ticket info
        Route::get('api/owner_select/{project_name}/{ticket_number}', array('as' => 'ownerList', 'uses' => 'TicketController@getOwnerSelectedInList'));
        Route::get('api/ticket_title/{project_name}/{ticket_number}', array('as' => 'getTitle', 'uses' => 'TicketController@getTicketTitle'));
        Route::get('api/ticket_description/{project_name}/{ticket_number}', array('as' => 'getDescription', 'uses' => 'TicketController@getTicketDescription'));
        Route::get('api/week_due_select/{project_name}/{ticket_number}', array('as' => 'weekDueList', 'uses' => 'TicketController@getWeekDueSelectedInList'));
        Route::get('api/week_completed_select/{project_name}/{ticket_number}', array('as' => 'weekCompletedList', 'uses' => 'TicketController@getWeekCompletedSelectedInList'));
        Route::post('api/week_due_assign/{project_name}/{ticket_number}', array('as' => 'assignWeekDue', 'uses' => 'TicketController@assignWeekDue'));
        Route::post('api/week_completed_assign/{project_name}/{ticket_number}', array('as' => 'assignWeekCompleted', 'uses' => 'TicketController@assignWeekCompleted'));


        // Deleting stuff
        Route::any('api/delete_ticket/{project_name}/{ticket_number}', array('as' => 'deleteTicket', 'uses' => 'TicketController@deleteTicket'));

        //Getting and creating comments
        Route::get('api/get_comments/{project_name}/{ticket_number}', array('as' => 'getComments', 'uses' => 'TicketController@showCommentsHTML'));
        Route::post('api/create_comment/{project_name}/{ticket_number}', array('as' => 'createComment', 'uses' => 'TicketController@createComment'));

        //Logging work
        Route::post('api/add_work_log/{project_name}/{ticket_number}', array('as' => 'addWorkLog', 'uses' => 'WorkLogController@addWorkLog'));
    });
});

