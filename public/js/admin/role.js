var Role = function() {
   
    var handleList=function(){
        
        $('body').on('click', '.roleDelete', function() {
            // $('#deleteModel').modal('show');
            var id = $(this).data('id');
            var user_id = $(this).data('user_id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
                $('.yes-sure:visible').attr('data-user_id', user_id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var user_id = $(this).attr('data-user_id');
            var data = {id: id,user_id:user_id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/role-ajaxAction",
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
            'ajaxURL': baseurl + "admin/role-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [3, 5],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
        
    }


        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};
       
        var arrList = {
            'tableID': '#dataTables-adminrole',
            'ajaxURL': baseurl + "admin/role-ajaxAction",
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
        
        var addRole=function(){
            $(".permissionCheckboxAll").click(function(){
                $('.permissionCheckbox').not(this).prop('checked', this.checked);
            });
            
            var form = $('#addRole');
            var rules = {
                user_name: {required: true},
                email: {required: true,email:true},
                password: {required: true},
                status: {required: true},
                department: {required: true},
                role: {required: true},
            };
            handleFormValidate(form, rules, function(form) {
                handleAjaxFormSubmit(form);
            });
    };
    
    var editRole=function(){
        $(".permissionCheckboxAll").click(function(){
                $('.permissionCheckbox').not(this).prop('checked', this.checked);
            });
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