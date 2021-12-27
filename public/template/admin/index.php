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

<body class="loading left-side-menu-dark topbar-light"  >
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo ucfirst($this->control); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo $this->title; ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?php echo $this->title; ?></h4>
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

<script src="public/template/admin/js/jquery.bootstrap.wizard.min.js"></script>
<script src="public/template/admin/js/tinymce.min.js"></script>
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

    var userId = <?php echo Session::get('userAdmin')['user_id']; ?>;
    localStorage.setItem('userId', userId);

    // Pusher.logToConsole = true;

    var pusher = new Pusher('f0da0738e29f80193f63', {
        cluster: 'ap1',
        authEndpoint: '/index.php?module=admin&controller=chat&action=auth'
    });

    var channel = pusher.subscribe('private-message-'+ userId +'-channel');
    channel.bind('message-event', function(data) {
        var message = renderInboxDetail(data, 'odd');
        $('.conversation-list').append(message);
        var d = $('.conversation-list');
        $('.slimScrollBar').css({ top: d.prop("scrollHeight")});
    });
</script>
</body>

</html>