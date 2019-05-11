var CompanyReport = function () {
    
    var handleList = function () {
        $('body').on('click','.singlePdfDownload',function(){
            var companyId = $(this).attr('data-id');
            if(companyId != '') {
                $('.emparray').val(companyId);
                $('.downloadstatus').val('single');
                if(companyId > 0){
                    $('#pdfForm').submit()
                }
            }
        });
    }

    return {
        init: function () {
            handleList();
        },
    }
}();