var TimeChangeRequest = function() {
    var handleList = function() {
        
        $('body').on('click', '.approve', function() {
            var id = $(this).data('id');
            
            setTimeout(function() {
                $('.yesapprove:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yesapprove', function() {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/timeChangeRequest-ajaxAction",
                data: {'action': 'approveRequest', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        $('body').on('click', '.disapprove', function() {
            var id = $(this).data('id');
            
            setTimeout(function() {
                $('.yesreject:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yesreject', function() {
            var id = $(this).attr('data-id');
            
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/timeChangeRequest-ajaxAction",
                data: {'action': 'disapproveRequest', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        
       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
            var arrList = {
            'tableID': '#timeChangeRequestDatatables',
            'ajaxURL': baseurl + "company/timeChangeRequest-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [0],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    };
    return {
        init: function() {
            handleList();
        }
    }
}();