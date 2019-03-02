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

    $('body').on('click', '.taskDetailsModel', function () {
        var data = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "employee/emp-task-ajaxAction",
            data: {'action': 'getTaskDetails', 'data': data},
            success: function (data) {
                var output = JSON.parse(data);
                $('.task').val(output.task);
                $('.about_task').val(output.about_task);
            }
        });
    });  
    $('body').on('click', '.updateTaskModel', function () {
        var data = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "employee/emp-task-ajaxAction",
            data: {'action': 'getTaskDetails', 'data': data},
            success: function (data) {
                var output = JSON.parse(data);
                $('.complete_progress').val(output.complete_progress);
                $('.task_status').val(output.task_status);
                $('.fileName').attr('href',baseurl +'/uploads/tasks/'+output.emp_updated_file);
            }
        });
    });
    

    var updateTask = function () {
       var form = $('#updateTask');
        var rules = {
            complete_progress: {required: true,number:true},
            task_status: {required: true},
           
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

       
    };
    return {
        init: function () {
            handleList();
            updateTask();
        }
    }
}();