<div class="table-responsive">
	<table class="table table-striped table-hover tablesorter" id="ticket-table-{{$id}}">
		<thead>
			<tr>
				<th data-ticket-field="project">Project</th>
				<th data-ticket-field="number">Ticket #</th>
				<th data-ticket-field="title">Title</th>
				<th data-ticket-field="creator">Creator</th>
				<th data-ticket-field="owner">Owner</th>
				<th data-ticket-field="planned">Planned</th>
				<th data-ticket-field="actual">Actual</th>
				<th data-ticket-field="week_due">Week Due</th>
				<th data-ticket-field="week_completed">Week Completed</th>
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
