var DailyAttendance = function () {
    
    var handleList = function () {

        // checkDateRange('.dateField', '#startDate', '#endDate', 'Start Date Must be Greater From End Date');
        dateFormate('.date')

        var form = $('#manageDailyAttendance');
        var rules = {
            department_id: {required: true},
            date: {required: true},
            
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-daily-attendance',
            'ajaxURL': baseurl + "employee/employee-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [3],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    return {
        init: function () {
            handleList();
        }
    }
}();