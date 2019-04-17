var SendSMS = function () {
    
    var handleList = function () {

        var form = $('#sendSMS');
        var rules = {
          // emp_id: {required: true},
          message: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

        $('body').on('click','.sendSMS',function(){

            if (!($('#sendSMS').valid())){
                return false;
            }
            
            var emp_id = $('.emp_id').val();
            if(emp_id != '') {
                var arrEmp = [];
                if (emp_id == 'All') {
                    $("#emp_id option").each(function() {
                        if(this.value > 0 && this.value != 'All' && this.value != ''){
                            arrEmp.push(this.value);
                        }
                    });
                }else{
                    var ids = $("#emp_id option:selected").val();
                    arrEmp.push(ids);
                }

                $('.emparray').val(arrEmp);
            }
        });

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-sendSMS',
            'ajaxURL': baseurl + "admin/sendSMS-ajaxAction",
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

        $('body').on('change', '.company_id', function() {
            $('#dept_id').html('<option value=""> Select </option>');
            $('#emp_id').html('<option value=""> Select </option>');
            var data = $(this).val();
            $.ajax({
                    type: "POST",
                    headers:{
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "admin/sendSMS-ajaxAction",
                    data: {'action': 'getDepartment', 'data': data},
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        if (obj.length == 0) {
                            $('#dept_id').find('option').remove();
                            $('#dept_id').append('<option value="">No Record Found</option>').val('');
                        }else{
                            $('#dept_id').append('<option value="All">Select All</option>').val('All');
                        }
                        $.each(obj, function(i, item) {
                            $('#dept_id').append($('<option>', {
                                value: i,
                                text: item
                            }));
                        });                        
                    }
                });
            });

         $('body').on('change', '.dept_id', function() {
            $('#emp_id').html('<option value=""> Select </option>');
            var dept_id = $(this).val();
            var company_id = $('.company_id').val();
            $.ajax({
                    type: "POST",
                    headers:{
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "admin/sendSMS-ajaxAction",
                    data: {'action': 'getEmployee', 'dept_id': dept_id,'company_id':company_id},
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        if (obj.length == 0) {
                            $('#emp_id').find('option').remove();
                            $('#emp_id').append('<option value="">No Record Found</option>').val('');
                        }else{
                            $('#emp_id').append('<option value="All">Select All</option>').val('All');
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

    }
    return {
        init: function () {
            handleList();
        }
    }
}();