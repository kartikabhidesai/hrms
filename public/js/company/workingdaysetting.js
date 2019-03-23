var WorkingDaySetting = function () {
    
    var handleList = function () {
    	$('#datetimepicker .day_time').timepicker({
            'showDuration': true,
            'timeFormat': 'G:i:s'
        });
        
        var ev= $('#cData').val();
        dateFormate('.date')
        $( "#date" ).datepicker({ minDate: new Date()});
    	$(".fc-day").click(function(){
            $('.event_date').val();
            $('#addNewEventModel').modal('show');
            var str = $(this).data("date");
            console.log(str)
            var dateforemate = str.split("-");
            var selectedDateNew = dateforemate[1] +'/'+dateforemate[2]+'/'+ dateforemate[0];
            $('.event_date').val(selectedDateNew);
            $(this).datepicker('hide');
        });

        $('body').on('click', '.newDateModel', function() {

        	var form = $('#addNonWorkingDate');
		    var rules = {
		        date: {required: true},
		    };        	
            var date = $('#date').val();
            
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
        });
        
	}

    return {
        init: function () {
            handleList();
        }
    }
}();