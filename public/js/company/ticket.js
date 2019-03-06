var Ticket = function() {
    var handleList = function() {
       
       $('body').on('click', '.deleteTicket', function() {
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
                url: baseurl + "company/ticket-ajaxAction",
                data: {'action': 'deleteTicket', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });

       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
            var arrList = {
            'tableID': '#TicketDatatables',
            'ajaxURL': baseurl + "company/ticket-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [0],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    };
    
    var addlist = function() {
        
        var form = $('#ticket-add');
        var rules = {
            ticket_name: {required: true},
            designation: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
        $('body').on('click','.add_designation',function(){
            var button='<div class="form-group removediv">'+
                            '<label class="col-lg-2 control-label"></label>'+
                                '<div class="col-lg-8">'+
                                    '<input type="file" name="ticket_attachment[]" class="form-control" placeholder="Add more Attachment" required>'+
                                '</div>'+
                                '<div class="col-lg-2">'+
                                    '<input type="button" class="red form-control removebtn" value="Remove">'+
                                '</div>'+
                            '</div>';
            $('.add_designation_div').prepend(button);
        });
        
        $('body').on('click','.removebtn',function(){
            $(this).closest('.removediv').remove();
        });
    };

    var editlist = function() {
        var form = $('#ticket-edit');
        var rules = {
            ticket_name: {required: true},
            designation: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
        $('body').on('click','.add_designation',function(){
            var button='<div class="form-group removediv">'+
                            '<label class="col-lg-2 control-label"></label>'+
                                '<div class="col-lg-8">'+
                                    '<input type="file" name="ticket_attachment[]" class="form-control" placeholder="Add more Attachment" required>'+
                                '</div>'+
                                '<div class="col-lg-2">'+
                                    '<input type="button" class="red form-control removebtn" value="Remove">'+
                                '</div>'+
                            '</div>';
            $('.add_designation_div').prepend(button);
        });
        
        $('body').on('click','.removebtn',function(){
            $(this).closest('.removediv').remove();
        });

        $('body').on('click','.editRemovebtn',function(){
            $(this).closest('.editRemovediv').remove();
        });
    };

    return {
        init: function() {
            handleList();
        },
        add :function(){
            addlist();
        },
        edit :function(){
            editlist();
        }
    }

}();