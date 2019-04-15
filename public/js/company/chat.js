$(document).ready(function(){
    fetch_user();
    function fetch_user() {
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            url: "chat-ajaxAction",
            data: {'action': 'fetch_user'},
            success: function(data) {
                if(data){
                    $('.chat-user').html(data);
                }
            },
            error: function(err) {
                //alert("error"+JSON.stringify(err));
            }
        });
    } 
});

