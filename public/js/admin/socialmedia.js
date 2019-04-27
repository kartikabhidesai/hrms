var Socialmedia = function() {
    var handleList = function(){

        $('body').on('click', '.SocialMediaDelete', function() {
            
            // $('#deleteModel').modal('show');
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        });

        $('body').on('click', '.yes-sure', function() {         
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/socialMedia-ajaxAction",
                data: {'action': 'deleteSocialMedia', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });

        var form = $('#socialMedia');
        var rules = {
          message: {required: true},
          post_to: {required: true},
          delivery_option: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });

        $('#delivery_date').datepicker();
        $('#delivery_time').timepicker({
            'showDuration': true,
            'timeFormat': 'H:i:s'
        });  

        var dataArr = {};
        var columnWidth = {"width": "40%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables-social-media',
            'ajaxURL': baseurl + "admin/socialMedia-ajaxAction",
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

        $('body').on('change', '.delivery_option', function() {
            var data = $(this).val();
            if (data == 'post_now')
            {
                $('#delivery_date,#delivery_time').removeAttr('required');
                $('#delivery_date,#delivery_time').valid();
                $('#delivery_date,#delivery_time').attr('disabled','disabled');
            }
            else if(data == 'post_later')
            {
                $('#delivery_date,#delivery_time').attr('required','required');
                $('#delivery_date,#delivery_time').valid();
                $('#delivery_date,#delivery_time').removeAttr('disabled');
                $('#delivery_date').datepicker();
                $('#delivery_time').timepicker({
                    'showDuration': true,
                    'timeFormat': 'H:i:s'
                });
            }

        });   
        
    }
    
    var handleAccount = function(){
        
    }
    
    var handlePost = function(){
       
    }
    return {
        init: function() {
            handleList();
        },
        manageAccounts: function() {
            handleAccount();
        },
        newPost:function(){
            handlePost();
        }
    }
}();