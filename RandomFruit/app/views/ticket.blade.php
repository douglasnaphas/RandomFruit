@extends('dashlayout')
{{-- app/views/ticket.blade.php shows the attributes of a ticket for a given project --}}

@section('title')
Ticket #{{{ $ticket->number }}}
@stop

@section('css')
@parent
{{HTML::style('includes/css/vtickets.css')}}
@stop

@section('page_header')
<div>
    <div class="header-container title-hover">
        #{{{ $ticket->number }}} - <span class="edit-title">{{{ $ticket->title }}}</span>
    </div>
    <div class="glyphicon-container" style="font-size: 16px;">
        <span class="icon-title glyphicon-none"></span>
    </div>
</div>
@stop

@section('content')
<h3>Details</h3>
<table class="table-nonfluid">
	<tr>
		<td><strong>Creator:</strong></td>
		<td class="data-cell">{{{ $ticket->creator->username }}}</td>
		<td><span class="glyphicon-none"></span></td>
		<td><strong>Planned Hours:</strong></td>
		<td class="data-cell edit-planned">{{{ $ticket->planned_hours }}}</td>
		<td><span class="icon-planned glyphicon-none"></span></td>
	</tr>
	<tr>
		<td><strong>Owner:</strong></td>
		<td class="data-cell edit-owner">{{{ $ticket->owner->username }}}</td>
		<td><span class="icon-owner glyphicon-none"></span></td>
		<td><strong>Actual Hours:</strong></td>
		<td class="data-cell " id="actual-value">{{{ $ticket->computeActualHours() }}}</td>
	</tr>
	<tr>
		<td><strong>Week due:</strong></td>
		<td class="data-cell edit-week-due">{{ $ticket->due ? $ticket->due->number : "Unset "}} ({{ $ticket->due  ? $ticket->due->end_date : "Click to assign"}})</td>
		<td><span class="icon-week-due glyphicon-none"></span></td>
		<td><strong>Week completed:</strong></td>
		<td class="data-cell edit-week-completed">{{ $ticket->completed ? $ticket->completed->number : "Not Completed"}} ({{ $ticket->completed  ? $ticket->completed->end_date : "Click to mark as done"}})</td>
		<td><span class="icon-week-completed glyphicon-none"></span></td>
	</tr>


</table>

<!-- Include logwork modal -->
@include('dash/modals/logwork')

<div>
	<div class="header-container">
		<h3>Description</h3>
	</div>
	<div class="glyphicon-container">
		<span class="icon-description glyphicon-none"></span>
	</div>
</div> <br class="clearBoth">
<div class="panel panel-default">
    <div class="edit-description panel-body">{{ $ticket->parsedDescription() }}</div>
</div>

<div>
	<div class="header-container">
		<h3>Comments</h3>
	</div>
</div> <br class="clearBoth">
<div id="comments">
    Loading comments...
</div>

