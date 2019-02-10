var Paylip = function () {
    
  var handleList = function () {
      dateFormate('.date');

       $('body').on('click', '.applyBtn', function() {
            var consult_id = [];
            var department = $('#department option:selected').val();
            var month = $('#months option:selected').val();
            var year = $('#year option:selected').val();
            var employee = $('#employee option:selected').val();
            var querystring = (department == '' && typeof department === 'undefined') ? 'department=' : 'department=' + department;
         
            querystring += (month == '' && typeof month === 'undefined') ? '&month=' : '&month=' + month;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;
            querystring += (employee == '' && typeof employee === 'undefined') ? '&employee=' : '&employee=' + employee;
            location.href = baseurl + 'company/pay-slip?' + querystring;
       
        }); 
 
        $('body').on('click', '.clearBtn', function() {
            location.href = baseurl + 'company/pay-slip';
        });

  }
  return {
      init: function () {
        handleList();
      }
  }

}();