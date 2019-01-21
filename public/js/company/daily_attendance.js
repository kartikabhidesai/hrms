var DailyAttendance = function () {
    
  var handleList = function () {
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
        if(departentId == '' && date == '') {
          $('.department_id').css('border','1px solid red');
          $('.attendanceDate').css('border','1px solid red');
          visit="false";
        } else {
          if(departentId == ''){
            $('.department_id').css('border','1px solid red');
            visit="false";
          }
          if(date == ''){
            $('.attendanceDate').css('border','1px solid red');
            visit="false";
          }
        }
         
        if(visit == "true") {
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

      /*Start hide/show reason input box*/
      $('.emp_rows').on('change', function() {
        var status = this.value;
        var emp_id = $(this).attr("data-id");
        get_reason_holder(status, emp_id);
      });

      function get_reason_holder(status, emp_id)
      {
        $('#reason_holder_2_' + emp_id).attr('style', 'display: none;');

        if(status == 2) {
          $('#reason_holder_' + emp_id).attr('style', 'display: block;');
        } else {
          $('#reason_holder_' + emp_id).attr('style', 'display: none;');
        }
      }
      /*End hide/show reason input box*/
  }

  return {
      init: function () {
        handleList();
      }
  }
}();