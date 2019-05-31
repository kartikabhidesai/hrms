var Communication = function () {

    var send_sms = function () {
        $('.chat-user').on("click", function () {
            console.log($(this).attr("data-id"));
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

    var compose_mail_func = function(){
        $('.summernote').summernote({
            height: '250px',
            placeholder: 'Enter your message here....'
        });

        $('.chat-user').on("click", function () {
            console.log($(this).attr("data-id"));
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

        $('#mail_to').change(function(){
            if($(this).val() == 'employee'){
                $('#emp_div').show();
                $('#emp_id').attr('required','required');
            }else{
                $('#emp_div').hide();
                $('#emp_id').removeAttr('required');
            }
        });
    }

    return {
        init: function () {
            send_sms();
        },
        compose_mail:function(){
            compose_mail_func();
        }
    }
}();