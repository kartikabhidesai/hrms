var attendanceHistory = function () {
    
  var handleList = function () {
      dateFormate('.date');
      alert('dd')
         $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });
  }

  return {
      init: function () {
        handleList();
      }
  }
}();