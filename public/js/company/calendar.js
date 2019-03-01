var Calendar = function () {
    
    var handleList = function () {
    	dateFormate('.date')

    	var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

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
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d-5),
                    end: new Date(y, m, d-2)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d+4, 16, 0),
                    allDay: false
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }
            ]
        });

        $('body').on('click', '.newEventModel', function() {

        	var form = $('#addNewEvent');
		    var rules = {
		        title: {required: true},
		        notes: {required: true},
		        date: {required: true},
		    };

        	var title = $('.title').val();
        	var notes = $('.notes').val();
        	var date = $('.event_date').val();
        	
        	$.ajax({
	            type: "POST",
	            headers: {
	                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
	            },
	            url: baseurl + "company/calendar-ajaxAction",
	            data: {'action': 'addNewEvent', 'title': title, 'notes': notes, 'date': date},
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