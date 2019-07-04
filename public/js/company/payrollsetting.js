var Payrollsetting = function () {

    var paysettingList = function () {
       var form = $('#addGrade');
        var rules = {
            grade: {required: true},
            basic_salary: {required: true},
            payment_date: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    return {
        init: function () {
            paysettingList();
        }
    }

}();