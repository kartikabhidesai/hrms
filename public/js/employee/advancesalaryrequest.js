var Advancesalaryrequest = function () {
    
    var handleList = function () {
        
        
        $('body').on('click', '.requestDelete', function () {
            var id = $(this).data('id');
            
            setTimeout(function () {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })
        checkDateRange('.dateField', '#startDate', '#endDate', 'Start Date Must be Greater From End Date');
        $('body').on('click', '.yes-sure', function () {
            var id = $(this).attr('data-id');
            
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "employee/advance-salary-request-ajaxAction",
                data: {'action': 'deleteLeave', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#requestlist',
            'ajaxURL': baseurl + "employee/advance-salary-request-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [3],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    };
    
    var addRequest = function () {
        
        var form = $('#addNewRequest');
        var rules = {
            emp_name: {required: true},
            emp_id: {required: true},
            date_of_submit: {required: true},
            reason: {required: true},
            // files: {required: true},
            
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    };
    
    var editRequest=function(){
        var form = $('#editNewRequest');
        var rules = {
            emp_name: {required: true},
            emp_id: {required: true},
            date_of_submit: {required: true},
            reason: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    return {
        init: function () {
            handleList();
        },
        add: function(){
            addRequest();
        },
        edit:function(){
            editRequest();
        },
    }
}();