<div class="table-responsive">
                <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Ticket #</th>
                    <th>Title</th>
                    <th>Creator</th>
                    <th>Owner</th>
                    <th>Description</th>
                    <th>Planned</th>
                    <th>Actual</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
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
                            {{{ substr($ticket->strippedDescription(), 0, 50) . "..." }}}
                        </td>
                        <td>
                            {{{ $ticket->planned_hours }}}
                        </td>
                        <td>
                            {{{ $ticket->actual_hours }}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>