var Task = function () {
    
    var handleList = function () {
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#empTaskTable',
            'ajaxURL': baseurl + "employee/emp-task-ajaxAction",
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

    $('body').on('click', '.historyDetailsModel', function() {
        var data = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "employee/emp-task-ajaxAction",
            data: {'action': 'getTaskDetails', 'data': data},
            success: function(data) {
                var  output = JSON.parse(data);
                console.log(output);
            }
        });
    });

    return {
        init: function () {
            handleList();
        }
    }
}();