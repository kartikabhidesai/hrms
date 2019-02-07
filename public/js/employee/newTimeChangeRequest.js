var Timechange = function () {
    
    var addTime = function () {
        var form = $('#newTimeChangeRequest');
        var rules = {
            name:{required: true},
            department: {required: true},
            date_of_submit: {required: true},
            from_date: {required: true},
            to_date:{required: true},
            typeRequest: {required: true},
            total_hrs:{required: true},
            reuest_note:{required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    return {
        init: function () {
            addTime();
        }
    }
}();