var ClientReport = function () {
    var handleList = function () {

        var form = $('#sendSMS');
        var rules = {
          // emp_id: {required: true},
          message: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-clientReport',
            'ajaxURL': baseurl + "company/client-report-ajaxAction",
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


        $('body').on('change', '#time_period', function () {
            if($(this).val() == 'custom')
            {
                $('#date_period').removeAttr('disabled');       
                $('#date_period').attr('required','required');       
            }
            else
            {
                $('#date_period').attr('disabled','disabled');
                $('#date_period').removeAttr('required');
            }
            
        })

        $( "#date_period").datepicker({ 
                            format: 'dd-mm-yyyy',
                            autoclose: true,
                            todayHighlight: true,
                            onSelect: function () {
                                // $("#date_period").valid();
                            }
                        });

        $('body').on('click', '#downloadPDF', function () {
            // alert('as'); return false;
            var time_period = $('#time_period').val();
            var date_period = $('#date_period').val();

            if (time_period != '') 
            {
                if(time_period == 'custom' && date_period == '')
                {
                    return false;
                }
                $('#form_time_period').val(time_period);
                $('#form_date_period').val(date_period);
                // window.location.href = baseurl + "company/client-report-ajaxAction?action=downloadPDF&time_period="+time_period+"&date_period="+date_period; 
                $('#pdfForm').submit();
            }

            // $.ajax({
            //     type: "POST",
            //     headers: {
            //         'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            //     },
            //     url: baseurl + "company/client-report-ajaxAction",
            //     data: {'action': 'downloadPDF','time_period':time_period,'date_period':date_period},
            //     success: function (data) {
            //         // handleAjaxResponse(data);
            //     }
            // });
        });
    }
    return {
        init: function () {
            handleList();
        }
    }
}();