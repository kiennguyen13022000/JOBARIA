<?php

$valueFirstname         = (isset($this->result['firstname'])) ? $this->result['firstname'] : '';
$valueLastname          = (isset($this->result['lastname'])) ? $this->result['lastname'] : '';
$valueUsername          = (isset($this->result['username'])) ? $this->result['username'] : '';
$valueEmail             = (isset($this->result['email'])) ? $this->result['email'] : '';
$valuePhone             = (isset($this->result['phone'])) ? $this->result['phone'] : '';
$valueAddress           = (isset($this->result['address'])) ? $this->result['address'] : '';
$valueAvatar            = (isset($this->result['avatar'])) ? $this->result['avatar'] : '';
$valuePassword          = (isset($this->result['password'])) ? $this->result['password'] : '';
$valueConfirmPassword   = (isset($this->result['confirm_password'])) ? $this->result['confirm_password'] : '';

$label = ['label' => 'First name', 'id' => 'validationFirstname'];
$inputFirstname = Helper::cmsFormGroup($label, 'text', 'firstname', $valueFirstname, 'form-control', true, 'form-group mb-3 col-lg-6', $this->errors);
$label = ['label' => 'Last name', 'id' => 'validationLastname'];
$inputLastname = Helper::cmsFormGroup($label, 'text', 'lastname', $valueLastname, 'form-control', true, 'form-group mb-3 col-lg-6', $this->errors);
$rowFirstLast = Helper::cmsRow($inputFirstname . $inputLastname);
$label = ['label' => 'User name', 'id' => 'validationUsername'];
$inputUsername = Helper::cmsFormGroup($label, 'text', 'username', $valueUsername, 'form-control', true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Email', 'id' => 'validationEmail'];
$inputEmail = Helper::cmsFormGroup($label, 'text', 'email', $valueEmail, 'form-control', true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Phone', 'id' => 'validationPhone'];
$inputPhone = Helper::cmsFormGroup($label, 'text', 'phone', $valuePhone, 'form-control',  false, 'form-group mb-3', $this->errors);
$label = ['label' => 'Address', 'id' => 'validationAddress'];
$inputAddress = Helper::cmsFormGroup($label, 'text', 'address', $valueAddress, 'form-control', false, 'form-group mb-3', $this->errors);
$label = ['label' => 'Avatar', 'id' => 'validationAvatar'];
$inputAvatar = Helper::cmsFormGroupFile($label, 'file', 'avatar', $valueAvatar, 'custom-file-input',  false, 'form-group mb-3', $this->errors, $this->task);
$label = ['label' => 'Password', 'id' => 'validationPassword'];
$inputPassword = Helper::cmsFormGroup($label, 'password', 'password', $valuePassword, 'form-control',  true, 'form-group mb-3 col-lg-6', $this->errors);
$label = ['label' => 'Retype password', 'id' => 'validationRetypePassword'];
$inputRetypePassword = Helper::cmsFormGroup($label, 'password', 'confirm_password', $valueConfirmPassword, 'form-control',true, 'form-group mb-3 col-lg-6', $this->errors);
$rowPassword = Helper::cmsRow($inputPassword . $inputRetypePassword);


?>
<main id="main" class="account_page mt-5">
    <div class="container">
        <div class="page_info_content">
            <header class="page-header mb-4">
                <h1 class="title">
                    Your information
                </h1>
            </header>
            <div class="info_content">
                <form method="post" enctype="multipart/form-data" class="w-100" action="/my-information">
                    <div class="card">
                        <div class="card-body">
                            <?php echo $rowFirstLast . $inputUsername . $inputEmail . $inputPhone . $inputAddress . $inputAvatar . $rowPassword; ?>
                            <button class="btn btn-primary" type="submit">Ok</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>
