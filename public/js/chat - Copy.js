window.onload = function(){
    
    

    //$('.chat-popup-window .input-group-append')
    /*socket.onmessage = function(event) {
        let formData = JSON.parse(event.data);
        let username = formData.username;
        let userid = formData.userid;

        let message = formData.message;
        

        if(message != "") {
            var myuserid = $('form[name="chatform"] input[name="myuserid"]').val();

            var messFrom;
            var avatar = $('form[name="chatform"] input[name="myavatar"]').val();
            
            if( userid == myuserid ) {
                messFrom = 'right';
                avatar = $('form[name="chatform"] input[name="useravatar"]').val();
            }
            
            $('form[name="chatform"] input[name="message"]').val('');

            var date = new Date();
            var month = new Array('Січ','Лют','Бер','Кві','Тра','Чер','Лип','Сер','Вер','Жов','Лис','Гру');
            

            var my = '<div class="direct-chat-msg ' + messFrom + '"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">' + username + '</span> <span class="direct-chat-timestamp float-right">' + date.getDay() + ' ' + month[date.getMonth()] + ' ' + date.getHours() + ':' + date.getMinutes() + '</span></div><img class="direct-chat-img" src="' + avatar + '"><div class="direct-chat-text">' + message + '</div></div>';

            $('.direct-chat-messages').append(my);
        } else {
            return;
        }
    };
    
    
    socket.onerror = function(event){
        status.innerHTML = 'error ' + event.message;
    };
    */
    
    $('.chatform button .input-group-append').on('click', function() {
        var username = $(this).closest('.chatform').find('input[name="username"]').val();
        var userid = $(this).closest('.chatform').find('input[name="userid"]').val();
        var message = $(this).closest('.chatform').find('input[name="message"]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",                  
            url: "/setmessage",
            data: "username=" + username + "&userid=" + userid + "&message=" + message,
            success: function(data){ }
        });

    })
    
    /*= function(){
alert()
        if(this.message.value != "") {
            let message = {
                username: this.username.value,
                userid: this.userid.value,
                message: this.message.value
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",                  
                url: "/setmessage",
                data: "username=" + message.username + "&userid=" + message.userid + "&message=" + message.message,
                success: function(data){ }
            });

            socket.send(JSON.stringify(message));
            
            return false;
        }
    }*/
    //return false;
};

