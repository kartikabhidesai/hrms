var Notification = function () {
    
    var handleList = function () {
        var form = $('#taxId');
        var rules = {
          amount: {required: true,number:true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
        var columnWidth = {"width": "10%", "targets": 0};

            var arrList = {
                'tableID': '#notificationTable',
                'ajaxURL': baseurl + "company/notification-ajaxAction",
                'ajaxAction': 'getdatatable',
                'postData': [],
                'hideColumnList': [],
                'noSearchApply': [0],
                'noSortingApply': [],
                'defaultSortColumn': 0,
                'defaultSortOrder': 'desc',
                'setColumnWidth': columnWidth
            };
            getDataTable(arrList);
            
            new DG.OnOffSwitchAuto({
                cls:'.custom-switch',
                textOn:"YES",
                height:35,
                textOff:"NO",
                textSizeRatio:0.35,
                listener:function(name, checked){
                    if(checked==true)
                    {
                        var id =name;
                        var data = {id: id,status:1};
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                            },
                            url: baseurl + "company/notification-ajaxAction",
                            data: {'action': 'onOffNotification', 'data': data},
                            success: function(data) {
                                handleAjaxResponse(data);
                            }
                        });
                    }else{
                        var id =name;
                        var data = {id: id,status:0};
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                            },
                            url: baseurl + "company/notification-ajaxAction",
                            data: {'action': 'onOffNotification', 'data': data},
                            success: function(data) {
                                handleAjaxResponse(data);
                            }
                        });
                    }
                    // document.getElementById("listener-text-table").innerHTML = "Switch " + name + " changed value to " + checked;
                }
            });
            
            $('body').on('click', '.sentNoti', function() {
                if(this.checked) {
                    var checkBox = '1';
                }else{
                    var checkBox = '0';
                }
                var userNotificationId = $(this).data("id") ;
                var notificationValue = $(this).data("value") ;
                var data = {checkBox: checkBox,notificationValue:notificationValue,userNotificationId:userNotificationId, _token: $('#_token').val()};
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "company/notification-ajaxAction",
                    data: {'action': 'setNotification', 'data': data},
                    success: function(data) {
                        handleAjaxResponse(data);
                    }
                });
//                alert(userNotificationId);
            });
            

            $('body').on('click', '.deleteNotification', function() {
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
                    url: baseurl + "company/notification-ajaxAction",
                    data: {'action': 'deleteNotification', 'data': data},
                    success: function(data) {
                        handleAjaxResponse(data);
                    }
                });
            });

            

    }
    return {
        init: function () {
            handleList();
        }
    }
}();