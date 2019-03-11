var SysSetting = function () {
   
    var addSetting = function(){
        var form = $('#systemSettingForm');
        var rules = {
            system_name: {required: true},
            system_title: {required: true},
            address: {required: true},
            phone_numbers: {address: true},
            email: {required: true,email:true},
            language: {required: true},
            phone: {required: true,number:true}
            // image: {required: true},
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