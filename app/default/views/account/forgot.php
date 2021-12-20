<?php
$link =Url::createLink($this->_module, $this->_controller, $this->_action);
?>
<main id="main" class="login_page mt-5">
    <div class="container">
        <div class="page_login_content">
            <header class="page-header mb-4">
                <h1 class="title">
                    Forgot your password
                </h1>
            </header>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <a href="index.html">
                                    <span><img src="public/template/default/assets/images/menu/logo/1.jpg" alt="" ></span>
                                </a>
                                <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                            </div>

                            <form class="form_no_border_r" action="<?php echo $link ?>" method="post">

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
                                    <button class="btn btn-primary btn-login btn-block" type="submit"> Reset Password </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Back to <a href="login.html" class=" font-weight-medium ml-1">Log in</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
