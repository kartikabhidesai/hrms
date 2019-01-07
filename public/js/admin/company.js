var Company = function() {
    var handleList = function() {
     
        $('body').on('click', '.CompanyDelete', function() {
            
            // $('#deleteModel').modal('show');
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
                url: baseurl + "admin/company-ajaxAction",
                data: {'action': 'deleteCompany', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
      
        var form = $('#addCompany');
        var rules = {
            company_name: {required: true},
            email: {required: true},
            status: {required: true},
            subcription: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        var form = $('#editCompany');
        var rules = {
            company_name: {required: true},
            email: {required: true},
            status: {required: true},
            subcription: {required: true},
            
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
       
        
       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
        var arrList = {
            'tableID': '#dataTables-company',
            'ajaxURL': baseurl + "admin/company-ajaxAction",
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
    return {
        init: function() {
            
            handleList();
        }
    }
}();