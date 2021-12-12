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

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="d-none d-sm-block">
                <form class="app-search">
                    <div class="app-search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn" type="submit">
                                    <i class="fe-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </li>


            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                                <span class="float-right">
                                <a href="" class="text-dark">
                                    <small>Clear All</small>
                                </a>
                            </span>Notification
                        </h5>
                    </div>

                    <div class="slimscroll noti-scroll">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon bg-soft-primary text-primary">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">Doug Dukes commented on Admin Dashboard
                                <small class="text-muted">1 min ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                <img src="public/template/admin/images/\users\avatar-2.jpg" class="img-fluid rounded-circle" alt=""> </div>
                            <p class="notify-details">Mario Drummond</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Hi, How are you? What about our next meeting</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                <img src="public/template/admin/images\users\avatar-4.jpg" class="img-fluid rounded-circle" alt=""> </div>
                            <p class="notify-details">Karen Robinson</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Wow ! this admin looks good and awesome design</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-soft-warning text-warning">
                                <i class="mdi mdi-account-plus"></i>
                            </div>
                            <p class="notify-details">New user registered.
                                <small class="text-muted">5 hours ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">Caleb Flakelar commented on Admin
                                <small class="text-muted">4 days ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-secondary">
                                <i class="mdi mdi-heart"></i>
                            </div>
                            <p class="notify-details">Carlos Crouch liked
                                <b>Admin</b>
                                <small class="text-muted">13 days ago</small>
                            </p>
                        </a>
                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        View all
                        <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="public/template/admin/images\users\avatar-1.jpg" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        Nik Patel <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="remixicon-account-circle-line"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="remixicon-settings-3-line"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="remixicon-wallet-line"></i>
                        <span>My Wallet <span class="badge badge-success float-right">3</span> </span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="remixicon-lock-line"></i>
                        <span>Lock Screen</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="remixicon-logout-box-line"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo text-center">
                    <span class="logo-lg">
                    <img src="public/template/admin/images/custom/logo/1.png" alt="" height="40">
                        <!-- <span class="logo-lg-text-light">Xeria</span> -->
                    </span>
                <span class="logo-sm">
                    <!-- <span class="logo-sm-text-dark">X</span> -->
                    <img src="public/template/admin/images\logo-sm.png" alt="" height="24">
                    </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>
        </ul>
    </div>
    <!-- end Topbar -->
</div>

<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-dashboard-line"></i>
                        <span> Dashboards </span>
                    </a>

                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-user-follow-line"></i>
                        <span> User </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="index.php?module=admin&controller=user&action=form">Add user</a>
                        </li>
                        <li>
                            <a href="index.php?module=admin&controller=user&action=index">List User</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-list-check"></i>
                        <span> Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="index.php?module=admin&controller=category&action=form">Add Category</a>
                        </li>
                        <li>
                            <a href="index.php?module=admin&controller=category&action=index">List Category</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-product-hunt-line"></i>
                        <span> Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="index.php?module=admin&controller=product&action=edit">Add Product</a>
                        </li>
                        <li>
                            <a href="index.php?module=admin&controller=product&action=list">List Product</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-order-play-line"></i>
                        <span> Order </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="pages-starter.html">List Order</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-slideshow-3-line"></i>
                        <span> Slider </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="index.php?module=admin&controller=slide&action=form">Add Slider</a>
                        </li>
                        <li>
                            <a href="index.php?module=admin&controller=slide&action=index">List Slider</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-bank-card-line"></i>
                        <span> Banner </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="index.php?module=admin&controller=banner&action=form">Add Banner</a>
                        </li>
                        <li>
                            <a href="index.php?module=admin&controller=banner&action=index">List Banner</a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>

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
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                2016 - 2019 &copy; Jobaria Admin  by <a href="https://simstech.vn/">SimsTech</a>
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="https://simstech.vn/about/">About Us</a>
                    <a href="https://simstech.vn/services/">Service</a>
                    <a href="https://simstech.vn/contact-us/">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
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