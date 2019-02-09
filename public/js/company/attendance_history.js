var AttendanceHistory = function() {
    var handleList = function() {
       
       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
            var arrList = {
            'tableID': '#attendanceHistoryList',
            'ajaxURL': baseurl + "company/attendance-history-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [0],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    };

    return {
        init: function() {
            handleList();
        }
    }

}();