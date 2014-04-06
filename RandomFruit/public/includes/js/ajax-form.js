jQuery(function ($) {
    $('form[data-async]').on('submit', function (event) {
        var $form = $(this);
        var $target = $($form.attr('data-target'));

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),

            success: function (data, status) {
                /* $.('#createTicket').modal('hide'); */
                $target.html(data);
            },

            error: function () {
                alert("Please check your submission and try again.");
            }
        });

        event.preventDefault();
    });
});