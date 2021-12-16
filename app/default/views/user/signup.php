<?php

$valueFirstname         = (isset($this->result['firstname'])) ? $this->result['firstname'] : '';
$valueLastname          = (isset($this->result['lastname'])) ? $this->result['lastname'] : '';
$valueUsername          = (isset($this->result['username'])) ? $this->result['username'] : '';
$valueEmail             = (isset($this->result['email'])) ? $this->result['email'] : '';
$valuePassword          = (isset($this->result['password'])) ? $this->result['password'] : '';
$valueConfirmPassword   = (isset($this->result['confirm_password'])) ? $this->result['confirm_password'] : '';


$label = ['label' => 'First name', 'id' => 'validationFirstname'];
$inputFirstname = Helper::cmsFormGroup($label, 'text', 'firstname', $valueFirstname, 'form-control', true, 'form-group mb-3 col-lg-6', $this->errors);
$label = ['label' => 'Last name', 'id' => 'validationLastname'];
$inputLastname = Helper::cmsFormGroup($label, 'text', 'lastname', $valueLastname, 'form-control', true, 'form-group mb-3 col-lg-6', $this->errors);
$rowFirstLast = Helper::cmsRow($inputFirstname . $inputLastname);
$label = ['label' => 'User name', 'id' => 'validationUsername'];
$inputUsername = Helper::cmsFormGroup($label, 'text', 'username', $valueUsername, 'form-control', true, 'form-group mb-3 col-lg-6', $this->errors);
$label = ['label' => 'Email', 'id' => 'validationEmail'];
$inputEmail = Helper::cmsFormGroup($label, 'text', 'email', $valueEmail, 'form-control', true, 'form-group mb-3 col-lg-6', $this->errors);
$rowSecondLast = Helper::cmsRow($inputUsername . $inputEmail);
$label = ['label' => 'Password', 'id' => 'validationPassword'];
$inputPassword = Helper::cmsFormGroup($label, 'password', 'password', $valuePassword, 'form-control',  true, 'form-group mb-3 col-lg-6', $this->errors);
$label = ['label' => 'Retype password', 'id' => 'validationRetypePassword'];
$inputRetypePassword = Helper::cmsFormGroup($label, 'password', 'confirm_password', $valueConfirmPassword, 'form-control',true, 'form-group mb-3 col-lg-6', $this->errors);
$rowPassword = Helper::cmsRow($inputPassword . $inputRetypePassword);

$link =Url::createLink($this->_module, $this->_controller, $this->_action);
?>
<main id="main" class="account_page mt-5">
    <div class="container">
        <div class="page_login_content">
            <header class="page-header mb-4">
                <h1 class="title">
                    Create an account
                </h1>
            </header>
            <div class="info_content">
                <form method="post" class="form_no_border_r" action="<?php echo $link; ?>">
                    <div class="card">
                        <div class="card-body">
                            <?php echo $rowFirstLast . $rowSecondLast . $rowPassword; ?>
                            <button class="btn btn-primary btn-login float-right" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
