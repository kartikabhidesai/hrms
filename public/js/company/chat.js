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
                    for(i = 0; i< data.length; i++){
                        $('.users-list').append("<div class='chat-user'><img class='chat-avatar' src='{{ url('img/a4.jpg') }}' alt=''><div class='chat-user-name'>"+data[i].name+"<a href='#'></a></div></div>");
                    }
                    
                }
            },
            error: function(err) {
                //alert("error"+JSON.stringify(err));
            }
        });
    } 
});

