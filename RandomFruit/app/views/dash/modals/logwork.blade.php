<div class="modal fade" id="logWork" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Log Work</h4>
            </div>
            <div class="modal-body">
                <form class="form" role="form" data-target="logWork" data-modal-id="logWork" id="logWork-form"
                    action="{{URL::route('addWorkLog', array("ticket_number" => $ticket->number, "project_name" => $ticket->project->name))}}"
                    method="post">
                    <div class="form-group">
                        <label for="ticketnum">Ticket #</label>
                        <input type="text" id="ticket_number" name="ticket_number" value="{{{$ticket->number}}}" class="form-control" disabled>
                    </div>	

                    <div class="form-group">
                        <label for="hoursworked">Number of Hours Worked</label>
                        <input type="text" id="hours_worked" name="hours_worked" value="1" class="form-control">
                        <script>
$(function () {
        $("input[name='hours_worked']").TouchSpin({
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
                        <label for="week">Week</label>
                        <select id="week" name="week" class="form-control">
                            @foreach($ticket->project->weeks as $week)
                            <option value="{{$week->id}}">
                            {{"$week->number ($week->end_date)"}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save Changes"/>
                    </div>
                </form>
                <script type="text/javascript">
                $(function(){
                            var $logwork = $('#logWork-form');
                            $logwork.on('submit', function(event){
                                var $form = $(this);
                                $.ajax({
                                    type: "POST",
                                    data: $form.serialize(),
                                    type: $form.attr('method'),
                                    url: $form.attr('action'),

                                    success:  function (data, status) {
                                        $('#actual-value').html(data.data.actual_hours);
                                        $('#'+$form.attr('data-modal-id')).modal('hide');
                                    },

                                    error:  function (request, status, error) {
                                        alert(request.responseText);
                                        alert("Please check your submission and try again.");
                                    }

                                });
                                event.preventDefault();
                            });
                });
                </script>
            </div>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-primary" data-toggle="modal" data-target="#logWork">Log Work</button>
</div>
