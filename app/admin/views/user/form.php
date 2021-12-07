<?php
$label = ['label' => 'First name', 'id' => 'validationFirstname'];
$inputFirstname = Helper::cmsFormGroup($label, 'text', 'firstname', null, 'form-control', null, null, 'form-group mb-3 col-lg-6');
$label = ['label' => 'Last name', 'id' => 'validationLastname'];
$inputLastname = Helper::cmsFormGroup($label, 'text', 'lastname', null, 'form-control', null, null, 'form-group mb-3 col-lg-6');
$rowFirstLast = Helper::cmsRow($inputFirstname . $inputLastname);
$label = ['label' => 'User name', 'id' => 'validationUsername'];
$inputUsername = Helper::cmsFormGroup($label, 'text', 'username', null, 'form-control', null, null, 'form-group mb-3');
$label = ['label' => 'Email', 'id' => 'validationEmail'];
$inputEmail = Helper::cmsFormGroup($label, 'text', 'email', null, 'form-control', null, null, 'form-group mb-3');
$label = ['label' => 'Phone', 'id' => 'validationPhone'];
$inputPhone = Helper::cmsFormGroup($label, 'text', 'phone', null, 'form-control', null, null, 'form-group mb-3');
$label = ['label' => 'Address', 'id' => 'validationAddress'];
$inputAddress = Helper::cmsFormGroup($label, 'text', 'address', null, 'form-control', null, null, 'form-group mb-3');
$label = ['label' => 'Avatar', 'id' => 'validationAvatar'];
$inputAvatar = Helper::cmsFormGroupFile($label, 'file', 'avatar', null, 'custom-file-input', null, null, 'form-group mb-3');
$label = ['label' => 'Password', 'id' => 'validationPassword'];
$inputPassword = Helper::cmsFormGroup($label, 'password', 'password', null, 'form-control', null, null, 'form-group mb-3 col-lg-6');
$label = ['label' => 'Retype password', 'id' => 'validationRetypePassword'];
$inputRetypePassword = Helper::cmsFormGroup($label, 'password', 'confirm_password', null, 'form-control', null, null, 'form-group mb-3 col-lg-6');
$rowPassword = Helper::cmsRow($inputPassword . $inputRetypePassword);

// create radio
$raidoStatusActive = Helper::cmsRadio('status', 'Active', 1, 'checked');
$raidoStatusNotActive = Helper::cmsRadio('status','Not active', 0);
$raidoAdminActive = Helper::cmsRadio('admin', 'Active', 1, 'checked');
$raidoAdminNotActive = Helper::cmsRadio('admin','Not active', 0);

$link =Url::createLink('admin', 'user', 'form');
?>

<form method="post" enctype="multipart/form-data" class="needs-validation w-100" novalidate="" action="<?php echo $link; ?>">
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