var LeaveCategory = function () {

    var handleList = function () {

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#AwardDatatables',
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

    return {
        init: function () {
            handleList();
        },
    }
}();