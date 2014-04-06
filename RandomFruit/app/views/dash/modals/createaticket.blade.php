<div class="modal fade" id="createTicket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create a Ticket</h4>
            </div>
           <form class="form" role="form" data-async data-target="createTicket" id="ct_form" action="{{URL::action('TicketController@createticketAction')}}" method="post">
                <div class="modal-body">
		    <div class="form-group">
			    <label for="ticket-project-id">Project</label>
			    <ul class="dropdown-menu"></ul>
		    </div>
                    <div class="form-group">
                        <label for="ticket-subject">Subject</label>
                        <input type="text" class="form-control" placeholder="Subject" id="ticket-subject" name="ticket-subject" required>
                    </div>
                    <div class="form-group" id="creator-input">
                        <label for="ticket-creator">Creator</label>
                        <input type="text" class="form-control" placeholder="[Current User's Username]"
                               id="ticket-creator">
                    </div>
                    <div class="form-group  " id="description-input">
                        <label for="ticket-description">Description</label>
                        <textarea class="form-control" rows="6" placeholder="Enter description" name="ticket-description" id="ticket-description"></textarea>
                    </div>
                    <label for="ticket-type">Type</label><br/>

                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="ticket-type" id="task">Task
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="ticket-type" id="documentation">Documentation
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="ticket-type" id="planning">Planning
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="ticket-type" id="defect">Defect
                        </label>
                    </div>
                    <br/><br/>
                    <label for="ticket-priority">Priority</label><br/>

                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="ticket-priority" id="blocker">Blocker
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="ticket-priority" id="critical">Critical
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="ticket-priority" id="major">Major
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="ticket-priority" id="minor">Minor
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="ticket-priority" id="trivial">Trivial
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create ticket">
                </div>
            </form>
	   <script>
		// Attach a submit handler to the form
		$( "#ct_form" ).submit(function( event ) {

		// Stop form from submitting normally
		event.preventDefault();

		// Get some values from elements on the page:
		var $form = $( this ),
		title = $form.find( "input[name='ticket-title']" ).val(),
		creator = $form.find( "input[name='ticket-creator']" ).val(),		
		description = $form.find( "input[name='ticket-description']" ).val(),
		type = $form.find( "input[name='ticket-type']" ).val(),
		priority = $form.find( "input[name='ticket-priority']" ).val(),
		
		url = $form.attr( "action" );
		
		// Send the data using post
		var posting = $.post( url, { ticket-title: title, ticket-creator: creator, ticket-description: description, ticket-type: type, ticket-priority: priority } );
		
		// Put the results in a div
		posting.done(function( data ) {
			var content = $( data ).find( "#content" );
			$( "#result" ).empty().append( content );
		});
		});
	   </script>
        </div>
    </div>
</div>
