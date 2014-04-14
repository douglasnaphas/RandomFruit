jQuery(function ($) {
    $('form[data-async]').on('submit', function (event) {
        var $form = $(this);
        var $target = $($form.attr('data-target'));

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),

            success: function (data, status) {
                $('#'+$form.attr('data-modal-id')).modal('hide');
//		alert(
//		$form.attr('data-modal-id'));
//		alert("Ticket created.");
                $target.html(data);
            },

            error: function (request, status, error) {
				alert(request.responseText);
                alert("Please check your submission and try again.");
            }
        });

        event.preventDefault();
    });
});
