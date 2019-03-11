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

        
        
    }

    var addTraining = function(){
        var empCount=1;
        addDepartment(empCount);
        getemployee(empCount);
        $('body').on('click', '.add-emp', function () {
            empCount++;
            addDepartment(empCount);
        });

        function addDepartment(eid)
        {
            $("#emp-info").append('<div class="row" id="employee'+eid+'">\
                <div class="col-lg-1"></div>\
                <div class="col-lg-3">\
                    <div class="form-group mr-1">\
                    <select id="Department'+eid+'" name="departmentid[]" onchange="getemployee('+eid+')" class="form-control"></select>\
                    </div>\
                </div>\
                <div class="col-lg-3">\
                    <div class="form-group mr-1">\
                    <select id="Employee'+eid+'"  name="employeeid[]" class="form-control"></select>\
                    </div>\
                </div>\
                <div class="col-lg-2" style="text-align: center;">\
                    <a class="btn btn-sm btn-danger" onclick="removeEmployee('+eid+')" ><i class="fa fa-minus"></i></a>\
                </div>\
                <div class="col-lg-2">\
                </div>\
            </div>');

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
                    var len = output.length;
                    $("#Employee"+empCount).empty();
                    $("#Employee"+empCount).append("<option value=''>Select Employee</option>");
                        
                        for( var i = 0; i<len; i++){
                            var id = output[i]['id'];
                            var name = output[i]['name'];
                            
                            $("#Employee").append("<option value='"+eid+"'>"+name+"</option>");

                        }
                }
            });
        }
        $("#empCount").on("change",  getemployee(eid));
        var form = $('#addTraining');
        var rules = {
            department: {required: true},
            assign_date: {required: true},
            task: {required: true},
            designation: {required: true},
            deadline_date: {required: true},
            priority: {required: true},
            about_task: {required: true}
        };

        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
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