<div class="modal fade" id="createTicket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create a Ticket</h4>
            </div>
           <form class="form" role="form" data-async data-target="createTicket" data-modal-id="createTicket" id="ct_form" action="{{URL::action('TicketController@createticketAction')}}" method="post">
		   <div class="modal-body">
			   <script>
				   function projectChange( project_id ){
					   var owner_select = document.getElementById('owner');
					   owner_select.options.length = 0;

					   <?php
					   $available_options = array();
					   foreach(Auth::user()->projects as $project){
					   echo "if (project_id == '$project->id'){\n";

					   foreach($project->users as $user){
					   echo "\towner_select.options[owner_select.options.length] = new Option('$user->username', '$user->id');\n";

					   }
					   echo "}\n";
					   
					   }


					   ?>

				   }

			   </script>
		    <div class="form-group" id="project-input">
			<label for="project-input">Project</label>
			<select id="project" name="project" onchange="projectChange(document.getElementById('project').options[document.getElementById('project').selectedIndex].value)">
				@foreach(Auth::user()->projects as $project)
       					<option value="{{ $project->id }}">{{ $project->name }}</option>
				@endforeach
			</select>
		</div>
		    <div class="form-group" id="owner-input">
			<label for="owner-input">Assignee</label>
			<select id="owner" name="owner">
				<?php $first_project = Auth::user()->projects->first() ?>
				@foreach($first_project->users as $user)
				<option value="{{$user->id}}" data-project="{{$first_project->id}}">{{$user->username}}</option>
				@endforeach
				
			</select>
		    </div>
                    <div class="form-group" id="title-input">
                        <label for="ticket-title">Title</label>
                        <input type="text" class="form-control" placeholder="Subject" id="ticket-title" name="ticket-title" required>
                    </div>
                    <div class="form-group" id="description-input">
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
                    <input type="submit" class="btn btn-primary" value="Create ticket" data-toggle="modal">
                </div>
            </form>
        </div>
    </div>
</div>
