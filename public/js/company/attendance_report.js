var AttendanceReport = function () {
    
    var handleList = function () {

        var form = $('#showReport');
        var rules = {
          department_id: {required: true},
          year: {required: true},
          month: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
        
//        $('body').on('click','.printattandance',function(){
//            var prtContent = document.getElementById("my_table");
//            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
//            WinPrint.document.write(prtContent.innerHTML);
//            WinPrint.document.close();
//            WinPrint.focus();
//            WinPrint.print();
//            WinPrint.close();
//        });
        $('body').on('click','.getAttedanceReport',function(){
            $('.department_id').css('border','1px solid #e5e6e7');
            $('.year').css('border','1px solid #e5e6e7');
            $('.month').css('border','1px solid #e5e6e7');
            var departentId = $('.department_id').val();
            var year = $('.year').val();
            var month = $('.month').val();
            var visit = "true";
            if(departentId == '' && year == '' && month == '') {
                $('.department_id').css('border','1px solid red');
                $('.year').css('border','1px solid red');
                $('.month').css('border','1px solid red');
                visit = "false";
            } else {
              if(departentId == '') {
                $('.department_id').css('border','1px solid red');
                visit = "false";
              }
              if(year == '') {
                $('.year').css('border','1px solid red');
                visit = "false";
              }
              if(month == '') {
                $('.month').css('border','1px solid red');
                visit = "false";
              }
            }
             
            if(visit == "true") {
                window.location.href = baseurl+"company/attendance-report?departentId="+departentId+"&year="+year+"&month="+month;
            }
        });

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-attendance-report',
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
    }
    return {
        init: function () {
            handleList();
        }
    }
}();