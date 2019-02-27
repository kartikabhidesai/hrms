var Task = function () {
    
    var handleList = function () {
        var priority = $("#priority").val();
        var status = $("#status").val();
        var dataArr = {"priority" : priority, "status" : status};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#taskTable',
            'ajaxURL': baseurl + "company/task-ajaxAction",
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
        
        $('body').on('click', '.filler', function () {
            var priority = $('#priority option:selected').val();
            var status = $('#status option:selected').val();
            var querystring = (priority == '' && typeof priority === 'undefined') ? '&priority=' : '&priority=' + priority;
            
            /*Don't remove this code as it's in-progress*/
            // querystring += (status == '' && typeof status === 'undefined') ? '&status=' : '&status=' + status;
            
            location.href = baseurl + 'company/task-list?' + querystring;
        }); 
    }

    var addTask = function(){
        var form = $('#addTask');
        var rules = {
            department: {required: true},
            assign_date: {required: true},
            task: {required: true},
            designation: {required: true},
            deadline_date: {required: true},
            priority: {required: true},
            about_task: {required: true}
        };

        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return {
        init: function () {
            handleList();
        },
        add:function(){
          addTask();  
        },
    }
}();