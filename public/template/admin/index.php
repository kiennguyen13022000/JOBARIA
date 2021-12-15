<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $this->title; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php echo $this->linkCss; ?>

</head>

<body class="loading" data-layout='{"sidebar": { "color": "dark"}}'>
<!-- =============== header ====================-->
<?php include_once 'block/header.php'?>
<!-- =============== end header ====================-->

<!-- ========== Left Sidebar Start ========== -->
<?php include_once 'block/nav.php'?>
<!-- =============== end Left Sidebar Start ====================-->

<!-- Start Page Content here -->
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
<!--                                <li class="breadcrumb-item"><a href="javascript: void(0);">user</a></li>-->
<!--                                <li class="breadcrumb-item active">adduser</li>-->
                            </ol>
                        </div>
                        <h4 class="page-title">Add user</h4>
                    </div>
                </div>
            </div>
            <!-- start page title -->
        </div>

        <!-- content -->

     <?php require_once APPLICATION_PATH . 'admin' . DS . 'views' . DS . $this->_fileView . '.php'; ?>


    </div>
</div>
<!-- Left Sidebar End -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<!-- Footer Start -->
<?php include_once 'block/footer.php'?>
<!-- end Footer -->
<?php echo $this->linkJs; ?>
<script>
    let options = {
        position: 'top-right',
        animationDuration: 300
    };
    let success = <?php echo Session::get("success", '\'' . 'default' . '\'' ); Session::delete('success');?>;
     let msg = '';
    if(success == 'add'){
        let notifier = new AWN(options);
        msg = 'Add successful';
        notifier.success(msg, {durations: {success: 2000}});
    }else if (success == 'delete'){
        options.labels = {
            confirm: "Remove notifications",
        }
        let notifier = new AWN(options);
        msg = 'Delete successful';
        notifier.success(msg, {durations: {success: 2000}});
    }
    else if (success == 'edit'){
        msg = 'Update successful';
        let notifier = new AWN(options);
        notifier.success(msg, {durations: {success: 2000}});
    }



</script>
</body>

</html>