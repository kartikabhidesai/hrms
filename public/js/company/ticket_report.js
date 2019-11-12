var TicketReport = function () {
    var handleList = function () {

        $('#downloadPdf').click(function() {
            var dept_id = $('#emp_id option:selected').val();
            
        });
         $('#dept_id').change(function() {
            var dept_id = $('#emp_id option:selected').val();
            if (dept_id == 'All') {
                $('#emp_id option').prop('selected', true);
            } else {
                $('#emp_id option').prop('selected', false);
            }
        });

        var form = $('#sendSMS');
        var rules = {
          // emp_id: {required: true},
          message: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

        $('body').on('click','.downloadPdf',function(){
            var emp_id = $('.emp_id').val();
            var dept_id = $('.dept_id').val();
            
            if(!emp_id && !dept_id) {
                /*$('.emp_id').css('border','1px solid red');
                $('.message').css('border','1px solid red');*/
                alert('Please select any Employee OR Department!');
                return false;
            } 
              
            if(emp_id =='' || dept_id == '') {
                alert('Please select any one from Employee and Department!');
                return false;
            }
            
            if(emp_id != '' && dept_id != '') {
                var arrEmp = [];
                if (emp_id == 'All' && dept_id == 'All') {
                    $('#ticketSystem').submit()
                }else if (emp_id == 'All') {
                    $("#emp_id > option").each(function() {
                        if(this.value > 0){
                            arrEmp.push(this.value);    
                        }
                    });
                }else{
                    var ids = $("#emp_id option:selected").val();
                    arrEmp.push(ids);
                }
                $('.emparray').val(arrEmp);
                if(arrEmp.length > 0){
                    $('#ticketSystem').submit()
                }
            }
        });
        
        $('body').on('click','.singlePdfDownload',function(){
            var emp_id = $(this).attr('data-id');
            var dept_id = $(this).attr('data-department');
            
            if(emp_id != '' && dept_id != '') {
                var arrEmp = [];
                arrEmp.push(emp_id);
                $('.emparray').val(arrEmp);
                $('.downloadstatus').val('single');
                if(arrEmp.length > 0){
                    $('#ticketSystem').submit()
                }
            }
        });

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-sendSMS',
            'ajaxURL': baseurl + "company/sendSMS-ajaxAction",
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

         $('body').on('change', '.dept_id', function() {
            var data = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/sendSMS-ajaxAction",
                data: {'action': 'getEmployee', 'data': data},
                success: function(data) {
                    var obj = jQuery.parseJSON(data);
                    $('#emp_id').find('option').remove();
                    if (obj.length == 0) {
                        $('#emp_id').append('<option value="">No Record Found</option>').val('');
                    }else{
                        $('#emp_id').append('<option value="">Select Employee</option><option value="All">Select All</option>');
                    }
                    $.each(obj, function(i, item) {
                        $('#emp_id').append($('<option>', {
                            value: i,
                            text: item
                        }));
                    });
                    

                }
            });

        });


        $('body').on('click', '.ticketDelete', function () {
            var id = $(this).data('id');
            
            setTimeout(function () {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function () {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/ticket-report-ajaxAction",
                data: {'action': 'deleteTicketSystem', 'data': data},
                success: function (data) {
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