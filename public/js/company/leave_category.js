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
    }

    var addNewLeaveCategory = function () {
        var form = $('#addLeaveCategoryType');
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
            leave_count: {required: true}
            
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
        
        getRoleList();
    }

    function getRoleList(){
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
                $.each(output, function(key, value) {   
                    $('#role')
                        .append($("<option></option>")
                                   .attr("value",key.id)
                                   .text(value.role_name)); 
                                   console.log(value);
               });
                
            }
        });
    }

    $('body').on('click', '.addRole', function () {
        var form = $('#addRole');
        var rules = {
            role_name: {required: true}
        };
        var role_name = $("#role_name").val();
        if(role_name!=''){
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/leave-category-ajaxAction",
                data: {'action': 'addRoleName', 'role_name': role_name},
                success: function (data) {
                    var output = JSON.parse(data);
                    handleAjaxResponse(data);
                    $('#addRoleModel').modal('hide');
                    getRoleList();
                }
            });
        }else{

        }

    });

    return {
        init: function () {
            handleList();
        },
        add: function () {
            addNewLeaveCategory();
            
        },
    }
}();