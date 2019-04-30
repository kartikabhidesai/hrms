var Order = function() {
    var handleList = function() {
        $('body').on('click', '.approve', function() {
            var id = $(this).data('id');   
            var company_name = $(this).data('company_name');
            var company_email = $(this).data('company_email');
            setTimeout(function() {
                $('.yesapprove:visible').attr('data-id', id);
                $('.yesapprove:visible').attr('data-company_name', company_name);
                $('.yesapprove:visible').attr('data-company_email', company_email);
            }, 500);
        });
        
        $('body').on('click', '.yesapprove', function() {
            var id = $(this).attr('data-id');
            var company_name = $(this).attr('data-company_name');
            var company_email = $(this).attr('data-company_email');
            var data = {id: id,
                        company_email:company_email,company_name:company_name, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/order-ajaxAction",
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
                url: baseurl + "admin/order-ajaxAction",
                data: {'action': 'disapproveRequest', 'data': data},
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
                url: baseurl + "admin/order-ajaxAction",
                data: {'action': 'deleteCompany', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
        var arrList = {
            'tableID': '#dataTables-orderLIst',
            'ajaxURL': baseurl + "admin/order-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [3,5],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    
    var approvedList = function(){
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
                url: baseurl + "admin/order-ajaxAction",
                data: {'action': 'deleteCompany', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
         var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
        var arrList = {
            'tableID': '#dataTables-orderLIst',
            'ajaxURL': baseurl + "admin/order-ajaxAction",
            'ajaxAction': 'getdatatableApproved',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [3,5],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    return {
        init: function() {
            handleList();
        },
        approved:function(){
            approvedList();
        },
        
    }
}();