var Task = function () {
//    checkNonWorkingDate('.nonWorking')
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
        $("body").on('change', '.department', function () {
            var department = $('.department').val();
            $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "company/task-ajaxAction",
            data: {'action': 'getemployee', 'department': department},
                success: function(data) {
                    var output = JSON.parse(data);
                    var temp_html = '';
                    var html ='<select class="form-control employee" id="employee" name="employee"><option selected="selected" value="">Select Employee</option>';
                    for(var i = 0; i < output.length ; i++){
                        temp_html = '<option value="'+output[i].id+'">'+ output[i].name +' '+ output[i].father_name+'</option>';
                        html = html + temp_html;
                    }       
                    $('.employeeHtml').html(html+'</select>');
                }
            });
        });
        var form = $('#addTask');
        var rules = {
            department: {required: true},
            assign_date: {required: true},
            task: {required: true},
            designation: {required: true},
            deadline_date: {required: true},
            priority: {required: true},
            about_task: {required: true},
            location:{required:true},
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
//                console.log(output);
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
    var commentList =  function(){
            var form = $('#addTaskComment');
            var rules = {
                comments: {required: true}
            };
            handleFormValidate(form, rules, function(form) {
                 ajaxcall($(form).attr('action'), $(form).serialize(), function (output) {
                    
                    handleAjaxResponse(output);
                });
            });
    };
    
    var editDetails = function(){
        
        $('body').on('click', '.deleteimage', function() {
            // $('#deleteModel').modal('show');
            var id = $(this).data('id');
            var image = $(this).data('image');
            setTimeout(function() {
                $('.yes-sure-image:visible').attr('data-id', id);
                $('.yes-sure-image:visible').attr('data-image', image);
            }, 500);
        })

        $('body').on('click', '.yes-sure-image', function() {
            var id = $(this).attr('data-id');
            var image = $(this).attr('data-image');
            var data = {image:image,id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/task-ajaxAction",
                data: {'action': 'deleteImage', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        var form = $('#editTask');
        var rules = {
            department: {required: true},
            assign_date: {required: true},
            task: {required: true},
            designation: {required: true},
            deadline_date: {required: true},
            priority: {required: true},
            about_task: {required: true},
            location:{required:true},
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
        comments:function(){
            commentList();
        },
        edit:function(){
            editDetails();
        },
    }
}();