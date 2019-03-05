var Notification = function () {
    
    var handleList = function () {
        var form = $('#taxId');
        var rules = {
          // emp_id: {required: true},
          amount: {required: true,number:true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });


          $('.dataTables-example').DataTable({
                pageLength:10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    // { extend: 'copy'},
                    // {extend: 'csv'},
                    // {extend: 'excel', title: 'ExampleFile'},
                    // {extend: 'pdf', title: 'ExampleFile'},

                    // {extend: 'print',
                    //  customize: function (win){
                    //         $(win.document.body).addClass('white-bg');
                    //         $(win.document.body).css('font-size', '10px');

                    //         $(win.document.body).find('table')
                    //                 .addClass('compact')
                    //                 .css('font-size', 'inherit');
                    // }
                    // }
                ]

            });

    }
    return {
        init: function () {
            handleList();
        }
    }
}();