var Notification = function () {
    
    var handleList = function () {
        var form = $('#taxId');
        var rules = {
          // emp_id: {required: true},
          amount: {required: true,number:true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
    }
    return {
        init: function () {
            handleList();
        }
    }
}();