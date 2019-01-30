var Setting = function() {
    var handleList = function() {
          var form = $('#setting');
        var rules = {
            site_title: {required: true},
            site_tagline: {required: true},
            email: {required: true},
            timezone: {required: true},
            dateformate: {required: true},
            timeformate: {required: true},
            startweek: {required: true},
            language: {required: true},
            site_address: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }
    return {
        init: function() {
            handleList();
        }
    }
}();