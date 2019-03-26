var Payment = function() {
    var handleList = function() {
        $('body').on('click', '.enable', function() {
            var id = $(this).data('id');            
            setTimeout(function() {
                $('.yesenable:visible').attr('data-id', id);
            }, 500);
        });
        
        $('body').on('click', '.yesenable', function() {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/payment-ajaxAction",
                data: {'action': 'enableRequest', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        
        $('body').on('click', '.disable', function() {
            var id = $(this).data('id'); 
            setTimeout(function() {
                $('.yesdisable:visible').attr('data-id', id);
            }, 500);
        })
        
         $('body').on('click', '.yesdisable', function() {
            var id = $(this).attr('data-id');
            
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/payment-ajaxAction",
                data: {'action': 'disableRequest', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        
        $('body').on('click', '.requestDelete', function() {
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
                url: baseurl + "admin/payment-ajaxAction",
                data: {'action': 'deleteCompany', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
        var arrList = {
            'tableID': '#dataTables-paymentLIst',
            'ajaxURL': baseurl + "admin/payment-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [3],
            'defaultSortColumn': 1,
            'defaultSortPayment': 'asc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
   
    return {
        init: function() {
            handleList();
        },        
    }
}();