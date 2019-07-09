var SendSMS = function () {
    
    var handleList = function () {

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
          dept_id: {required: true},
          emp_id: {required: true},
          message: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

//        $('body').on('click','.sendSMS',function(){
//            /*$('.emp_id').css('border','1px solid #e5e6e7');
//            $('.message').css('border','1px solid #e5e6e7');*/
//            var emp_id = $('.emp_id').val();
//            var dept_id = $('.dept_id').val();
//            var message = $('.message').val();
//            
//            if(!emp_id && !dept_id) {
//                /*$('.emp_id').css('border','1px solid red');
//                $('.message').css('border','1px solid red');*/
//                alert('Please select any Employee OR Department!');
//                return false;
//            } 
//              
//            if(emp_id =='' || dept_id == '') {
//                alert('Please select any one from Employee and Department!');
//                return false;
//            }
//            
//            if(message == '') {
//                $('.message').css('border','1px solid red');
//                return false;
//            }
//            
//            if(emp_id != '' && dept_id != '') {
//                var arrEmp = [];
//                if (emp_id == 'All') {
//                    $("#emp_id > option").each(function() {
//                        if(this.value > 0){
//                            arrEmp.push(this.value);    
//                        }
//                    });
//                }else{
//                    var ids = $("#emp_id option:selected").val();
//                    arrEmp.push(ids);
//                }
//                $('.emparray').val(arrEmp);
//            }
//        });

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