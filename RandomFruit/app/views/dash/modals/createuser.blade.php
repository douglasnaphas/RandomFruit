<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create a User</h4>
            </div>
			<form class="form" role="form" data-target="createUser" data-modal-id="createUser" method="post"
				action="{{URL::route('createUser')}}" id="createUser-form">
                <div class="modal-body">
                    <div class="form-group" id="user-input">
                        <label for="user-name">Username</label>
                        <input type="text" class="form-control" placeholder="Enter username" id="user-name"
                               name="username" required>
                    </div>
                    <div class="form-group" id="password-input">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Enter password"
                                  name="password" id="password">
                    </div>
                    <div class="form-group" id="email-input">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" placeholder="Enter email"
                                  name="email" id="email">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create User" data-toggle="modal">
                </div>
                </div>
            </form>
			<script type="text/javascript">
                $(function(){
                            var $createUser = $('#createUser-form');
                            $createUser.on('submit', function(event){
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
