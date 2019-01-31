var Email = function() {
    var handleList = function() {
     
    };
    var addemailTemplate=function(){
        var form = $('#addEmail');
        var rules = {
            template_name: {required: true},
            template_type: {required: true},
            contain: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };
    
    var editemailTemplate=function(){
        var form = $('#editEmail');
        var rules = {
            template_name: {required: true},
            template_type: {required: true},
            contain: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };
    return {
        init: function() {
            handleList();
        },
        add:function(){
            addemailTemplate();
        },
        edit:function(){
            editemailTemplate();
        },
    }
}();