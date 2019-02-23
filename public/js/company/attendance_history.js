var AttendanceHistory = function() {
    var handleList = function() {
        var from_date=$("#from_date").val();
        var to_date=$("#to_date").val();
        var department_id=$("#department_id").val();
       var dataArr = {"from_date":from_date,"to_date":to_date,"department_id":department_id};
       var columnWidth = {"width": "10%", "targets": 0};
            
            
            var arrList = {
            'tableID': '#attendanceHistoryList',
            'ajaxURL': baseurl + "company/attendance-history-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [0],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    };
     $('body').on('click', '.getAttedanceHisory', function() {
        var from_date=$("#from_date").val();
        var to_date=$("#to_date").val();
        var department_id=$("#department_id").val();
        var qureystring="from_date="+from_date+"&to_date="+to_date+"&department_id="+department_id;
        
        location.href = baseurl + 'company/manage-attendance-history?' + qureystring;
    });
    $('body').on('click', '.historyDetailsModel', function() {
       var data = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "company/attendance-history-ajaxAction",
            data: {'action': 'getHistoryDetails', 'data': data},
            success: function(data) {
                var  output = JSON.parse(data);
                console.log(output);
                if(output.reason === null) {
                    $('.type').html('Time Change Request Type');
                } else {
                    $('.type').html('Leave Type');
                }
                $('.empName').html(output.name);
                if(output.reason === null) {
                    $('.leaveDiv').hide();
                } else {
                    $('.leaveDiv').show();
                    $('.leaveReason').html(output.reason);
                }
                if(output.date_of_submit === null) {
                    $('.dateOfSubmitDiv').hide();
                } else {
                    $('.dateOfSubmit').html(output.date_of_submit);
                }
                if(output.total_hours === null) {
                    $('.totalHoursDiv').hide();
                } else {
                    $('.totalHours').html(output.total_hours);
                }
                if(output.request_description === null) {
                    $('.requestDescriptionDiv').hide();
                } else {
                    $('.requestDescription').html(output.request_description);
                }
                if(output.status === null && output.reason === null) {
                    $('.status').html('Pending');
                } else if(output.reason) {
                    $('.statusDiv').hide();
                } else {
                    $('.status').html(output.status);
                }
            }
        });

    });

    return {
        init: function() {
            handleList();
        }
    }
}();