var Training = function () {
    
    var handleList = function () {
        var priority = $("#priority").val();
        var status = $("#status").val();
        var dataArr = {"priority" : priority, "status" : status};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#trainingTable',
            'ajaxURL': baseurl + "company/training-ajaxAction",
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

        $('body').on('click', '.trainingDelete', function() {
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
            
            location.href = baseurl + 'company/training-list?' + querystring;
        }); 
    
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
                url: baseurl + "company/training-ajaxAction",
                data: {'action': 'deleteTraining', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var addTraining = function(){
        
        $('body').on('click','.removeBtn',function(){
            $(this).parent().parent().remove(); 
        });
        
        var form = $('#addTraining');
        var rules = {
            location: {required: true},
            budget: {required: true},
            requinment: {required: true},
            department_id: {required: true},
            numbers: {required: true,number:true},
            types: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });

        var empCount=1;
        addDepartmentfirst(empCount);
        function addDepartmentfirst(eid){
            $("#emp-info").append('<div class="row" id="employee'+eid+'">\
                <div class="col-lg-1"></div>\
                <div class="col-lg-3">\
                    <div class="form-group mr-1">\
                    <select id="Department'+eid+'" data-id="'+eid+'" name="departmentid[]"  class="form-control department"></select>\
                    </div>\
                </div>\
                <div class="col-lg-3">\
                    <div class="form-group mr-1">\
                    <select id="Employee'+eid+'"  data-id="'+eid+'"  name="employeeid[]" class="form-control employee"></select>\
                    </div>\
                </div>\
                <div class="col-lg-2">\
                </div>\
            </div>');

             handleEmployee(eid); 
        }
        // getemployee(empCount);
        $('body').on('click', '.add-emp', function () {
            empCount++;
            addDepartment(empCount);
        });
        
        function addDepartment(eid){
            $("#emp-info").append('<div class="row removediv" id="employee'+eid+'">\
                <div class="col-lg-1"></div>\
                <div class="col-lg-3">\
                    <div class="form-group mr-1">\
                    <select id="Department'+eid+'" data-id="'+eid+'" name="departmentid[]"  class="form-control department"></select>\
                    </div>\
                </div>\
                <div class="col-lg-3">\
                    <div class="form-group mr-1">\
                    <select id="Employee'+eid+'"  data-id="'+eid+'"  name="employeeid[]" class="form-control employee"></select>\
                    </div>\
                </div>\
                <div class="col-lg-2" style="text-align: center;">\
                    <a class="btn btn-sm btn-danger removeBtn" ><i class="fa fa-minus"></i></a>\
                </div>\
                <div class="col-lg-2">\
                </div>\
            </div>');

             handleEmployee(eid);
        }

        $("body").on('click', '.department', function () {
            var deptVal =  $(this).attr('data-id');
            if(deptVal > 0){
                getemployee(deptVal);    
            }
        });
        
        
        function handleEmployee(eid ) { 
           var deptVal =  $('department option:selected').val(); 
           $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/department-ajaxAction",
                data: {'action': 'getCompnanyDepartmentList'},
                success: function (data) {
                    var output = JSON.parse(data);
                    var len = output.length;
                    // console.log(output);
                        $("#Department"+eid).empty();
                        for( var i = 0; i<len; i++){
                            var id = output[i]['id'];
                            var name = output[i]['department_name'];
                            $("#Department"+eid).append("<option value='"+id+"'>"+name+"</option>");
                        }
                        // $("#Department"+eid).on("change", getemployee(eid));
                        setTimeout(function(){ 
                            getemployee(eid);
                        }, 1000);
                }
            });
        } 
        function getemployee(eid) {   
           
            var department = $('#Department'+eid).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/employee-ajaxAction",
                data: {'action': 'getDepartmentEmployeeList','department_id':department},
                success: function (data) {
                    var output = JSON.parse(data);
                    console.log(output)
                    var len = output.length;
                    $("#Employee"+empCount).empty();
                    $("#Employee"+empCount).append("<option value=''>Select Employee</option>");
                    for( var i = 0; i<len; i++){
                        var id = output[i]['id'];
                        var name = output[i]['name'];
                        $("#Employee"+empCount).append("<option value='"+id+"'>"+name+"</option>");
                    }
                }
            });
        }

    }

    return {
        init: function () {
            handleList();
        },
        add:function(){
          addTraining();  
        },
    }
}();