var Advancesalaryrequest = function (){
    var approvedReqList = function () {
        
        $('body').on('click','#selectall',function() {
            $('.approved_chk_id').not(this).prop('checked', this.checked);
        });
        
        var checkedBoxArr = [];
  
        $('body').on('click','#approved_chk_id',function(){
            var checked = $(this).val();
            if ($(this).is(':checked')) {
                checkedBoxArr.push(checked);
            } else {
                checkedBoxArr.splice($.inArray(checked, tmp), 1);
            }
        });

        $('body').on('click', '.applyBtn', function () {
            var month = $('#month option:selected').val();
            var year = $('#year option:selected').val();
            var querystring = (month == '' && typeof month === 'undefined') ? '&month=' : '&month=' + month;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;
            location.href = baseurl + 'employee/employee-approved-advance-salary-request?' + querystring;
        }); 
        
        
         $('body').on('click', '.clearBtn', function () {
            location.href = baseurl + 'employee/employee-approved-advance-salary-request';
        });
        $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                ]

            });
        $('#DownloadButton').on('click', function () {
            var token=$("#_token").val();
            
            var selecteditem = [];
            $.each($(".approved_chk_id:checked"), function(){            
                selecteditem.push($(this).val());
            });
            
            if(selecteditem.length == '0'){
                    showToster("error", "First Select any Employee", '');
            }else{
                $.ajax({
                    type: "post",
                    url: baseurl + "employee/employee-createApprovedPdf",
                    data: {"selecteditem":selecteditem,"_token":token},
                    success: function (response)
                    {
                       window.location.replace(baseurl + "employee/employee-downloadApprovedPdf?pdfname="+response);
                    }
                });
            }
        });

        $('#DownloadExcelButton').on('click', function () {
            var token=$("#_token").val();
            var selecteditem = [];
            $.each($(".approved_chk_id:checked"), function(){            
                selecteditem.push($(this).val());
            });
            
            if(selecteditem.length == '0'){
                    showToster("error", "First Select any Employee", '');
            }else{
                window.location.replace(baseurl + "employee/employee-createApprovedExcel?selecteditem="+selecteditem);
                
            }
        });

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};
        var arrList = {
            'tableID': '#approvedRequestlist',
            'ajaxURL': baseurl + "employee/employee-approved-salary-request-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }
            ],
            'select': {
              'style': 'multi'
            },
            'noSearchApply': [0],
            'noSortingApply': [3],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    };

    
      
    return {
        
        initApprovedReqList:function(){
            approvedReqList();
        },
    }
}();