<script>
	$.get( {{'"' . URL::route('getComments', array("project_name" => $project->name, "ticket_number" => $ticket->number)) . '"'}}, function( data ) {
		$( "#comments" ).html( data );
	});
	function text_handle(element, value, settings){
		if(value.status == 'success'){
			$(element).html(value.data[settings.name]);
			}else if (value.status == 'fail'){
			alert(value.messages[settings.name][0]);
			$(element).html(value.data[settings.name]);
		}
	}

	var edit_url = {{'"' . URL::to("api/edit_ticket/$project->name/$ticket->number") . '"'}};
	var assign_owner_url = {{'"' . URL::route("ownerAssign", array("project_name" => $project->name, "ticket_number" => $ticket->number)) . '"'}};
	var assign_week_due = {{'"' . URL::route("assignWeekDue", array("project_name" => $project->name, "ticket_number" => $ticket->number)) . '"'}};
	var assign_week_completed = {{'"' . URL::route("assignWeekCompleted", array("project_name" => $project->name, "ticket_number" => $ticket->number)) . '"'}};
    $('.edit-title').editable(edit_url, {
        width: '100%',
        name: 'title',
        callback: function(value, settings){
            text_handle(this, value, settings);
        },
        submit: "OK",
        loadurl: {{ '"' . URL::route("getTitle", array( "project_name" => $project->name, "ticket_number" => $ticket->number)) . '"'}},
    indicator: 'Saving...'
    });
	$('.edit-owner').editable(assign_owner_url, {
		type: 'select',
		loadurl: '{{URL::action("TicketController@getOwnerSelectedInList", array('project_name' => $project->name, "ticket_number" => $ticket->number))}}',
		width: '100%',
		height: '25px',
		name: 'owner_id',
		submit: 'OK',
		indicator: 'Saving...',
		callback: function(value, settings){
			text_handle(this, value, settings);
		}
	});
	$('.edit-week-due').editable(assign_week_due, {
		type: 'select',
		loadurl: '{{URL::route("weekDueList", array('project_name' => $project->name, "ticket_number" => $ticket->number))}}',
		width: '100%',
		height: '25px',
		name: 'week_due',
		submit: 'OK',
		indicator: 'Saving...',
		callback: function(value, settings){
			text_handle(this, value, settings);
		}
	});
	$('.edit-week-completed').editable(assign_week_completed, {
		type: 'select',
		loadurl: '{{URL::route("weekCompletedList", array('project_name' => $project->name, "ticket_number" => $ticket->number))}}',
		width: '100%',
		height: '25px',
		name: 'week_completed',
		submit: 'OK',
		indicator: 'Saving...',
		callback: function(value, settings){
			text_handle(this, value, settings);
		},
	});
	$('.edit-planned').editable(edit_url, {
		width: '100%',
		height: '25px',
		name: 'planned_hours',
		callback: function(value, settings){
			text_handle(this, value, settings);
		},

		indicator: 'Saving...'
	});
	$('.edit-description').editable(edit_url, {
		type: 'textarea',
		rows: 8,
		width: '30%',
		name: 'description',
		callback: function(value, settings){
			text_handle(this, value, settings);
		},
		submit: "OK",
		loadurl: {{ '"' . URL::route("getDescription", array( "project_name" => $project->name, "ticket_number" => $ticket->number)) . '"'}},
		indicator: 'Saving...'
	});

    $('.title-hover').mouseover(function () {
        $('.icon-title').removeClass('glyphicon-none');
        $('.icon-title').addClass('glyphicon glyphicon-pencil');
    });
    $('.title-hover').mouseout(function () {
        $('.icon-title').removeClass('glyphicon glyphicon-pencil');
        $('.icon-title').addClass('glyphicon-none');
    });
    $('.edit-owner').mouseover(function () {
		$('.icon-owner').removeClass('glyphicon-none');
		$('.icon-owner').addClass('glyphicon glyphicon-pencil');
	});
	$('.edit-owner').mouseout(function () {
		$('.icon-owner').removeClass('glyphicon glyphicon-pencil');
		$('.icon-owner').addClass('glyphicon-none');
	});
	$('.edit-planned').mouseover(function () {
		$('.icon-planned').removeClass('glyphicon-none');
		$('.icon-planned').addClass('glyphicon glyphicon-pencil');
	});
	$('.edit-planned').mouseout(function () {
		$('.icon-planned').removeClass('glyphicon glyphicon-pencil');
		$('.icon-planned').addClass('glyphicon-none');
	});
	$('.edit-actual').mouseover(function () {
		$('.icon-actual').removeClass('glyphicon-none');
		$('.icon-actual').addClass('glyphicon glyphicon-pencil');
	});
	$('.edit-actual').mouseout(function () {
		$('.icon-actual').removeClass('glyphicon glyphicon-pencil');
		$('.icon-actual').addClass('glyphicon-none');
	});
	$('.edit-description').mouseover(function () {
		$('.icon-description').removeClass('glyphicon-none');
		$('.icon-description').addClass('glyphicon glyphicon-pencil');
	});
	$('.edit-description').mouseout(function () {
		$('.icon-description').removeClass('glyphicon glyphicon-pencil');
		$('.icon-description').addClass('glyphicon-none');
	});
    $('.edit-week-due').mouseover(function () {
        $('.icon-week-due').removeClass('glyphicon-none');
        $('.icon-week-due').addClass('glyphicon glyphicon-pencil');
    });
    $('.edit-week-due').mouseout(function () {
        $('.icon-week-due').removeClass('glyphicon glyphicon-pencil');
        $('.icon-week-due').addClass('glyphicon-none');
    });
    $('.edit-week-completed').mouseover(function () {
        $('.icon-week-completed').removeClass('glyphicon-none');
        $('.icon-week-completed').addClass('glyphicon glyphicon-pencil');
    });
    $('.edit-week-completed').mouseout(function () {
        $('.icon-week-completed').removeClass('glyphicon glyphicon-pencil');
        $('.icon-week-completed').addClass('glyphicon-none');
    });
</script>
@include('dash/modals/createcomment')


@stop
