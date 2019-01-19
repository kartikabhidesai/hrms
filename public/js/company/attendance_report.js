var AttendanceReport = function () {
    
    var handleList = function () {

        var form = $('#showReport');
        var rules = {
          department_id: {required: true},
          year: {required: true},
          month: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
        
        /*$('body').on('click','.getAttdanceReport',function(){
            // alert('Button Clicked!');
        });*/
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-attendance-report',
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