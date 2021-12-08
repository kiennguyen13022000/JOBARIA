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


function deleteItem(id){
    $('#row-' + id).hide(600).remove();
    $("#scroll-horizontal-datatable").load(" #scroll-horizontal-datatable > *");
    $.post('index.php?module=admin&controller=user&action=delete', {id: id}, function (){

    });
}


