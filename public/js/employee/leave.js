var Leave = function () {
    
    var handleList = function () {
        

        $('body').on('click', '.leaveDelete', function () {
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
                url: baseurl + "employee/employee-ajaxAction",
                data: {'action': 'deleteLeave', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });

        dateFormate('.date')
       
        var form = $('#addLeave');
        var rules = {
            start_date: {required: true},
            end_date: {required: true},
            reason: {required: true},
            typeRequest: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-leave',
            'ajaxURL': baseurl + "employee/employee-ajaxAction",
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
    }
    return {
        init: function () {
            handleList();
        }
    }
}();