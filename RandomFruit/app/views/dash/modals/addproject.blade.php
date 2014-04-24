<div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add a Project to a Course</h4>
            </div>
			<form class="form" role="form" data-target="addProject" data-modal-id="addProject" method="post"
				id="createProject-form" action="{{URL::route('createProject')}}">
                <div class="modal-body">
                    <div class="form-group" id="project-input">
                        <label for="project-name">Project Name</label>
                        <input type="text" class="form-control" placeholder="Enter project name" id="project-name"
                               name="project_name" required>
                    </div>
                    <div class="form-group" id="project-description">
                        <label for="project-description">Project Description</label>
						<input type="textarea" class="form-control" placeholder="Enter project name" 
						id="project-description" name="project_description" required>
                    </div>
                     <div class="form-group">
                        <label for="course">Course</label>
                        <select id="course" name="course_id" class="form-control">
                            @foreach(Course::all() as $course)
                            <option value="{{$course->id}}">
                            {{"$course->code"}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Add Project" data-toggle="modal">
                </div>
                </div>
            </form>
			<script type="text/javascript">
                $(function(){
                            var $createProject = $('#createProject-form');
                            $createProject.on('submit', function(event){
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
