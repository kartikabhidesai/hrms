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
        
         $("body").on("focusout",'.id',function(){
             var valId = $(this).val();
             $('.newpassword').val(valId);
         });
        $("body").on("change",'.selectId',function(){
            var value = $(this).val();
            if(value == 1){
                var html = '<div class="form-group">'+
                                '<label class="col-lg-3 control-label">National ID</label>'+
                                    '<div class="col-sm-9">'+
                                        '<input placeholder="National Id" class="form-control id" required="" name="id" type="text" aria-required="true">'+
                                    '</div>'+
                            '</div>';
            }else{
                if(value == 2){
                 var html = '<div class="form-group">'+
                                '<label class="col-lg-3 control-label">Iqama ID</label>'+
                                    '<div class="col-sm-9">'+
                                        '<input placeholder="Iqama Id" class="form-control id" required="" name="id" type="text" aria-required="true">'+
                                    '</div>'+
                            '</div>';
                }else{
                    var html = "";
                }
            }
            $(".typeDiv").html(html);
        });
        dateFormate('.date')
        var form = $('#addEmployee');
        var rules = {
            name: {required: true},
            first_name: {required: true},
            // emp_pic: {required: true},
            Phone: {required: true,number:true},
            email: {required: true,email:true},
            national_id:{required: true},
            id:{required: true},
            gender: {required: true},
            religion: {required: true},
            martial_status: {required: true},
            department: {required: true},
            employee_id: {required: true},
            newpassword: {required: true},
            join_salary: {required: true},
            status: {required: true},
            iqama_expire_date: {required: true},
            passport_expire_date: {required: true},
            employee_type: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
         var form = $('#editEmployee');
        var rules = {
            name: {required: true},
            first_name: {required: true},
            // emp_pic: {required: true},
            Phone: {required: true,number:true},
            email: {required: true,email:true},
            national_id:{required: true},
            id:{required: true},
            gender: {required: true},
            religion: {required: true},
            martial_status: {required: true},
            department: {required: true},
            employee_id: {required: true},
            newpassword: {required: true},
            join_salary: {required: true},
            status: {required: true},
            iqama_expire_date: {required: true},
            passport_expire_date: {required: true},
            employee_type: {required: true},
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