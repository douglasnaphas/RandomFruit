<div class="modal fade" id="createComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create a Comment</h4>
            </div>
            <form class="form" role="form" data-async data-target="comments" data-modal-id="createTicket"
				id="ct_form" action="{{URL::action('TicketController@createComment', array("project_name" => $project->name, "ticket_number" => $ticket->number)}}" method="post">
                <div class="modal-body">
                    <div class="form-group" id="content-input">
                        <label for="content">Description</label>
                        <textarea class="form-control" rows="6" placeholder="Enter comment"
                                  id="content" name="content"></textarea>
                    </div>

                    <!-- TODO: add type to ticket model and TicketController

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
                    <br/>
                    -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create comment" data-toggle="modal">
                </div>
            </form>
        </div>
    </div>
</div>
