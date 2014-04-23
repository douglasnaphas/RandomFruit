<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create a User</h4>
            </div>
            <form class="form" role="form" data-async data-target="createUser" data-modal-id="createUser" method="post">
                <div class="modal-body">
                    <div class="form-group" id="user-input">
                        <label for="user-name">Username</label>
                        <input type="text" class="form-control" placeholder="Enter username" id="user-name"
                               name="user-name" required>
                    </div>
                    <div class="form-group" id="password-input">
                        <label for="password-val">Password</label>
                        <input type="text" class="form-control" placeholder="Enter password"
                                  name="password-val" id="password-val">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create User" data-toggle="modal">
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
