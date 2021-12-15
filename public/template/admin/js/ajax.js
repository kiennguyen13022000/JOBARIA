function delItem(item){
    let notifier = new AWN(options);
    control = item.getAttribute('data-control');
    id = item.getAttribute('data-id');
    table = item.getAttribute('data-table');
    let onOk = () => {
        $.post('index.php?module=admin&controller='+control+'&action=delete', {id: id,table:table}, function (data){
            if(table == 'product_image'){
                item.closest('.nav-item').remove();
                return false;
            }
            if (data.affected > 0){
                location.reload();
            }
        }, 'json');
    };
    notifier.confirm('Are you wante to delete?', onOk);
}

$(document).on('change','.filePhotoImage',function(){
    var $_this = $(this);
    console.log($_this);
    $_this.closest("form").ajaxSubmit({
        type: "POST",
        url: 'index.php?module=admin&controller=product&action=addImage',
        dataType: "json",
        success: function(res) {
            if(res.msg=='error'){
                alert('Upload fail!');
                return false;
            }
            $_this.closest('.images_block').find('.product_images').append(res.html);
        }
    });
    return false;
});