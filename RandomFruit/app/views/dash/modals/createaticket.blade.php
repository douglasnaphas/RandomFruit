<div class="modal fade" id="createTicket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create a Ticket</h4>
            </div>
            <form class="form" role="form" data-async data-target="createTicket" data-modal-id="createTicket"
                  id="ct_form" action="{{URL::action('TicketController@createticketAction')}}" method="post">
                <div class="modal-body">
                    <script>
                        function projectChange(project_id) {
                            var owner_select = document.getElementById('owner');
                            owner_select.options.length = 0;
                            var week_select = document.getElementById('week_due');
                            week_select.options.length = 0;

                            <?php
                            $available_options = array();
                            foreach(Auth::user()->projects as $project){
                            echo "if (project_id == '$project->id'){\n";

                            foreach($project->users as $user){
			    echo "\towner_select.options[owner_select.options.length] = new Option('$user->username', '$user->id');\n";
			    }
			    foreach($project->weeks as $week){
			    echo "\tweek_select.options[week_select.options.length] = new Option('$week->number ($week->end_date)', '$week->id');\n";

                            }
                            echo "}\n";

                            }


                            ?>

                        }

                    </script>
                    <div class="form-group" id="project-input">
                        <label for="project-input">Project</label>
                        <select id="project" name="project" class="form-control"
                                onchange="projectChange(document.getElementById('project').options[document.getElementById('project').selectedIndex].value)">
                            @foreach(Auth::user()->projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="owner-input">
                        <label for="owner-input">Assignee</label>
                        <select id="owner" name="owner" class="form-control">
                            <?php $first_project = Auth::user()->projects->first() ?>
                            @foreach($first_project->users as $user)
                            <option value="{{$user->id}}" data-project="{{$first_project->id}}">{{$user->username}}
                            </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group" id="week_due-input">
                        <label for="week_due-input">Week</label>
                        <select id="week_due" name="week_due" class="form-control">
                            <?php $first_project = Auth::user()->projects->first() ?>
                            @foreach($first_project->weeks as $week)
                            <option value="{{$week->id}}" data-project="{{$first_project->id}}">{{"$week->number
                                ($week->end_date)"}}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group" id="title-input">
                        <label for="ticket-title">Title</label>
                        <input type="text" class="form-control" placeholder="Subject" id="ticket-title"
                               name="ticket-title" required>
                    </div>
                    <div class="form-group" id="description-input">
                        <label for="ticket-description">Description</label>
                        <textarea class="form-control" rows="6" placeholder="Enter description"
                                  name="ticket-description" id="ticket-description"></textarea>
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
                    <br/>
                    <label for="planned-hours">Planned Value (hours)</label><br/>

                    <div class="form-group" id="planned-hours-input">
                        <input type="text" id="planned-hours" name="planned-hours" value="1">
                    </div>
                    <label for="due-date">Due date</label><br/>

                    <div class="form-group" id="due-date-input">
                        <input class="form-control" type="text" id="due-date" name="due-date">
                    </div>
                    <script>
                        $(function () {
                            $('#due-date').datepicker();

                            $("input[name='planned-hours']").TouchSpin({
                                min: 0,
                                max: 10000,
                                step: 0.1,
                                decimals: 1,
                                boostat: 5,
                                maxboostedstep: 10,
                                postfix: 'hours'
                            });
                        });

                    </script>

                    <!-- TODO: add this to ticket model -->
                    <label for="ticket-priority">Priority</label><br/>

                    <div class="btn-group" data-toggle="buttons">
                        <label class="active btn btn-primary">
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
                    <input type="submit" class="btn btn-primary" value="Create Ticket" data-toggle="modal">
                </div>
            </form>
        </div>
    </div>
</div>
