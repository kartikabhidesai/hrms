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
                                    '<input name="extraallowance['+allowance+']" class="form-control" placeholder='+allowance+' required>'+
                                '</div>'+
                                '<div class="col-lg-1 control-label">'+
                                    '<a class="link-black text-sm removebtn"><i class="fa fa-trash"></i></a>'+
                                '</div>'+
                            '</div>';
            $('.add_designation_div').prepend(inputBox);
            $('#addMoreAllowanceModel').modal('hide');
            var allowance = [];
            allowance.push($('.allowance').val(''));
            $('.allowance').val('');
        });

        $('body').on('click','.removebtn',function(){
            $(this).closest('.removediv').remove();
        });

        $('.add_deduction').on('click', function(){
            var deduction = $('.deduction').val();
            var inputBox='<div class="form-group removedeductiondiv deduction[]">'+
                            '<label class="col-lg-3 control-label">'+deduction+'</label>'+
                                '<div class="col-lg-8">'+
                                    '<input name="extradeduction['+deduction+']" class="form-control" placeholder='+deduction+' required>'+
                                '</div>'+
                                '<div class="col-lg-1 control-label">'+
                                    '<a class="link-black text-sm removeDeductionbtn"><i class="fa fa-trash"></i></a>'+
                                '</div>'+
                            '</div>';
            $('.add_deduction_div').prepend(inputBox);
            $('#addDeductionModel').modal('hide');
            var deduction = [];
            deduction.push($('.allowance').val(''));
            $('.deduction').val('');
        });

        $('body').on('click','.removeDeductionbtn',function(){
            $(this).closest('.removedeductiondiv').remove();
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

        $('body').on('click', '.applyBtn', function () {
            var department = $('#department option:selected').val();
            var employee = $('#employee option:selected').val();
            var querystring = (department == '' && typeof department === 'undefined') ? 'department=' : 'department=' + department;
            querystring += (employee == '' && typeof employee === 'undefined') ? '&employee=' : '&employee=' + employee;
            location.href = baseurl + 'company/payroll-list?' + querystring;

        });

        $('body').on('click', '.clearBtn', function () {
            location.href = baseurl + 'company/payroll-list';
        });

    }
    return {
        init: function () {
            handleList();
        }
    }
}();