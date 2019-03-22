var Dashboard = function () {

    var handleList = function () {
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#dataTables_emp_announcement',
            'ajaxURL': baseurl + "employee/employee-dashbord-ajaxAction",
            'ajaxAction': 'getdatatableofempdashbord',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [3],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $('body').on('click', '.announcementDetails', function () {
            var id = $(this).attr('data-id');
            var data = {id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "employee/employee-dashbord-ajaxAction",
                data: {'action': 'modalDetails', 'data': data},
                success: function (data) {
                    var obj = jQuery.parseJSON(data);
                    console.log(obj);
                    $('.content').text(obj.content);
                    $('.created_at').text(obj.created_at);
                    $('.status').text(obj.status);
                    $('.title').text(obj.title);
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