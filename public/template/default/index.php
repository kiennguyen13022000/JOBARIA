<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobaria</title>
    <link rel="icon" type="image/png" href="/public/template/default/assets/images/favicon.ico" />
    <link rel="stylesheet" href="/public/template/default/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/template/default/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/public/template/default/assets/fonts/css/all.min.css">
    <link rel="stylesheet" href="/public/template/default/assets/css/animate.min.css">
    <link rel="stylesheet" href="/public/template/default/assets/fonts/boxicons/boxicons-2.0.9/css/boxicons.min.css">
    <link rel="stylesheet" href="/public/template/default/assets/css/select2.min.css">
    <link rel="stylesheet" href="/public/template/default/assets/css/splide-core.min.css">
    <link rel="stylesheet" href="/public/template/default/assets/css/jquery-confirm.css">
    <link rel="stylesheet" href="/public/template/default/assets/css/splide-core.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.css" integrity="sha512-/lf2y2d7SFJau+G4TGgXCWJOAUxyDmJD+Tb35CdqoMZAQ8eNX0sgDKISlcxCtGpEAuyb1Q5vGPfB1XMettf0FA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/default-skin/default-skin.min.css" integrity="sha512-Rck8F2HFBjAQpszOB9Qy+NVLeIy4vUOMB7xrp46edxB3KXs2RxXRguHfrJqNK+vJ+CkfvcGqAKMJTyWYBiBsGA==" crossorigin="anonymous"
          referrerpolicy="no-referrer">
    <link rel="stylesheet" href="/public/template/default/assets/css/main.css">
    <link rel="stylesheet" href="/public/template/default/assets/css/account.css">
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="/public/template/default/assets/js/function.js"></script>
</head>
<body>

<!-- -----------------header --------------------------->
    <?php include_once 'block/header.php'; ?>
<!-- -----------------end header --------------------------->

<!-- -----------------main --------------------------->
<?php include_once APPLICATION_PATH . 'default/views/' . $this->_fileView . '.php'; ?>
<!-- -----------------end main --------------------------->

<!-- -----------------footer --------------------------->
<?php include_once 'block/footer.php'; ?>
<!-- -----------------end footer --------------------------->

<!-- ----------------- modal --------------------------->
<div class="hereModal"></div>
<?php //include_once 'block/modal.php'; ?>
<!-- -----------------end modal --------------------------->

<script src="/public/template/default/assets/js/jquery-3.3.1.min.js"></script>
<script src="/public/template/default/assets/js/popper.min.js"></script>
<script src="/public/template/default/assets/js/bootstrap.min.js"></script>
<script src="/public/template/default/assets/js/owl.carousel.min.js"></script>
<script src="/public/template/default/assets/js/wow.min.js"></script>
<script src="/public/template/default/assets/js/select2.min.js"></script>
<script src="/public/template/default/assets/js/jquery-confirm.js"></script>
<script src="/public/template/default/assets/js/splide.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.min.js" integrity="sha512-2R4VJGamBudpzC1NTaSkusXP7QkiUYvEKhpJAxeVCqLDsgW4OqtzorZGpulE3eEA7p++U0ZYmqBwO3m+R2hRjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe-ui-default.min.js" integrity="sha512-SxO0cwfxj/QhgX1SgpmUr0U2l5304ezGVhc0AO2YwOQ/C8O67ynyTorMKGjVv1fJnPQgjdxRz6x70MY9r0sKtQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/public/template/default/assets/js/main.js"></script>
<script>
    let options = {
        position: 'top-right',
        animationDuration: 300
    };
    let success = <?php echo Session::get("success", '\'' . 'default' . '\'' ); Session::delete('success');?>;
    let msg = '';
    if (success == 'edit'){
        msg = 'Update successful';
        let notifier = new AWN(options);
        notifier.success(msg, {durations: {success: 2000}});
    }
</script>
</body>

</html>
