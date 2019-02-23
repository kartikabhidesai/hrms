var Communication = function () {

    var send_sms = function () {
        $('.chat-user').on("click", function () {
            console.log($(this).attr("data-id"));
        });

        $('.summernote').summernote({
            height: '250px',
            placeholder: 'Enter your message here....'
        });

        var form = $('#new_communication');
        var rules = {
            emp_id: {required: true},
            subject: {required: true},
            message: {required: true}
        };

        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

        /*$('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });*/
    }
    return {
        init: function () {
            send_sms();
        }
    }
}();