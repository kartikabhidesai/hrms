var Announcement = function () {
    
    var handleList = function () {
        var priority = $("#priority").val();
        var status = $("#status").val();
        var dataArr = {"priority" : priority, "status" : status};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#announcementTable',
            'ajaxURL': baseurl + "company/announcement-ajaxAction",
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

        $('body').on('click', '.announcementDelete', function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })
        
        $('body').on('click', '.filler', function () {
            var priority = $('#priority option:selected').val();
            var status = $('#status option:selected').val();
            var querystring = (priority == '' && typeof priority === 'undefined') ? '&priority=' : '&priority=' + priority;
            
            /*Don't remove this code as it's in-progress*/
            querystring += (status == '' && typeof status === 'undefined') ? '&status=' : '&status=' + status;
            
            location.href = baseurl + 'company/announcement-list?' + querystring;
        }); 
    
        $('body').on('click', '.deleteTraning', function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })
 
        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/announcement-ajaxAction",
                data: {'action': 'deleteAnnouncement', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var addAnnouncement = function(){
        dateFormate('.start_date');
        
        $('#datetimepicker .time').timepicker({
            'showDuration': true,
            'timeFormat': 'g:ia'
        });

        var form = $('#addAnnouncement');
        var rules = {
            location: {required: true},
            budget: {required: true},
            requinment: {required: true},
            department_id: {required: true},
            numbers: {required: true,number:true},
            types: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });

        var empCount=1;
        // addDepartment(empCount);
        // // getemployee(empCount);
        // $('body').on('click', '.add-emp', function () {
        //     empCount++;
        //     addDepartment(empCount);
        // });

       
    }

    return {
        init: function () {
            handleList();
        },
        add:function(){
          addAnnouncement();  
        },
    }
}();