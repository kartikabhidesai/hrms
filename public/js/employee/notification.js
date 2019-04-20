var Notification = function () {
    
    var handleList = function () {
        var form = $('#taxId');
        var rules = {
          // emp_id: {required: true},
          amount: {required: true,number:true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });


        var columnWidth = {"width": "10%", "targets": 0};

            var arrList = {
                'tableID': '#notificationTable',
                'ajaxURL': baseurl + "employee/notification-ajaxAction",
                'ajaxAction': 'getdatatable',
                'postData': [],
                'hideColumnList': [],
                'noSearchApply': [0],
                'noSortingApply': [],
                'defaultSortColumn': 0,
                'defaultSortOrder': 'desc',
                'setColumnWidth': columnWidth
            };
            getDataTable(arrList);

            $('body').on('click', '.deleteNotification', function() {
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
                    url: baseurl + "employee/notification-ajaxAction",
                    data: {'action': 'deleteNotification', 'data': data},
                    success: function(data) {
                        handleAjaxResponse(data);
                    }
                });
            });
    }
    return {
        init: function () {
            handleList();
        }
    }
}();