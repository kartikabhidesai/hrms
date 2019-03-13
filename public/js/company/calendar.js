var Calendar = function () {
    var ev= $('#cData').val();
    var handleList = function () {
    	dateFormate('.date')
        $('#datetimepicker .event_time').timepicker({
            'showDuration': true,
            'timeFormat': 'g:ia'
        });
        
    	var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        
        // console.log(Date(y, m, d));
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            eventRender: function(eventObj, $el) {
                $el.popover({
                  title: eventObj.title,
                  content: eventObj.description,
                  trigger: 'hover',
                  placement: 'top',
                  container: 'body'
                });
              },
            events: baseurl +'company/getevents/'
        });
        
        $('body').on('click', '.newEventModel', function() {

        	var form = $('#addNewEvent');
		    var rules = {
		        title: {required: true},
		        notes: {required: true},
                date: {required: true},
                time: {required: true},
		    };

        	var title = $('.title').val();
        	var notes = $('.notes').val();
            var date = $('.event_date').val();
            var time = $('.event_time').val();
        	
        	$.ajax({
	            type: "POST",
	            headers: {
	                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
	            },
	            url: baseurl + "company/calendar-ajaxAction",
	            data: {'action': 'addNewEvent', 'title': title, 'notes': notes, 'date': date,'time': time},
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