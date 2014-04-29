<div class="modal fade" id="editSettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Edit Settings</h4>
			</div>
			<form class="form" role="form" id="editSettings-form" data-modal-id="editSettings" id="ct_form" action="{{URL::route('changePassword')}}" method="post">
				<div class="modal-body">
					<div class="form-group" id="old-password">
						<label for="old-password">Enter Old Password</label>
						<input type="password" class="form-control" name="old-password">
					</div>
				</div>
				<div class="modal-body">
					<div class="form-group" id="new-password">
						<label for="new-password">Enter New Password</label>
						<input type="password" class="form-control" name="new-password">
					</div>
				</div>
				<div class="modal-body">
					<div class="form-group" id="new-password-copy">
						<label for="new-password-copy">Re-Enter New Password</label>
						<input type="password" class="form-control" name="new-password-copy">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Create ticket" data-toggle="modal">
				</div>
			</form>
<script type="text/javascript">
$(function(){
		var $editSettings = $('#editSettings-form');
	$editSettings.on('submit', function(event){
		var $form = $(this);
		$.ajax({
			type: "POST",
				data: $form.serialize(),
									type: $form.attr('method'),
									url: $form.attr('action'),

									success:  function (data, status) {
										if(data.status == "success")
											$('#'+$form.attr('data-modal-id')).modal('hide');
										else if(data.status == "fail"){
											for (var property in data.messages){
												alert(data.messages[property]);
											}
										}
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
