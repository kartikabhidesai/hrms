var WorkingDaySetting = function () {
    
    var handleList = function () {
    	$('#datetimepicker .day_time').timepicker({
            'showDuration': true,
            'timeFormat': 'G:i:s'
        });
        var form = $('#workingDaySetting');
        var rules = {
          // emp_id: {required: true},
//          amount: {required: true,number:true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
        var ev= $('#cData').val();
        dateFormate('.date')
        $( "#date" ).datepicker({ minDate: new Date()});
    	$(".fc-day").click(function(){
            $('.event_date').val();
            $('#addNewEventModel').modal('show');
            var str = $(this).data("date");
            var dateforemate = str.split("-");
            var selectedDateNew = dateforemate[1] +'/'+dateforemate[2]+'/'+ dateforemate[0];
            $('.event_date').val(selectedDateNew);
            $(this).datepicker('hide');
        });
        
        
                
        $('body').on('click', '.newDateModel', function() {
            var date = $('#date').val();
            var form = $('#addNonWorkingDate');
            var rules = {
                date: {required: true},
            }; 
            if(date == ''|| date == null){
                $('#date').css('border','1px solid red');
            }else{
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "company/workingDaySetting-ajaxAction",
                    data: {'action': 'addNonWorkingDate', 'date': date},
                    success: function(data) {
                        handleAjaxResponse(data);
                    }
                });
            }
        });
	}

    return {
        init: function () {
            handleList();
        }
    }
}();