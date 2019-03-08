var SysSetting = function () {
   
    var addSetting = function(){
        var form = $('#systemsetting');
        var rules = {
            system_name: {required: true},
            system_title: {required: true},
            address: {required: true},
            phone_number: {required: true},
            email: {required: true},
            language: {required: true},
            // file: {required: true},
        };

        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return {
        init: function () {
            addSetting();
        },
    }
}();