var Department = function() {
    var handleList = function() {
       
       $('body').on('click', '.deleteDepartment', function() {
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
                url: baseurl + "company/department-ajaxAction",
                data: {'action': 'deleteDepartment', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });

       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
            var arrList = {
            'tableID': '#DepartmentDatatables',
            'ajaxURL': baseurl + "company/department-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [],
            'noSortingApply': [3],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    };
    
    var addlist = function() {
        
        var form = $('#department-add');
        var rules = {
            department_name: {required: true},
            designation: {required: true},
//            manager_name: {required: true},
//            comanager_name: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
        $('body').on('click','.add_designation',function(){
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/department-ajaxAction",
                data: {'action': 'employeelist'},
                success: function(data) {
                    var employeelist = JSON.parse(data);
                    var optionHTML = '<option value="">Select Supervisor</option>';
                    for(var i = 0 ; i < employeelist.length ; i++)
                    {
                        var temp = "";
                        var temp = "<option value='" + employeelist[i].id +"' >" + employeelist[i].name +" "+ employeelist[i].father_name +"</option>";
                        optionHTML = optionHTML + temp ;
                    }
                    
                    var button='<div class="removediv">'+
                            '<div class="row">'+
                                '<div class="col-lg-6">'+
                                    '<div class="form-group ">'+
                                        '<label class="col-lg-4 control-label"></label>'+
                                        '<div class="col-lg-8">'+
                                            '<input name="designation[]" class="form-control" placeholder="Add more Designation" required>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-lg-6">'+
                                    '<div class="form-group ">'+
                                        '<div class="col-lg-8">'+
                                            '<select class="form-control supervisor_name" id="supervisor_name" name="supervisor_name[]">'+
                                                 optionHTML +
                                            '</select>'+
                                        '</div>'+
                                        '<div class="col-lg-4">'+
                                            '<input type="button" class="red form-control removebtn" value="Remove">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                
                    $('.add_designation_div').append(button);
                }
            });
            
            
        });
        
        $('body').on('click','.removebtn',function(){
            $(this).closest('.removediv').remove();
        });
    };

    var editlist = function() {
        var form = $('#department-edit');
        var rules = {
            department_name: {required: true},
            designation: {required: true},
//            manager_name: {required: true},
//            comanager_name: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
        $('body').on('click','.add_designation',function(){
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/department-ajaxAction",
                data: {'action': 'employeelist'},
                success: function(data) {
                    var employeelist = JSON.parse(data);
                    var optionHTML = '<option value="">Select Supervisor</option>';
                    for(var i = 0 ; i < employeelist.length ; i++)
                    {
                        var temp = "";
                        var temp = "<option value='" + employeelist[i].id +"' >" + employeelist[i].name +" "+ employeelist[i].father_name +"</option>";
                        optionHTML = optionHTML + temp ;
                    }
                    
                    var button='<div class="removediv">'+
                            '<div class="col-lg-12">'+
                            '<div class="row">'+
                                '<div class="col-lg-6">'+
                                    '<div class="form-group ">'+
                                        '<label class="col-lg-4 control-label"></label>'+
                                        '<div class="col-lg-8">'+
                                            '<input name="designation[]" class="form-control" placeholder="Add more Designation" required>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-lg-6">'+
                                    '<div class="form-group ">'+
                                        '<div class="col-lg-8">'+
                                            '<select class="form-control supervisor_name" id="supervisor_name" name="supervisor_name[]">'+
                                                 optionHTML +
                                            '</select>'+
                                        '</div>'+
                                        '<div class="col-lg-4">'+
                                            '<input type="button" class="red form-control removebtn" value="Remove">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '</div>'+
                        '</div>';
                
                    $('.add_designation_div').prepend(button);
                }
            });
        });
        
        $('body').on('click','.removebtn',function(){
            $(this).closest('.removediv').remove();
        });

        $('body').on('click','.editRemovebtn',function(){
            $(this).closest('.editRemovediv').remove();
        });
    };

    return {
        init: function() {
            handleList();
        },
        add :function(){
            addlist();
        },
        edit :function(){
            editlist();
        }
    }

}();