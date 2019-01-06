var Employee = function() {
    var handleList = function() {
     
        $('body').on('click', '.demoDelete', function() {
            // $('#deleteModel').modal('show');
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
                url: baseurl + "admin/demo-ajaxAction",
                data: {'action': 'deleteDemo', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
      
        dateFormate('.date')
        var form = $('#addEmployee');
        var rules = {
            first_name: {required: true},
            emp_pic: {required: true},
            Phone: {required: true,number:true},
            email: {required: true,email:true},
            martial_status: {required: true},
            employee_id: {required: true},
            newpassword: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
         var form = $('#editEmployee');
        var rules = {
            first_name: {required: true},
            emp_pic: {required: true},
            Phone: {required: true,number:true},
            email: {required: true,email:true},
            martial_status: {required: true},
            employee_id: {required: true},
            newpassword: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });

       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
        var arrList = {
            'tableID': '#dataTables-example',
            'ajaxURL': baseurl + "admin/demo-ajaxAction",
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