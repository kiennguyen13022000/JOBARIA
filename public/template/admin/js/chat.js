$(document).ready(function() {
    $("#emoji").emojioneArea({
        pickerPosition: "top",
        filtersPosition: "bottom",
    });

    $('.chat-send-my').click(function (){
        var message = $("#emoji")[0].emojioneArea.getText();
        var url = '/index.php?module=admin&controller=chat&action=message';
        var data = {message: message};
        $.post(url, data, function (data){
            $("#emoji")[0].emojioneArea.setText('');
            localStorage.setItem('userCurrent', data.user_id);
            $('.chat-empty').remove();
        }, 'json');

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


    registerChatItem();
});

function registerChatItem(){
    $('.user-search-item').click(function (){
        var idChat = $(this).attr('data-id');
        $('.wrapper-user-search').remove();
        var url = '/index.php?module=admin&controller=chat&action=infoChatItem';
        $.get(url, {id: idChat}, function (data){
            var html = renderInboxItem(data.infoChatItem, data.chatDetail);
            $('.inbox-widget').prepend(html);
            if (data.chatDetail.length == 0){
                $('.conversation-list').empty().prepend('<p class="chat-empty">Bắt đầu trò chuyện ngay nào</p>');
            }

        }, 'json')
    });
}
function renderInboxItem(infoChatItem, chatDetail){
    var avatar = infoChatItem.avatar == '' ? '/public/template/admin/images/users/avatar-1.jpg' : infoChatItem.avatar;
    var fullname = infoChatItem.firstname + ' ' + infoChatItem.lastname;
    var len = chatDetail.length;
    var contentChat = len == 0 ? 'Bắt đầu trò chuyện ngay nào' : chatDetail[len - 1].content;
    var created_at = '';
    var html = '<div class="inbox-item">\n' +
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
    var html = '<li class="clearfix '+ type +'">\n' +
'                    <div class="chat-avatar">\n' +
'                        <img src="'+ data.image +'">\n' +
'                        <i>10:01</i>\n' +
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

// Pusher.logToConsole = true;

var pusher = new Pusher('f0da0738e29f80193f63', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('message-channel');
channel.bind('message-event', function(data) {
    var  userCurrent = localStorage.getItem('userCurrent');
    var type = userCurrent == data.user_id ? '' : 'odd';
    var message = renderInboxDetail(data, type);
    $('.conversation-list').append(message);
});