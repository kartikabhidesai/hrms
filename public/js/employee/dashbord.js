var Dashboard = function () {

    var handleList = function () {
        $('.slick_demo_3').slick({
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                adaptiveHeight: true
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
//               alert("HELLO");
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