var TaskReport = function () {
    
    var handleList = function () {
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#taskReportTable',
            'ajaxURL': baseurl + "company/taskreport-ajaxAction",
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


        $('body').on('click','.downloadPdf',function(){
            var emp_id = $('.emp_id').val();
            var dept_id = $('.dept_id').val();
            
            if(!emp_id && !dept_id) {
                alert('Please select any Employee OR Department!');
                return false;
            } 
              
            if(emp_id =='' || dept_id == '') {
                alert('Please select any one from Employee and Department!');
                return false;
            }
            
            if(emp_id != '' && dept_id != '') {
                var arrEmp = [];
                if (emp_id == 'All') {
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
                    $('#taskReportSystem').submit()
                }
            }
        });
        
        $('body').on('click','.singlePdfDownload',function(){
            var emp_id = $(this).attr('data-id');
            var dept_id = $(this).attr('data-department');
            var taskReport_id = $(this).attr('data-taskreportid');
            // console.log(emp_id+"-"+dept_id+"-"+taskReport_id);
            if(emp_id != '' && dept_id != '') {
                var arrEmp = [];
                arrEmp.push(emp_id);
                // console.log(emp_id+"--"+dept_id+"--"+taskReport_id);
                $('.emparray').val(arrEmp);
                $('.dept_id').val(dept_id);
                $('.taskReportId').val(taskReport_id);
                $('.downloadstatus').val('single');
                if(arrEmp.length > 0){
                    $('#taskReportSystem').submit()
                }
            }
        });

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

        $('body').on('click', '.taskReportDelete', function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        });

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/taskreport-ajaxAction",
                data: {'action': 'deleteTaskSystem', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });

        
        
    }

    return {
        init: function () {
            handleList();
        },
    }
}();