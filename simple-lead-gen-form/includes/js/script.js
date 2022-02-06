/**
 * Validate the form and send the ajax request over the action 'form_submission'
 */
jQuery(document).ready(function ($) {
    $("form.slgf-form").validate({
        rules: {
            name: "required",
            phone: "required",
            budget: "required",
            message: "required",
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            name: "Please enter your name",
            phone: "Please enter your phone",
            budget: "Please enter your budget",
            message: "Please enter your message",
            email: "Please enter a valid email address"
        },
        submitHandler: function (form) {
            $.ajax({
                url: slgf_object.ajax_url,
                type: "POST",
                data: {
                    action: 'form_submission',
                    formData: $('form.slgf-form').serialize(),
                }, success: function (response) {
                    $(".success_msg").text(response).css("display", "block");
                }, error: function (data) {
                    $(".error_msg").text(data).css("display", "block");
                }
            });
            $('.slgf-form')[0].reset();
        }
    });
});
