<?php
    $link =Url::createLink($this->_module, $this->_controller, $this->_action);
?>
<main id="main" class="login_page mt-5">
    <div class="container">
        <div class="page_login_content">
            <header class="page-header mb-4">
                <h1 class="title">
                    Log in to your account
                </h1>
            </header>
            <section class="page-customer-content">
                <div class="help-block <?php echo $this->block_errors ?>">
                    <ul class="list-unstyled">
                        <li class="alert alert-danger"> <?php echo $this->message_errors ?></li>
                    </ul>
                </div>
                <form class="form_no_border_r" action="<?php echo $this->REQUEST_URI ?>" method="post">
                    <input type="hidden" value="<?php echo $this->_redirect ?>" name="">
                    <div class="form-group row mb-3">
                        <label class="col-12 col-lg-3 form-control-label pl-4" for="username">User name</label>
                        <input class="form-control col-12 col-lg-6" type="text" name="form[username]" id="username" required="" placeholder="Enter user name">
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-12 col-lg-3 form-control-label pl-4" for="password">Password</label>
                        <input class="form-control col-12 col-lg-6" name="form[password]" type="password" required="" id="password" placeholder="Enter your password">
                    </div>

                    <div class="form-group row mb-3 d-none">
                        <label class="col-12 col-lg-3"></label>
                        <div class="col-12 col-lg-6 custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">
                            <label class="custom-control-label cursor" for="checkbox-signin">Remember me</label>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-login" type="submit"> Log In </button>
                    </div>

                </form>
                <hr>
                <div class="no-account text-center">
                    <a href="forgot.html" rel="nofollow">
                        Forgot your password?
                    </a>
                    <span class="ml-3 mr-3">|</span>
                    <a href="sign-up.html" data-link-action="display-register-form">
                        No account? Create one here
                    </a>
                </div>
            </section>
        </div>

    </div>
</main>
