var Payrollsetting = function () {

    var paysettingList = function () {
        
         $('body').on('click', '.payrollSettingDelete', function() {
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
                url: baseurl + "company/payrollsettingdelete-ajaxAction",
                data: {'action': 'payrollsettingdelete', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
      
      
      
        var form = $('#addGrade');
        var rules = {
            grade: {required: true},
            basic_salary: {required: true},
            payment_date: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            ajaxcall($(form).attr('action'), $(form).serialize(), function (output) {
                handleAjaxResponse(output);
            });
        });
        
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#payrollSetting',
            'ajaxURL': baseurl + "company/payrollSetting-ajaxAction",
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
    return {
        init: function () {
            paysettingList();
        }
    }

}();