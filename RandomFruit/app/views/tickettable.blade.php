<?php
$omit = isset($omit) ? $omit : array();
?>
<div class="table-responsive">
	<table class="table table-striped table-hover tablesorter ticket-table" id="ticket-table-{{$id}}">
		<thead>
			<tr>
                <th data-ticket-field="project" data-widget-type="{{in_array('project', $omit) ? "omit" : "selector"}}">Project</th>
                <th data-ticket-field="number" data-widget-type="{{in_array('number', $omit) ? "omit" : "text"}}">Ticket #</th>
				<th data-ticket-field="title" data-widget-type="{{in_array('title', $omit) ? "omit" : "text"}}">Title</th>
				<th data-ticket-field="creator" data-widget-type="{{in_array('creator', $omit) ? "omit" : "selector"}}">Creator</th>
				<th data-ticket-field="owner" data-widget-type="{{in_array('owner', $omit)? "omit" : "selector"}}">Owner</th>
				<th data-ticket-field="planned" data-widget-type="{{in_array('planned', $omit) ? "omit" : "selector"}}">Planned</th>
				<th data-ticket-field="actual" data-widget-type="{{in_array('actual', $omit) ? "omit" : "selector"}}">Actual</th>
				<th data-ticket-field="week_due" data-widget-type="{{in_array('week_due', $omit) ? "omit" : "selector"}}">Week Due</th>
				<th data-ticket-field="week_completed" data-widget-type="{{in_array('week_completed', $omit) ? "omit" : "selector"}}">Week Completed</th>
                <th data-ticket-field="" data-widget-type="visibility"><span class="glyphicon glyphicon-filter"></span></td>
			</tr>
		</thead>
		<tbody>
			@foreach($tickets as $ticket)
			<tr>
				<td>
					{{{ $ticket->project->name }}}
				</td>
				<td>
					{{{ $ticket->number }}}
				</td>
				<td>
                    <a href="{{$ticket->getURL()}}" title="{{$ticket->title}}">{{{ strlen($ticket->title) > 75 ? substr($ticket->title, 0, 72) . "..." : $ticket->title }}}</a>
				</td>
				<td>
					{{{ $ticket->creator->username }}}
				</td>    
				<td>
					{{{ $ticket->owner->username }}}
				</td>
				<td>
					{{{ $ticket->planned_hours }}}
				</td>
				<td>
					{{{ $ticket->computeActualHours() }}}

				</td>
				<td>
					{{{ $ticket->due ? $ticket->due->number : "N/A"}}}

				</td>
				<td>
					{{{ $ticket->completed ? $ticket->completed->number : "N/A" }}}

				</td>
				<td>
					<div class="icon-ticket glyphicon glyphicon-remove rf-deletebutton"
						data-delete-url="{{$ticket->deleteUrl()}}"
						data-delete-confirmation="Ticket {{$ticket->number}} will be deleted">
					</div>
				</td>

			</tr>
			@endforeach
		</tbody>
	</table>   
</div>
