function delItem(id){
    let notifier = new AWN(options);
    let onOk = () => {
        $.post('index.php?module=admin&controller=product&action=delete', {id: id}, function (data){
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