var Timechange = function () {
    
    var addTime = function () {
        var form = $('#newTimeChangeRequest');
        var rules = {
            name:{required: true},
            department: {required: true},
            date_of_submit: {required: true},
            from_date: {required: true},
            to_date:{required: true},
            typeRequest: {required: true},
//            total_hrs:{required: true},
            reuest_note:{required: true},
            request_name:{required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

         $('body').on('change', '.typeRequest', function () {
            var type = $('#typeRequest option:selected').val();
            if(type == 'addNew'){
                $('.requestNameTextBox').show();
            }else{
                $('.requestNameTextBox').hide();
                $('.request_name').val('');
            }
        });
    };
     var listing = function () {
        $('body').on('click', '.requestDelete', function () {
            var id = $(this).data('id');
            setTimeout(function () {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        });
       
        
        
        $('body').on('click', '.yes-sure', function () {
            var id = $(this).attr('data-id');
            
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "employee/requestlist-ajaxAction",
                data: {'action': 'deleteLeave', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#requestlist',
            'ajaxURL': baseurl + "employee/requestlist-ajaxAction",
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
            addTime();
        },
        list:function(){
            listing();
        },
    }
}();