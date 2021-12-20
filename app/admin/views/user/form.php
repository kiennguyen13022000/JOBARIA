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
        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <?php echo $rowFirstLast . $inputUsername . $inputEmail . $inputPhone . $inputAddress . $rowPassword; ?>
                </div>
            </div>

        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h4 class="font-weight-bold text-primary mt-0 border-bottom px-3 py-2">Action</h4>
                        <div class="card-body py-2">
                            <div class="form-group">
                                <button type="submit" name="submit" value="save" class="submitForm btn btn-warning waves-effect waves-light">
                                    <i class="bx bx-save"></i> Save
                                </button>
                                <?php
                                if ($this->task == 'add')
                                    echo '<button type="submit" name="submit" value="save-edit" class="submitForm ml-2 btn btn-danger waves-effect waves-light">
                                               <i class="bx bx-edit"></i> Save & Edit
                                            </button>';
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="col-12">
                    <div class="card">
                        <h4 class="font-weight-bold text-primary mt-0 border-bottom px-3 py-2">Image</h4>
                        <div class="card-body py-2">
                            <?php echo $inputAvatar; ?>
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
