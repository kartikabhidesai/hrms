var Updateprofile = function () {

    var handleEditUser = function () {
        var form = $('#updateProfile');
        var rules = {
            first_name: {required: true},
            /*newpassword: {required: false},
            cpassword: {required: false,equalTo: "#newpassword"}*/
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form,true);
        });
    };

    var handleChangePassword = function () {
        var form = $('#changePassword');
        var rules = {
            new_password: {required: true},
            confirm_new_password: {required: true,equalTo: ".new_password"}
        };

        $("#changePassword").validate({
            ignore: [],
            rules: {
                new_password: {
                    required: true,
                },
                confirm_new_password: {
                    required: true,
                    equalTo: ".new_password"
                },
            },
            messages: {
                new_password: {
                    required: "Please enter password",
                },
                confirm_new_password: {
                    required: "Confirm password must be same as new password",
                }
            }
        });
        
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form,true);
        });
    };

    return{
        edit_init: function () {
            handleEditUser();
        },
        change_password_init: function () {
            handleChangePassword();
        }
    };
}();