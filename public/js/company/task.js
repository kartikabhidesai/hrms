var Task = function () {
    
    // $("#to_date").on("change",function(){
    //    
    // });
    // $("#to_date").on("change", function(e) {
    //     var  date = $(this).val();
    //     var  currentDate = true;
    //         if(date !='' && currentDate == true){
    //             console.log("onchange contents: " + date);    
    //             var  currentDate = false;
    //             $.ajax({
    //             type: "POST",
    //             headers: {
    //                 'X-CSRF-TOKEN': $('input[name="_token"]').val(),
    //             },
    //             url: baseurl + "company/task-ajaxAction",
    //             data: {'action': 'checkDate', 'date': date},
    //             success: function(data) {
    //                 var  output = JSON.parse(data);
    //                 console.log(output);
    //             }
    //         });
    //     }
    // });


    checkNonWorkingDate('.nonWorking')
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
            querystring += (status == '' && typeof status === 'undefined') ? '&status=' : '&status=' + status;
            
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

    $("body").on('click', '.taskDetails', function () {
        var data = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "company/task-ajaxAction",
            data: {'action': 'taskDetails', 'data': data},
            success: function(data) {
                var  output = JSON.parse(data);
                console.log(output);
                if(output.task === null) {
                    $('.taskName').hide();
                } else {
                    $('.taskName').show();
                    $('.taskName').html(output.task);
                }
                if(output.employee_id === null) {
                    $('.assignedTo').hide();
                } else {
                    $('.assignedTo').html(output.emp_name);
                }
                if(output.priority === null) {
                    $('.priority').hide();
                } else {
                    $('.priority').html(output.priority);
                }
                if(output.about_task === null) {
                    $('.info').hide();
                } else {
                    $('.info').html(output.about_task);
                }
                if(output.complete_progress === null) {
                    $('.progress').hide();
                } else {
                    $('.progress').html(output.complete_progress + ' %');
                }
                if(output.task_status === null) {
                    $('.statusDiv').hide();
                } else {
                    if(output.task_status == 0) {
                        $('.status').html('In-progress');
                    } if(output.task_status == 1) {
                        $('.status').html('Pending');
                    } if(output.task_status == 2) {
                        $('.status').html('Complete');
                    }
                }
            }
        });
    });

    return {
        init: function () {
            handleList();
        },
        add:function(){
          addTask();  
        },
    }
}();