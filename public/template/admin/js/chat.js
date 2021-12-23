$(document).ready(function() {
    $("#emoji").emojioneArea({
        pickerPosition: "top",
        filtersPosition: "bottom",
    });

    $('.chat-send').click(function (){
        var emoji = $("#emoji")[0].emojioneArea.getText();
        $("#emoji")[0].emojioneArea.setText('');
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

    // <div className="inbox-item">
    //     <a href="#">
    //         <div className="inbox-item-img"><img src="/public/template/admin\images\users\avatar-1.jpg"
    //                                              className="rounded-circle" alt=""></div>
    //         <p className="inbox-item-author">Chadengle</p>
    //         <p className="inbox-item-text">Hey! there I'm available...</p>
    //         <p className="inbox-item-date">13:40 PM</p>
    //     </a>
    // </div>
});

function registerChatItem(){
    $('.user-search-item').click(function (){
        var idChat = $(this).attr('data-id');
        $('.wrapper-user-search').remove();
        var url = '/index.php?module=admin&controller=chat&action=infoChatItem';
        $.get(url, {id: idChat}, function (data){
            var html = renderInboxItem(data);
            $('.inbox-widget').prepend(html);
        }, 'json')
    });
}
function renderInboxItem(data){
    var avatar = data.avatar == '' ? '/public/template/admin/images/users/avatar-1.jpg' : data.avatar;
    var fullname = data.firstname + ' ' + data.lastname;
    var content = '';
    var created_at = '';
    var html = '<div class="inbox-item">\n' +
'                   <a href="#">\n' +
'                      <div class="inbox-item-img"><img src="'+ avatar +'" class="rounded-circle" alt=""></div>\n' +
'                        <p class="inbox-item-author">'+ fullname +'</p>\n' +
        '                <p class="inbox-item-text">'+ content+'</p>\n' +
    '                    <p class="inbox-item-date">'+ created_at +'</p>\n' +
'                   </a>\n' +
'               </div>';

    return html;
}

