var DailyAttendance = function () {
    
    var handleList = function () {

        // checkDateRange('.dateField', '#startDate', '#endDate', 'Start Date Must be Greater From End Date');
        dateFormate('.date')

        var form = $('#manageDailyAttendance');
        var rules = {
            department_id: {required: true},
            date: {required: true},
            
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
        
        $('body').on('click','.getattdance',function(){
            $('.department_id').css('border','1px solid #e5e6e7');
               $('.attendanceDate').css('border','1px solid #e5e6e7');
           var departentId=$('.department_id').val();
           var date=$('.attendanceDate').val();
           var visit="true";
           if(departentId == '' && date == ''){
               $('.department_id').css('border','1px solid red');
               $('.attendanceDate').css('border','1px solid red');
               visit="false";
           }else{
                if(departentId == ''){
                    $('.department_id').css('border','1px solid red');
                    visit="false";
                }
                if(date == ''){
                    $('.attendanceDate').css('border','1px solid red');
                    visit="false";
                }
           }
           
           if(visit == "true"){
//               payment_method=sepa&month=01&year=
               window.location.href = baseurl+"company/daily-attendance?departentId="+departentId+"&date="+date;
               
           }
        });
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-daily-attendance',
            'ajaxURL': baseurl + "employee/employee-ajaxAction",
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

        function get_reason_holder(status, employee_id)
        {
          alert('x');
          /*$('#reason_holder_2_' + employee_id).attr('style', 'display: none;');

          if($('#status_1').val() == 2) {
            $('#reason_holder_' + employee_id).attr('style', 'display: block;');
          } else {
            $('#reason_holder_' + employee_id).attr('style', 'display: none;');
          }*/
        }
    }

    return {
        init: function () {
            handleList();
        }
    }
}();