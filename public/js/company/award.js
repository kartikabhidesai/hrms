var Award = function () {

    var handleList = function () {

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#AwardDatatables',
            'ajaxURL': baseurl + "company/award-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [1],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $('body').on('click', '.awardDelete', function () {
            var id = $(this).data('id');
            
            setTimeout(function () {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function () {
            var id = $(this).attr('data-id');

            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/award-ajaxAction",
                data: {'action': 'deleteAward', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on('click', '.awardDetails', function () {
            var data = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/award-ajaxAction",
                data: {'action': 'awardDetails', 'data': data},
                success: function(data) {
                    var  output = JSON.parse(data);
                    console.log(output);
                    if(output.emp_name === null) {
                        $('.employee').hide();
                    } else {
                        $('.employee').show();
                        $('.employee').html(output.emp_name);
                    }
                    if(output.dept_name === null) {
                        $('.department').hide();
                    } else {
                        $('.department').html(output.dept_name);
                    }
                    if(output.award === null) {
                        $('.award').hide();
                    } else {
                        $('.award').html(output.award);
                    }
                    if(output.date === null) {
                        $('.date').hide();
                    } else {
                        $('.date').html(output.date);
                    }
                    if(output.comment === null) {
                        $('.comment').hide();
                    } else {
                        $('.comment').html(output.comment);
                    }
                    if(output.file_attachment == '') {
                        $('.file_attachment').html('No attachment found.');
                    } else {
                        $('.file_attachment').html( '<a href="download-award-attachment/'+output.file_attachment+'" class="link-black text-sm" data-toggle="tooltip" data-original-title="Download">'+output.file_attachment+'</a>');
                    }
                }
            });
        });
    }

    var addAward = function () {
        dateFormate('.start_date');
        $('[data-toggle="tooltip"]').tooltip();

        $('#datetimepicker .time').timepicker({
            'showDuration': true,
            'timeFormat': 'g:ia'
        });

        var form = $('#addAward');
        var rules = {
            title: {required: true},
            status: {required: true},
            content: {required: true},
            start_date: {required: true},
            time: {required: true},

        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form, true);
        });




    }

    return {
        init: function () {
            handleList();
        },
        add: function () {
            addAward();
        },
    }
}();