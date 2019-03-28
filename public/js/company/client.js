var Client = function () {

    var handleList = function () {

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#ClientDatatables',
            'ajaxURL': baseurl + "company/client-ajaxAction",
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

        $('body').on('click', '.clientDelete', function () {
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
                url: baseurl + "company/client-ajaxAction",
                data: {'action': 'deleteClient', 'data': data},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });


    }

    var addClient = function () {
        dateFormate('#date_of_joining');
        var form = $('#addClient');
        var rules = {
            name: {required: true},
            nation_id: {required: true},
            phone_number: {required: true},
            work: {required: true},
            mobile_number: {required: true},
            comapany: {required: true},
            email: {required: true,email:true},
            date_of_joining: {required: true},
            street: {required: true},
            bank: {required: true},
            iban: {required: true},
            account_number: {required: true},
            country: {required: true},
            zipcode: {required: true},
            state: {required: true},
            city: {required: true},
            
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
            addClient();
        },
    }
}();