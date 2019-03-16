var Announcement = function () {
    
    var handleList = function () {
        
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#AnnouncementDatatables',
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
        $('[data-toggle="tooltip"]').tooltip(); 
        
        $('#datetimepicker .time').timepicker({
            'showDuration': true,
            'timeFormat': 'g:ia'
        });

        var form = $('#addAnnouncement');
        var rules = {
            title: {required: true},
            status: {required: true},
            content: {required: true},
            start_date: {required: true},
            time: {required: true},
            
        };
        handleFormValidate(form, rules, function(form) {
           handleAjaxFormSubmit(form,true);
        });

        

       
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