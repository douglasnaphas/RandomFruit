<div class="modal fade" id="logWork" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Log Work</h4>
            </div>
            <div class="modal-body">
                <form class="form">
		    <div class="form-group">
			 <label for="ticketnum">Ticket #</label>
			 <input type="text" id="ticketnum" name="ticketnum" value="{{{$ticket->number}}}" class="form-control" disabled>
		   </div>	
		
                    <div class="form-group">
                        <label for="hoursworked">Number of Hours Worked</label>
                        <input type="text" id="hoursworked" name="hoursworked" value="1" class="form-control">
                        <script>
                            $(function () {
                                $("input[name='hoursworked']").TouchSpin({
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
                    </div>

                    <div class="form-group">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-primary" data-toggle="modal" data-target="#logWork">Log Work</button>
</div>