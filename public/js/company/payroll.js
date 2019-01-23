var Payroll = function () {
    var handleList = function () {


        var form = $('#addPayroll');
        var rules = {
            salary_grade: {required: true},
            basic_salary: {required: true},
            over_time: {required: true},
            department: {required: true},
            due_date: {required: true},
            housing: {required: true},
            medical: {required: true},
            transportation: {required: true},
            travel: {required: true},

        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });



    }
    return {
        init: function () {
            handleList();
        }
    }
}();