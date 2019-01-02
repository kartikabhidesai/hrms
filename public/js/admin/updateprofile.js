var Updateprofile = function () {

    var handleEditUser = function () {
        var form = $('#updateProfile');
        var rules = {
            first_name: {required: true},
            newpassword: {required: false},
            cpassword: {required: false,equalTo: "#newpassword"}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form,true);
        });
    };

    return{
        edit_init: function () {
            handleEditUser();
        }
    };
}();