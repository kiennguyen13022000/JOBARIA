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

$('.input__image').change(function(){
    let img = $('.preview__image')[0];
    img.src = URL.createObjectURL(this.files[0]);
    img.width = 100;
    img.height = 130;
    $('.preview__image').addClass('border rounded mt-2');
});


function deleteItem(id){
    let notifier = new AWN(options);
    let onOk = () => {
        $.post('index.php?module=admin&controller=user&action=delete', {id: id}, function (data){
            if (data.affected > 0){
                location.reload();
            }
        }, 'json');
    };
    notifier.confirm('Ban co chac muon xoa khong?', onOk);


}


