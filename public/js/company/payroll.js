var Payroll = function () {
    var handleList = function () {

        var form = $('#addPayroll');
        var rules = {
            salary_grade: {required: true},
            basic_salary: {required: true},
            over_time: {required: true},
            department: {required: true},
            due_date: {required: true},
            housing: {required: true},
            medical: {required: true},
            transportation: {required: true},
            travel: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
        dateFormate('.date')
        
$('body').on('click', '.empDelete', function() {
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
                url: baseurl + "company/payroll-ajaxAction",
                data: {'action': 'deletePayroll', 'data': data},
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