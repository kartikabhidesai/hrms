var Employee = function() {
    var handleList = function() {
     
        $('body').on('click', '.empDelete', function() {
            var id = $(this).data('id');
            
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/employee-ajaxAction",
                data: {'action': 'deleteEmp', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
      
        dateFormate('.date')
        var form = $('#addEmployee');
        var rules = {
            name: {required: true},
            first_name: {required: true},
            // emp_pic: {required: true},
            Phone: {required: true,number:true},
            email: {required: true,email:true},
            gender: {required: true},
            religion: {required: true},
            martial_status: {required: true},
            department: {required: true},
            employee_id: {required: true},
            newpassword: {required: true},
            join_salary: {required: true},
            status: {required: true},
            employee_type: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
         var form = $('#editEmployee');
        var rules = {
            first_name: {required: true},
            Phone: {required: true,number:true},
            email: {required: true,email:true},
            martial_status: {required: true},
            employee_id: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });

       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
        var arrList = {
            'tableID': '#employeeDatatables',
            'ajaxURL': baseurl + "company/employee-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [3,5],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    return {
        init: function() {
            handleList();
        }
    }
}();