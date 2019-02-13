var Advancesalaryrequest = function (){
    var handleList = function () {
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
                url: baseurl + "company/advance-salary-request-ajaxAction",
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
                url: baseurl + "company/advance-salary-request-ajaxAction",
                data: {'action': 'disapproveRequest', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};
        var arrList = {
            'tableID': '#requestlist',
            'ajaxURL': baseurl + "company/advance-salary-request-ajaxAction",
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
    };
    
    var addRequest = function () {
        
        var form = $('#addNewRequest');
        var rules = {
            emp_name: {required: true},
            emp_id: {required: true},
            date_of_submit: {required: true},
            reason: {required: true},
            files: {required: true},
            
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    };
    
    var editRequest=function(){
        var form = $('#editNewRequest');
        var rules = {
            emp_name: {required: true},
            emp_id: {required: true},
            date_of_submit: {required: true},
            reason: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });
    }

    var approvedReqList = function () {

        var checkedBoxArr = [];
  
        $('body').on('click','#approved_chk_id',function(){
            var checked = $(this).val();
            if ($(this).is(':checked')) {
                checkedBoxArr.push(checked);
            } else {
                checkedBoxArr.splice($.inArray(checked, tmp), 1);
            }
        });

        $('#DownloadButton').on('click', function () {
            var token=$("#_token").val();
            var selecteditem = [];
            $.each($(".approved_chk_id:checked"), function(){            
                selecteditem.push($(this).val());
            });
            
            if(selecteditem.length == '0'){
                    showToster("error", "First Select Employee", '');
            }else{
                $.ajax({
                    type: "post",
                    url: baseurl + "company/createApprovedPdf",
                    data: {"selecteditem":selecteditem,"_token":token},
                    success: function (response)
                    {
                       window.location.replace(baseurl + "company/downloadApprovedPdf?pdfname="+response);
                    }
                });
            }
        });

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};
        var arrList = {
            'tableID': '#approvedRequestlist',
            'ajaxURL': baseurl + "company/approved-salary-request-ajaxAction",
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
        init: function () {
            handleList();
        },
        add: function(){
            addRequest();
        },
        edit:function(){
            editRequest();
        },
        initApprovedReqList:function(){
            approvedReqList();
        },
    }
}();