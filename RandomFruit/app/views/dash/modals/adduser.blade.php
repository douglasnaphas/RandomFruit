<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add a User to a Project</h4>
            </div>
            <form class="form" role="form" data-async data-target="addUser" data-modal-id="addUser" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user">User</label>
                        <select id="user" name="user" class="form-control">
                            @foreach(User::all() as $user)
                            <option value="{{$user->id}}">
                            {{"$user->username"}}
                            </option>
                            @endforeach
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="project">Project</label>
                        <select id="project" name="project" class="form-control">
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
        </div>
    </div>
</div>
