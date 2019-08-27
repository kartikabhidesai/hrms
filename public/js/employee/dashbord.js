var Dashboard = function () {

    var handleList = function () {
        $('.slick_demo_3').slick({
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                adaptiveHeight: true
            });
        $('body').on('click', '.shareLocation', function () {
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
                    $('.location').val(output.location);
                    $('.chnagelocation').removeClass('hidden');
                    $('.changeType').val("shareLocation");
                    $('.chnagetask_status').addClass('hidden');
                    $('.emp_updated_file').addClass('hidden');
                    $('.task_id').val(output.id);
                }
            });

        });  
        $('body').on('click', '.setStatus', function () {
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
//                    console.log(output.task_status);exit;
                    
                    $('.task_id').val(output.id);
                    
                    $('.changeType').val("setStatus");
                    $('.chnagelocation').addClass('hidden');
                    $('.emp_updated_file').addClass('hidden');
                    $('.chnagetask_status').removeClass('hidden');
                    var temp_html="";
                     if(output.task_status == 1){
                         temp_html='<select class="form-control m-b c-select task_status " id="task_status" name="task_status" >'+
                                    '<option value="">Select Task Status</option>'+
                                    '<option value="1" selected>In Progress</option>'+
                                    '<option value="2">Pending</option>'+
                                    '<option value="3">Complete</option>'+
                                '</select>';
                    }
                     if(output.task_status == 2){
                         temp_html='<select class="form-control m-b c-select task_status " id="task_status" name="task_status" >'+
                                    '<option value="">Select Task Status</option>'+
                                    '<option value="1">In Progress</option>'+
                                    '<option value="2" selected>Pending</option>'+
                                    '<option value="3">Complete</option>'+
                                '</select>';
                    }
                     if(output.task_status == 3){
                         temp_html='<select class="form-control m-b c-select task_status " id="task_status" name="task_status" >'+
                                    '<option value="">Select Task Status</option>'+
                                    '<option value="1">In Progress</option>'+
                                    '<option value="2">Pending</option>'+
                                    '<option value="3" selected>Complete</option>'+
                                '</select>';
                    }
                    $(".statushtml").html(temp_html);
                }
            });

        });  
        
        $('body').on('click', '.uploadMedia', function () {
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
                    $('.task_id').val(output.id);
                    $('.changeType').val("uploadMedia");
                    $('.emp_updated_file').removeClass('hidden');
                    $('.chnagelocation').addClass('hidden');
                    $('.chnagetask_status').addClass('hidden');
                    if(output.emp_updated_file == null || output.emp_updated_file == '')
                    {
                        $('.fileName').hide();
                        
                    }else{
                        // $('.fileName').attr('href',baseurl +'/uploads/tasks/'+output.emp_updated_file);
                        $('.fileName').show();
                        $('.fileName').attr('href',baseurl+'/uploads/tasks/'+output.emp_updated_file);
                    }
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
                console.log(output);
                $('.task_id').val(output.id);
                $('.complete_progress').val(output.complete_progress);
                $('.task_status').val(output.task_status);
                $('.location').val(output.location);
                if(output.emp_updated_file!=null || output.emp_updated_file != '')
                {
                    $('.fileName').show();
                    $('.fileName').attr('href',baseurl +'/uploads/tasks/'+output.emp_updated_file);
                }else{
                    // $('.fileName').attr('href',baseurl +'/uploads/tasks/'+output.emp_updated_file);
                    $('.fileName').hide();
                }
            }
        });
        
    });
        
        
            var form = $('#updateTaskDash');
            var rules = {
                complete_progress: {required: true,number:true},
                task_status: {required: true},
                location: {required: true},
            };
            handleFormValidate(form, rules, function (form) {
               handleAjaxFormSubmit(form, true);
            });
            
            
       
        
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables_emp_announcement',
            'ajaxURL': baseurl + "employee/employee-dashbord-ajaxAction",
            'ajaxAction': 'getdatatableofempdashbord',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [3],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $('body').on('click', '.announcementDetails', function () {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "employee/employee-dashbord-ajaxAction",
                data: {'action': 'modalDetails', 'data': data},
                success: function (data) {
                    var obj = jQuery.parseJSON(data);
                    console.log(obj);
                    $('.content').text(obj.content);
                    $('.created_at').text(obj.created_at);
                    $('.status').text(obj.status);
                    $('.title').text(obj.title);
                }
            });
        });

    }


    return {
        init: function () {
            handleList();

        }
    }
}();