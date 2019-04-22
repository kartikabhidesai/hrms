var Plan = function() {
    var handleList = function() {
     
        $('body').on('click', '.plan_managementDelete', function() {
            $('#deleteModel').modal('show');
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        });

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/plan-management-ajaxAction",
                data: {'action': 'deletePlan', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        dateFormate('.expiry_at');

        var form = $('#addPlan');
        var rules = {
            code: {required: true},
            expiry_at: {required: true},
            duration: {required: true},
            title: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });

        var form = $('#editPlan');
        var rules = {
            code: {required: true},
            expiry_at: {required: true},
            duration: {required: true},
            title: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
        var arrList = {
            'tableID': '#plan-management-datatable',
            'ajaxURL': baseurl + "admin/plan-management-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [],
            'noSortingApply': [],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    return {
        init: function() {
            handleList();
        },
        add: function() {
            handleList();
        }
    }
}();