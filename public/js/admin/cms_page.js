var Cms_page = function() {
    var handleList = function() {
     
        $('body').on('click', '.demoDelete', function() {
            // $('#deleteModel').modal('show');
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })
        $('body').on('click', '.cmsModel', function() {
           // $('#cmsModel').modal('show');
           var data = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/cmspage-ajaxAction",
                data: {'action': 'getCmsDetails', 'data': data},
                success: function(data) {
                   var  output = JSON.parse(data);
                   console.log(output.name)
                   $('.cmsName').html(output.name);
                   $('.description').html(output.description);
                }
            });

        });

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/demo-ajaxAction",
                data: {'action': 'deleteDemo', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
      
        var form = $('#editCms');
        var rules = {
            cms_content: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
        
       var dataArr = {};
       var columnWidth = {"width": "10%", "targets": 0};
       
        var arrList = {
            'tableID': '#dataTables-example',
            'ajaxURL': baseurl + "admin/cmspage-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [2],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
       
    }
    var summer = function() {
         $('.summernote').summernote();
    }

    summer

    return {
        init: function() {
            handleList();
        },init1: function() {
            summer();
        }
    }
}();