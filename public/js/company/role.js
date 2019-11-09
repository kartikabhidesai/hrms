var Role = function() {
   
    var handleList=function(){

        $('body').on('click', '.roleDelete', function() {
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
                url: baseurl + "company/company-role-ajaxAction",
                data: {'action': 'deleteRole', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};
         var arrList = {
            'tableID': '#dataTables-company',
            'ajaxURL': baseurl + "company/company-role-ajaxAction",
            'ajaxAction': 'getAdminRoleData',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [],
            'noSortingApply': [4],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

    }

    var addRole=function(){
        $("body").on('change','.employeeType',function(){
            var val=$(".employeeType:checked").val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/company-role-ajaxAction",
                data: {'action': 'employeeType', 'val': val},
                success: function(data) {
                    $('.append').html(data);
                    
                    var form = $('#addRole');
                    var rules = {
                        employeeType: {required: true},
                        employeeId: {required: true},
                    };
                    handleFormValidate(form, rules, function(form) {
                        handleAjaxFormSubmit(form);
                    });


                    var form = $('#addNewEmployeeRole');
                    var rules = {
                        employeeType: {required: true},
                        name: {required: true},
                        first_name: {required: true},
                        phone: {required: true,digits: true},
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
                        handleAjaxFormSubmit(form);
                    });
                }
            });
            
        });
        
        var form = $('#addRole');
        var rules = {
            employeeType: {required: true},
            employeeId: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
        
        
        var form = $('#addNewEmployeeRole');
        var rules = {
            employeeType: {required: true},
            name: {required: true},
            first_name: {required: true},
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
            handleAjaxFormSubmit(form);
        });
    };
    
    var editRole=function(){
        var form = $('#editRole');
        var rules = {
            user_name: {required: true},
            email: {required: true,email:true},
            status: {required: true},
            department: {required: true},
            role: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };
    
    return {
        init: function() {
            handleList();
        },
        add:function(){
            addRole();
        },
        edit:function(){
            editRole();
        },
    }
}();