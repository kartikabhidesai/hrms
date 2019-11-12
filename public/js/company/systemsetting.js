var SysSetting = function () {
   
    var addSetting = function(){
        
        $('body').on('click', '.deleteimage', function() {
            // $('#deleteModel').modal('show');
            var id = $(this).data('id');
            var image = $(this).data('image');
            setTimeout(function() {
                $('.yes-sure-image:visible').attr('data-id', id);
                $('.yes-sure-image:visible').attr('data-image', image);
            }, 500);
        })

        $('body').on('click', '.yes-sure-image', function() {
            var id = $(this).attr('data-id');
            var image = $(this).attr('data-image');
            var data = {image:image,id: id, _token: $('#_token').val()};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "company/systemseting-ajaxAction",
                data: {'action': 'deleteImage', 'data': data},
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });
        
        
        var form = $('#systemSettingForm');
        var rules = {
            system_name: {required: true},
            system_title: {required: true},
            address: {required: true},
            phone_number: {required: true,digits: true},
            email: {required: true,email:true},
            language: {required: true},
            phone: {required: true,number:true}
            // image: {required: true},
        };

        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return {
        init: function () {
            addSetting();
        },
    }
}();