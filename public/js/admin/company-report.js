var CompanyReport = function() {
   
    var handleList=function(){
        

        $('body').on('click','.singlePdfDownload',function(){
            var companyId = $(this).attr('data-id');
            if(companyId != '') {
                $('.emparray').val(companyId);
                $('.downloadstatus').val('single');
                if(companyId > 0){
                    $('#pdfForm').submit()
                }
            }
        });

        $('body').on('click', '.companyReportDelete', function() {
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
                url: baseurl + "admin/company-report-ajaxAction",
                data: {'action': 'deleteCompanyReport', 'data': data},
                success: function(data) {
                    $('#deleteModel').modal('hide');
                    document.location.reload()
                    // handleAjaxResponse(data);
                }
            });
        });
        
       var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-companyReport',
            'ajaxURL': baseurl + "admin/company-report-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [],
            'noSortingApply': [],
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
        add:function(){
            addRole();
        },
        edit:function(){
            editRole();
        },
    }
}();