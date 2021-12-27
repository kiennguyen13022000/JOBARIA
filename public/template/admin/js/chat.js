$(document).ready(function() {
    $("#emoji").emojioneArea({
        pickerPosition: "top",
        filtersPosition: "bottom",
    });

    $('.chat-send-my').click(function (){
        var message = $("#emoji")[0].emojioneArea.getText();
        if (message == ""){
            alert('Bạn chưa nhập nội dung tin nhắn');
        }else{
            var url = '/index.php?module=admin&controller=chat&action=message';
            var data = {message: message};
            $.post(url, data, function (data2){
                $("#emoji")[0].emojioneArea.setText('');
                var inboxDetail = renderInboxDetail(data2.message, '');
                $('.conversation-list').append(inboxDetail);
                var d = $('.conversation-list');
                $('.slimScrollBar').css({ top: d.prop("scrollHeight")});
                $('.chat-empty').remove();
            }, 'json');
        }
    });

    $('.input-inbox-search-user').keyup(function (){
        var val   = $(this).val();
        var url   = '/index.php?module=admin&controller=chat&action=userSearch';
        var data  = {keyword: val};
        setTimeout(function (){
            $('.user-search').load(url, data, function (){
                registerChatItem();
            });
        }, 500);
    });

    $('.inbox-item').click(function (){
        $('.inbox-item').removeClass('user-inbox-active');
        $(this).addClass('user-inbox-active');
        var url = '/index.php?module=admin&controller=chat&action=inboxDetail';
        var userId = $(this).attr('data-user_id');
        var data = {user_id: userId};
        $('.conversation-list').load(url, data);
        var d = $('.conversation-list');
        $('.slimScrollBar').css({ top: d.prop("scrollHeight")});
    });

    var d = $('.conversation-list');
    $('.slimScrollBar').css({ top: d.prop("scrollHeight")});


});

function registerChatItem(){
    $('.user-search-item').click(function (){
        var idChat = $(this).attr('data-id');

        $('.wrapper-user-search').remove();
        var userInbox = $("[data-user_id='"+idChat+"']");
        var iduserInbox = userInbox.attr('data-user_id');

        $('.inbox-item').removeClass('user-inbox-active');
        if (parseInt(iduserInbox) > 0){
            userInbox.addClass('user-inbox-active');
            var url = '/index.php?module=admin&controller=chat&action=inboxDetail';
            var data = {user_id: iduserInbox};
            $('.conversation-list').load(url, data);
        }else{
            var url = '/index.php?module=admin&controller=chat&action=infoChatItem';
            $.get(url, {id: idChat}, function (data){
                var html = renderInboxItem(data.infoChatItem, data.chatDetail, idChat);
                $('.inbox-widget').prepend(html);
                if (data.chatDetail.length == 0){
                    $('.conversation-list').empty().prepend('<p class="chat-empty">Bắt đầu trò chuyện ngay nào</p>');
                    $('.inbox-item').click(function (){
                        $('.inbox-item').removeClass('user-inbox-active');
                        $(this).addClass('user-inbox-active');
                        var url = '/index.php?module=admin&controller=chat&action=inboxDetail';
                        var userId = $(this).attr('data-user_id');
                        var data = {user_id: userId};
                        $('.conversation-list').load(url, data);
                    });
                }
            }, 'json')
        }

    });
}

function renderInboxItem(infoChatItem, chatDetail, idChat){
    var avatar = infoChatItem.avatar == '' ? '/public/template/admin/images/users/avatar-1.jpg' : infoChatItem.avatar;
    var fullname = infoChatItem.firstname + ' ' + infoChatItem.lastname;
    var len = chatDetail.length;
    var contentChat = len == 0 ? 'Bắt đầu trò chuyện ngay nào' : chatDetail[len - 1].content;
    var created_at = '';
    var html = '<div class="inbox-item user-inbox-active" data-user_id="'+ idChat +'">\n' +
'                   <a href="#">\n' +
'                      <div class="inbox-item-img"><img src="'+ avatar +'" class="rounded-circle" alt=""></div>\n' +
'                        <p class="inbox-item-author">'+ fullname +'</p>\n' +
        '                <p class="inbox-item-text">'+ contentChat+'</p>\n' +
    '                    <p class="inbox-item-date">'+ created_at +'</p>\n' +
'                   </a>\n' +
'               </div>';

    return html;
}

function renderInboxDetail(data, type){
    var avatar = data.image == '' ? '/public/template/admin/images/users/avatar-1.jpg' : data.image;
    var html = '<li class="clearfix '+ type +'">\n' +
'                    <div class="chat-avatar">\n' +
'                        <img src="'+ avatar +'">\n' +
'                        <i>'+ data.created_at +'</i>\n' +
'                    </div>\n' +
'                    <div class="conversation-text">\n' +
'                        <div class="ctext-wrap">\n' +
'                            <i>'+ data.fullname +'</i>\n' +
'                            <p>\n' +
'                                '+ data.content +'\n' +
'                            </p>\n' +
'                        </div>\n' +
'                    </div>\n' +
'               </li>';

    return html;
}

