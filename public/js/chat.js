window.onload = function(){
    //var socket = new WebSocket('ws://echo.websocket.org');
    var socket = new WebSocket('ws://localhost:8080');
    var status = document.getElementById('status');
    socket.onopen = function(event){        
        status.innerHTML = 'connected';        
    };
    socket.onclose = function(event){
        if( event.wasClean ){
            status.innerHTML = 'closed';
        }else{
            status.innerHTML = 'closed some';
        }
    };
    socket.onmessage = function(event) {
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
    
    
    document.forms['chatform'].onsubmit = function(){

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
    }
    //return false;
};

