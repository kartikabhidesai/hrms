var Recruitment = function () {
    
    var handleList = function () {


        $('body').on('click', '.recruitmentDelete', function() {
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
                url: baseurl + "company/recruitment-ajaxAction",
                data: {'action': 'deleteRecruitment', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });

        
        var status = $("#status").val();
        var dataArr = {"status" : status};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#recruitmentTable',
            'ajaxURL': baseurl + "company/recruitment-ajaxAction",
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

        $('body').on('click', '.recruitmentDelete', function() {
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
            
            location.href = baseurl + 'company/recruitment-list?' + querystring;
        }); 

        
        
    }

    var addRecruitment = function(){
        
        dateFormate('.start_date');
        dateFormate('.expire_date');

        $('body').on('change', '.department', function() {
            var dept = $('#department option:selected').text();
            $('.dept').val(dept);
          
        })   

        var form = $('#addRecruitment');
        var rules = {
            task: {required: true},
            department: {required: true},
            responsibility: {required: true},
            requirement: {required: true},
            experience_level: {required: true},
            jobtime: {required: true},
            contract: {required: true},
            salary: {required: true},
            email: {required: true},
            conatact_us: {required: true},
            start_date: {required: true},
            expire_date: {required: true},
            job_id: {required: true}
        };

         handleFormValidate(form, rules, function(form) {
           ajaxcall($(form).attr('action'), $(form).serialize(), function (output) {
               var data = JSON.parse(output);
               window.open(data.file, '_blank');
               handleAjaxResponse(output);
//               console.log(data.file);
//               exit();

                });
        });

        var form = $('#editRecruitment');
        var rules = {
            task: {required: true},
            department: {required: true},
            responsibility: {required: true},
            requirement: {required: true},
            experience_level: {required: true},
            jobtime: {required: true},
            contract: {required: true},
            salary: {required: true},
            email: {required: true},
            conatact_us: {required: true},
            start_date: {required: true},
            expire_date: {required: true},
            job_id: {required: true}
        };

        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });

        var dataArr = {"status" : status};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#recruitmentTable',
            'ajaxURL': baseurl + "company/recruitment-ajaxAction",
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
            handleList();
        },
        add:function(){
          addRecruitment();  
        },
    }
}();