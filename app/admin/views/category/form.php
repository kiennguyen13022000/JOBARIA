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
$inputFirstname = Helper::cmsFormGroup($label, 'text', 'firstname', $valueFirstname, 'form-control', null, true, 'form-group mb-3 col-lg-6', $this->errors);
$label = ['label' => 'Last name', 'id' => 'validationLastname'];
$inputLastname = Helper::cmsFormGroup($label, 'text', 'lastname', $valueLastname, 'form-control', null, true, 'form-group mb-3 col-lg-6', $this->errors);
$rowFirstLast = Helper::cmsRow($inputFirstname . $inputLastname);
$label = ['label' => 'User name', 'id' => 'validationUsername'];
$inputUsername = Helper::cmsFormGroup($label, 'text', 'username', $valueUsername, 'form-control', null, true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Email', 'id' => 'validationEmail'];
$inputEmail = Helper::cmsFormGroup($label, 'text', 'email', $valueEmail, 'form-control', null, true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Phone', 'id' => 'validationPhone'];
$inputPhone = Helper::cmsFormGroup($label, 'text', 'phone', $valuePhone, 'form-control', null, false, 'form-group mb-3', $this->errors);
$label = ['label' => 'Address', 'id' => 'validationAddress'];
$inputAddress = Helper::cmsFormGroup($label, 'text', 'address', $valueAddress, 'form-control', null, false, 'form-group mb-3', $this->errors);
$label = ['label' => 'Avatar', 'id' => 'validationAvatar'];
$inputAvatar = Helper::cmsFormGroupFile($label, 'file', 'avatar', $valueAvatar, 'custom-file-input', null, false, 'form-group mb-3', $this->errors, 'users', $this->task);
$label = ['label' => 'Password', 'id' => 'validationPassword'];
$inputPassword = Helper::cmsFormGroup($label, 'password', 'password', $valuePassword, 'form-control', null, true, 'form-group mb-3 col-lg-6', $this->errors);
$label = ['label' => 'Retype password', 'id' => 'validationRetypePassword'];
$inputRetypePassword = Helper::cmsFormGroup($label, 'password', 'confirm_password', $valueConfirmPassword, 'form-control', null, true, 'form-group mb-3 col-lg-6', $this->errors);
$rowPassword = Helper::cmsRow($inputPassword . $inputRetypePassword);

// create radio
$valueStatus          = (isset($this->result['status'])) ? $this->result['status'] : '';
$valueAdmin         = (isset($this->result['status'])) ? $this->result['is_Admin'] : '';

$raidoStatusActive = Helper::cmsRadio('status', 'Active', 1, $valueStatus);
$raidoStatusNotActive = Helper::cmsRadio('status','Not active',0, $valueStatus);
$raidoAdminActive = Helper::cmsRadio('is_Admin', 'Active', 1, $valueAdmin);
$raidoAdminNotActive = Helper::cmsRadio('is_Admin','Not active', 0, $valueAdmin);

$link =Url::createLink('admin', 'user', 'form', ['task' => $this->task]);
if($this->task == 'edit'){
    $link =Url::createLink('admin', 'user', 'form', ['task' => $this->task, 'id' => $this->id]);
}
?>

<form method="post" enctype="multipart/form-data" class="w-100" action="<?php echo $link; ?>">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <?php echo $rowFirstLast . $inputUsername . $inputEmail . $inputPhone . $inputAddress . $inputAvatar . $rowPassword; ?>
                    <button class="btn btn-primary" type="submit">Ok</button>
                </div>
            </div>

        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">Status</label>
                                <div class="row">
                                    <div class="col-6">
                                        <?php echo $raidoStatusActive; ?>
                                    </div>

                                    <div class="col-6">
                                        <?php echo $raidoStatusNotActive; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">Is Admin</label>
                                <div class="row">
                                    <div class="col-6">
                                        <?php echo $raidoAdminActive; ?>
                                    </div>

                                    <div class="col-6">
                                        <?php echo $raidoAdminNotActive; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    //let success = <?php //echo Session::get('success'); Session::delete("success");?>//;
    //if (success == 'add'){
    //    let notifier = new AWN(options);
    //    notifier.success('Them thanh cong', {durations: {success: 2000}})
    //}




</script>
