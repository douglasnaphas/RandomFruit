<div class="table-responsive">
                <table class="table table-striped table-hover tablesorter">
                <thead>
                <tr>
                    <th>Project</th>
                    <th>Ticket #</th>
                    <th>Title</th>
                    <th>Creator</th>
                    <th>Owner</th>
                    <th>Planned</th>
                    <th>Actual</th>
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
