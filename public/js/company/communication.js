var Communication = function () {

    var send_sms = function () {
        $('.chat-user').on("click", function () {
            console.log($(this).attr("data-id"));
        });
        $('.summernote').summernote();

    }
    return {
        init: function () {
            send_sms();
        }
    }
}();