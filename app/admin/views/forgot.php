<?php
$link =Url::createLink('admin', 'login', 'forgot');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Forgot password | Jobaria - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="public/template/admin\images\favicon.ico">

    <!-- App css -->
    <link href="public/template/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="public/template/admin/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="public/template/admin/css/app.min.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <a href="index.html">
                                <span><img src="public/template/admin\images\logo-dark.png" alt="" height="22"></span>
                            </a>
                            <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                        </div>

                        <form action="<?php echo $link ?>" method="post">

                            <div class="form-group mb-3">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control <?php echo $this->errors ?>" name="form[email]" type="email" id="emailaddress" required="" placeholder="Enter your email">
                                <div class="invalid-feedback">
                                    Email does not exist
                                </div>
                                <div class="valid-feedback">
                                    New password has been sent to your email
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Reset Password </button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Back to <a href="index.php?module=admin&controller=login&action=login" class="text-muted font-weight-medium ml-1">Log in</a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>


<footer class="footer footer-alt">
    2021 - 2022 &copy; Jobaria theme by <a href="" class="text-muted">Dinh Kham & Kien Nguyen</a>
</footer>

<!-- Vendor js -->
<script src="public/template/admin/js/vendor.min.js"></script>

<!-- App js -->
<script src="public/template/admin/js/app.min.js"></script>

</body>
</html>
