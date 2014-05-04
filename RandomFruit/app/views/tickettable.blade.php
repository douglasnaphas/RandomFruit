<div class="table-responsive">
	<table class="table table-striped table-hover tablesorter ticket-table" id="ticket-table-{{$id}}">
		<thead>
			<tr>
				<th data-ticket-field="project" data-widget-type="selector">Project</th>
				<th data-ticket-field="number" data-widget-type="text">Ticket #</th>
				<th data-ticket-field="title" data-widget-type="text">Title</th>
				<th data-ticket-field="creator" data-widget-type="selector">Creator</th>
				<th data-ticket-field="owner" data-widget-type="selector">Owner</th>
				<th data-ticket-field="planned" data-widget-type="selector">Planned</th>
				<th data-ticket-field="actual" data-widget-type="selector">Actual</th>
				<th data-ticket-field="week_due" data-widget-type="selector">Week Due</th>
				<th data-ticket-field="week_completed" data-widget-type="selector">Week Completed</th>
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
					<a href="{{$ticket->getURL()}}">{{{ $ticket->title }}}</a>
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
