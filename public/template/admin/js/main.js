$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$('#validationAvatar').change(function(){
    let img = $('.preview__avatar')[0];
    img.src = URL.createObjectURL(this.files[0]);
    img.width = 100;
    img.height = 130;
    $('.preview__avatar').addClass('border rounded mt-2');
});
$('#validationImage').change(function(){
    let img = $('.preview__avatar')[0];
    img.src = URL.createObjectURL(this.files[0]);
    img.width = 100;
    img.height = 130;
    $('.preview__avatar').addClass('border rounded mt-2');
});
$(function () {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    $('.input__image').change(function(){
        let img = $('.preview__image')[0];
        img.src = URL.createObjectURL(this.files[0]);
        img.width = 120;
        img.height = 120;
        $('.preview__image').addClass('border rounded mt-2');
    });

})

function deleteItem(id, controller){
    let options = {
        position: 'top-right',
        animationDuration: 300
    };
    options.labels = {
        confirm: 'Remove notifications'
    }
    let notifier = new AWN(options);
    let onOk = () => {
        $.post('index.php?module=admin&controller='+ controller +'&action=delete', {id: id}, function (data){
            if (data.affected > 0){
                 location.reload();
            }else{
                options.labels = {
                    warning: 'Error',
                }
                let notifier = new AWN(options);
                notifier.warning('An error occurred!', {durations: {warning: 2000}})
            }
        }, 'json');
    };
    notifier.confirm('Ban co chac muon xoa khong?', onOk);
}
function moveNode(type, id){
    var data = {type: type, id: id};
    $('#datatable').load('index.php?module=admin&controller=category&action=moveNode', data);

}

$('.status__item').click(function (){
    var id = $(this).attr('data-id');
    var status = $(this).attr('data-status');
    var control = $(this).attr('data-control');
    var url = 'index.php?module=admin&controller=' + control + '&action=changeStatus';
    var dataPost = {id: id, status: status};
    var obj = this;
    $.post(url, dataPost, function (data){
        if (data.affected > 0){
            $(obj).attr('data-status', data.status);
            if(data.status == 1){
                $(obj).text('Active');
                $(obj).addClass('activeStatus').removeClass('deactive');
            }else{
                $(obj).text('Deactive');
                $(obj).addClass('deactive').removeClass('activeStatus');
            }
        }

    }, 'json');
});
$('.is__admin__item').click(function (){
    var id = $(this).attr('data-id');
    var isAdmin = $(this).attr('data-admin');
    var control = $(this).attr('data-control');
    var url = 'index.php?module=admin&controller=' + control + '&action=changeIsAdmin';
    var dataPost = {id: id, isAdmin: isAdmin};
    var obj = this;
    $.post(url, dataPost, function (data){
        if (data.affected > 0){
            $(obj).attr('data-admin', data.isAdmin);
            if(data.isAdmin == 1){
                $(obj).text('Active');
                $(obj).addClass('activeAdmin').removeClass('deactive');
            }else{
                $(obj).text('Deactive');
                $(obj).addClass('deactive').removeClass('activeAdmin');
            }
        }

    }, 'json');
});

