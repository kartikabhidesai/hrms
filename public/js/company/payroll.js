var Payroll = function () {
    var handleList = function () {
        var form = $('#addPayroll');
        var rules = {
            salary_grade: {required: true},
            basic_salary: {required: true},
            over_time: {required: true},
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
            
        $('.add_allowance').on('click', function(){
            var allowance = $('.allowance').val();
            var inputBox='<div class="form-group removediv allowance[]">'+
                            '<label class="col-lg-3 control-label">'+allowance+'</label>'+
                                '<div class="col-lg-8">'+
                                    '<input name="'+allowance+'_allowance" class="form-control" placeholder='+allowance+' required>'+
                                '</div>'+
                                '<div class="col-lg-1 control-label">'+
                                    '<a class="link-black text-sm removebtn"><i class="fa fa-trash"></i></a>'+
                                '</div>'+
                            '</div>';
            $('.add_designation_div').prepend(inputBox);
            $('#addMoreAllowanceModel').modal('hide');
            var allowance = [];
            allowance.push($('.allowance').val(''));
            console.log(allowance);
            $('.allowance').val('');
        });

        $('body').on('click','.removebtn',function(){
            $(this).closest('.removediv').remove();
        });
        
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