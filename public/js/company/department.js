var Department = function() {
    var handleList = function() {
       
       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
            var arrList = {
            'tableID': '#DepartmentDatatables',
            'ajaxURL': baseurl + "company/department-ajaxAction",
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
    };
    
    var addlist = function(){
        
        var form = $('#department-add');
        var rules = {
            department_name: {required: true},
            designation: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
        $('body').on('click','.add_designation',function(){
            var button='<div class="form-group removediv">'+
                            '<label class="col-lg-2 control-label"></label>'+
                                '<div class="col-lg-8">'+
                                    '<input name="designation[]" class="form-control" placeholder="Add more Designation" required>'+
                                '</div>'+
                                '<div class="col-lg-2">'+
                                    '<input type="button" class="red form-control removebtn" value="Remove">'+
                                '</div>'+
                            '</div>';
            $('.add_designation_div').prepend(button);
        });
        
        $('body').on('click','.removebtn',function(){
            $(this).closest('.removediv').remove();
        });
    };
    return {
        init: function() {
            handleList();
        },
        add :function(){
            addlist();
        },
    }
}();