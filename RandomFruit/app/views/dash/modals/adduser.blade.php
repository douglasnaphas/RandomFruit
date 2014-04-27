<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add a User to a Project</h4>
            </div>
			<form class="form" role="form" data-target="addUser" data-modal-id="addUser" method="post"
				id="addUser-form" action="{{URL::route('addUser')}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user">User</label>
                        <select id="user" name="user_id" class="form-control">
                            @foreach(User::all() as $user)
                            <option value="{{$user->id}}">
                            {{"$user->username"}}
                            </option>
                            @endforeach
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="project">Project</label>
                        <select id="project" name="project_id" class="form-control">
                            @foreach(Course::all() as $course)
                            @foreach($course->projects as $project)
                            <option value="{{$project->id}}">
                            {{"$project->name"}}
                            </option>
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Add User" data-toggle="modal">
                </div>
                </div>
            </form>
			<script type="text/javascript">
                $(function(){
                            var $addUser = $('#addUser-form');
                            $addUser.on('submit', function(event){
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
