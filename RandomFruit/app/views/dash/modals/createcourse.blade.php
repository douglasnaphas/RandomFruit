<div class="modal fade" id="createCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create a Course</h4>
            </div>
			<form class="form" role="form" data-target="createCourse" data-modal-id="createCourse" method="post"
				action="{{URL::route('createCourse')}}" id="createCourse-form">
                <div class="modal-body">
                    <div class="form-group" id="code-input">
                        <label for="course-code">Course Code</label>
                        <input type="text" class="form-control" placeholder="Enter course code" id="course-code"
                               name="code" required>
                    </div>
                    <div class="form-group" id="description-input">
                        <label for="course-description">Description</label>
                        <input type="text" class="form-control" placeholder="Enter description"
                                  name="description" id="course-description">
                    </div>
                    <label for="start-date">Start Date</label><br/>

                    <div class="form-group" id="start-date-input">
                        <input class="form-control" type="text" id="start-date" name="start-date">
                    </div>
                    
                    <label for="number-weeks">Number of Weeks</label><br/>

                    <div class="form-group" id="number-weeks-input">
                        <input type="text" id="number-weeks" name="number-weeks" value="1">
                    </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create Course" data-toggle="modal">
                </div>
                  
                </div>
			</form>
			<script type="text/javascript">
                $(function(){
                            $('#start-date').datepicker();

                            $("input[name='number-weeks']").TouchSpin({
                                min: 0,
                                max: 10000,
                                step: 1.0,
                                decimals: 0,
                                boostat: 5,
                                maxboostedstep: 52,
                                postfix: 'weeks'
                            });
                            
                            var $createCourse = $('#createCourse-form');
                            $createCourse.on('submit', function(event){
                                var $form = $(this);
                                $.ajax({
                                    type: "POST",
                                    data: $form.serialize(),
                                    type: $form.attr('method'),
                                    url: $form.attr('action'),

                                    success:  function (data, status) {
                                        $('#actual-value').html(data.data.actual_hours);
                                        $('#'+$form.attr('data-modal-id')).modal('hide');
                                        window.location.reload();
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
