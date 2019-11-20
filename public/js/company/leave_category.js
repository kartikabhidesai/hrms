var LeaveCategory = function () {

    var handleList = function () {

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#LeaveCategoryDatatables',
            'ajaxURL': baseurl + "company/leave-category-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [1],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
        
        $('body').on('click', '.leaveDelete', function () {
            var id = $(this).data('id');
            setTimeout(function () {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function () {
            var id = $(this).attr('data-id');
            
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/leave-category-ajaxAction",
                data: {'action': 'deleteleave', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });

    }

    var addNewLeaveCategory = function () {
        var form = $('#addLeaveCategoryType');
        $("input[name$='applicable_for']").click(function () {

            if ($(this).val() == "Role/Location") {
                $('.role').show();
            } else {
                $('.role').hide();
            }

        });
        var rules = {
            leave_cat_name: {required: true},
            type: {required: true},
            leave_unit: {required: true},
            // description: {required: true},
            applicable_for: {required: true},
            role: {required: true},
            work_location: {required: true},
            gender: {required: true},
            marital_status: {required: true},
            period: {required: true},
            for_employee_type: {required: true},
            leave_count: {required: true},

        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

        getRoleList();
        getWorkLocationList();
        getPeriodList();
    }


    var editLeaveCategory=function(){
        var form = $('#editLeaveCategoryType');
        $("input[name$='applicable_for']").click(function () {
            if ($(this).val() == "Employee") {
                $('.custom_role').addClass('hidden');
            } else {
               $('.custom_role').removeClass('hidden');
            }
        });
        var rules = {
            leave_cat_name: {required: true},
            type: {required: true},
            leave_unit: {required: true},
            applicable_for: {required: true},
            role: {required: true},
            work_location: {required: true},
            gender: {required: true},
            marital_status: {required: true},
            period: {required: true},
            for_employee_type: {required: true},
            leave_count: {required: true},

        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
        
        getRoleList();
        getWorkLocationList();
        getPeriodList();
    };
    $('body').on('click', '.addRoleModel', function () {
        $("#role_name").val('');
    });
    $('body').on('click', '.addRole', function () {       
//        var form = $('#addRole');
//        var rules = {
//            role_name: {required: true}
//        };
        var role_name = $("#role_name").val();
        if (role_name != '') {
            $("#role_name").css("border","1px solid #e5e6e7");
            $(this).attr("disabled","disabled");
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/leave-category-ajaxAction",
                data: {'action': 'addRoleName', 'role_name': role_name},
                success: function (data) {
                     $(this).removeAttr("disabled");
                    var output = JSON.parse(data);
                    handleAjaxResponse(data);
                    $('#addRoleModel').modal('hide');
                    getRoleList();
                }
            });
        } else {
            $("#role_name").css("border","1px solid red");
            $(this).removeAttr("disabled");
        }

    });

    $('body').on('click', '.addWork_locationbtn', function () {
         $("#work_location_name").val('');
    });
    $('body').on('click', '.addperiodModelbtn', function () {
         $("#new_period").val('');
    });
    
    $('body').on('click', '.addWork_location', function () {
        var form = $('#addWork');
        var rules = {
            work_location_name: {required: true}
        };
        var work_name = $("#work_location_name").val();
        if (work_name != '') {
            $("#work_location_name").css("border","1px solid #e5e6e7");
            $(this).attr("disabled","disabled");
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/leave-category-ajaxAction",
                data: {'action': 'addWorkName', 'work_name': work_name},
                success: function (data) {
                     $(this).removeAttr("disabled");
                    var output = JSON.parse(data);
                    handleAjaxResponse(data);
                    $('#addWorkLocationModel').modal('hide');
                    getWorkLocationList();
                }
            });
        } else {
            $("#work_location_name").css("border","1px solid red");
            $(this).removeAttr("disabled");
        }

    });

    $('body').on('click', '.addPeriod', function () {

        var form = $('#addPeriod');
        var rules = {
            period: {required: true}
        };
        var period = $("#new_period").val();
        
        if (period != '') {
            $("#new_period").css("border","1px solid #e5e6e7");
            $(this).attr("disabled","disabled");
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/leave-category-ajaxAction",
                data: {'action': 'addPeriod', 'period': period},
                success: function (data) {
                     $(this).removeAttr("disabled");
                    var output = JSON.parse(data);
                    handleAjaxResponse(data);
                    $('#addperiodModel').modal('hide');
                    getPeriodList();
                }
            });
        } else {
             $("#new_period").css("border","1px solid red");
            $(this).removeAttr("disabled");
        }

    });

    function getRoleList() {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "company/leave-category-ajaxAction",
            data: {'action': 'getRoleCompanyList'},
            success: function (data) {
                var output = JSON.parse(data);
                 $('#role').empty();
                 $('#role').append($("<option></option>").attr("value",'').text('Select Role'));
                 var leaverole = $('#leaverole').val();
                $.each(output, function (key, value) {
                    $('#role')
                            .append($("<option></option>")
                                    .attr("value", value.id)
                                    .text(value.role_name));

                });
                
               
                    $("#role").val(leaverole);
              
                
            }
        });
    }

    function getWorkLocationList() {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "company/leave-category-ajaxAction",
            data: {'action': 'getWorkLocationCompanyList'},
            success: function (data) {
                var output = JSON.parse(data);
                var leavework_location = $('#leavework_location').val();
//                $('#work_location').append($("<option></option>").attr("value",'').text('Select Work Location'));
                $.each(output, function (key, value) {
                    $('#work_location')
                            .append($("<option></option>")
                                    .attr("value", value.id)
                                    .text(value.work_location_name));

                });
                $("#work_location").val(leavework_location);
            }
        });
    }

    function getPeriodList() {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "company/leave-category-ajaxAction",
            data: {'action': 'getPeriodList'},
            success: function (data) {
                var output = JSON.parse(data);
                var leaveperiod = $('#leaveperiod').val();
                 $('#period').empty();
                 $('#period').append($("<option></option>").attr("value",'').text('Select Period'));
                $.each(output, function (key, value) {
                    $('#period')
                            .append($("<option></option>")
                                    .attr("value", value.id)
                                    .text(value.period));

                });
                $("#period").val(leaveperiod);
            }
        });
    }

    function experience_base() {

        $("input[name$='for_employee_type']").click(function () {

            if ($(this).val() == "experience_base") {
                $('.experience_lib').show();
            } else {
                $('.experience_lib').hide();
            }

        });
        
        $('body').on('click','.addnewHTML',function (){
            
               var new_HTML='<div class="col-lg-12 removediv"><div class="col-lg-2"></div>'+
                            '<div class="col-lg-10 " style="padding-bottom: 15px;">'+
                                '<div class="col-lg-3">'+
                                    '<select class="form-control" name="expriances[]" id="period">'+
                                        '<option value="">Select Employee type</option>'+
                                        '<option value="For new joining">For New joining</option>'+
                                    '</select>'+
                                '</div>'+
                                
                                '<div class="col-lg-2">'+
                                    '<input type="text" class="form-control" name="entitlement_name[]" placeholder="Enter Name">'+
                                '</div>'+
                                
                                '<label class="col-lg-1 control-label">Y</label>'+
                                
                                '<div class="col-lg-2">'+
                                    '<input type="number" class="form-control" name="year[]" placeholder="Enter Name">'+
                                '</div>'+
                                
                                '<label class="col-lg-1 control-label">M</label>'+
                                
                                '<div class="col-lg-2">'+
                                    '<input type="number" class="form-control" name="month[]" placeholder="Enter Name">'+
                                '</div>'+
                                
                                '<div class="col-lg-1">'+
                                    '<button type="button" class="red btn-sm btn-primary removebtn"><i class="fa fa-trash"></i></button>'+
                                '</div>'+
                            '</div></div>';
                    
           $('.experience_lib').append(new_HTML);
        });
        
        $('body').on('click','.removebtn',function(){
            $(this).closest('.removediv').remove();
        });
    }
    return {
        init: function () {
            handleList();
            
        },
        add: function () {
            addNewLeaveCategory();
            experience_base();
        },
        edit: function () {
            editLeaveCategory();
            experience_base();
        },
    }
}();