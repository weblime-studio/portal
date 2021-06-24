jQuery(document).ready(function() {
    $('.tab-item.tab-btn').on('click', function() {
        var index = $(this).index();
        index--;
        $('.tab-item.tab-btn').removeClass('active');
        $(this).addClass('active');

        $('.article-detail .tab-content .content-item').removeClass('active');
        $('.article-detail .tab-content .content-item').eq(index).addClass('active');

    })

    $('.fancybox').fancybox();

    $('.get-course-button').on('click', function() {
        var name = $(this).attr('attr-course-name');
        $('#get-course-access h3 > span').text(name);
        $('#get-course-access input[name="course-id"]').val($(this).attr('attr-course-id'));
    })


    $('.header .scroll').on('click', function(e) {
        e.preventDefault();
        var scroll = $(this).attr('attr-scrol-to');
        $.scrollTo(scroll, 1000, {axis:'y', offset: 0})
    })


    $('.accordion .inside .item .table-title').on('click', function() {
        if($(this).parent().find('.body').is(':visible')) {
            $('.accordion .inside .item').removeClass('active');
            $('.accordion .inside .item .body').slideUp();
        } else {
            $('.accordion .inside .item').removeClass('active');
            $('.accordion .inside .item .body').slideUp();
            
            $(this).parent().addClass('active');
            $(this).parent().find('.body').slideDown();
        }
    })

    $('#get-course-access .button button').on('click', function() {
        var courseId = $('.get-course-access-form input[name="course-id"]').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.fancybox.close();
        $.ajax({
            type: "POST",                  
            url: "/request",
            data: "course_id=" + courseId,
            success: function(data){
                $('.click-request-sent').click();
            }
        });        
    })
    



    $('.widget.course-participants ul li a.fancybox').on('click', function() {
        var userId = $(this).attr('attr-user-id');
        var userAvatar = $(this).attr('attr-user-avatar');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",                  
            url: "/getmessage",
            data: "user_id=" + userId,
            success: function(data){
                $('.chat-popup-window .direct-chat-messages').html(data);
            }
        }); 



        $('.chatform input[name="userid"]').val(userId);
        $('.chatform input[name="useravatar"]').val(userAvatar);
    })

})