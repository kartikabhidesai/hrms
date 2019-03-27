var LeaveCategory = function () {

    var handleList = function () {

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#LeaveCategoryDatatables',
            'ajaxURL': baseurl + "company/leave-category-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [1],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }

    var addNewLeaveCategory = function () {
        var form = $('#addLeaveCategoryType');
        var rules = {
            leave_cat_name: {required: true},
            type: {required: true},
            leave_unit: {required: true},
            description: {required: true},
            applicable_for: {required: true},
            role: {required: true},
            work_location: {required: true},
            gender: {required: true},
            marital_status: {required: true},
            period: {required: true},
            for_employee_type: {required: true},
            leave_count: {required: true}
            
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }

    return {
        init: function () {
            handleList();
        },
        add: function () {
            addNewLeaveCategory();
        },
    }
}();