<?php
$valueHeaderLogo         = (isset($this->result['header_logo'])) ? $this->result['header_logo'] : '';
$valueFooterLogo         = (isset($this->result['footer_logo'])) ? $this->result['footer_logo'] : '';
$valueEmail              = (isset($this->result['email'])) ? $this->result['email'] : '';
$valueAddress            = (isset($this->result['address'])) ? $this->result['address'] : '';
$valuePhone              = (isset($this->result['phone'])) ? $this->result['phone'] : '';

$label = ['label' => 'Logo Header', 'id' => 'validationLogoHeader'];
$inputLogoHeader = Helper::cmsFormGroupFile($label, 'file', 'header_logo', $valueHeaderLogo, 'custom-file-input',true, 'form-group mb-3', $this->errors, 'edit');
$label = ['label' => 'Logo Footer', 'id' => 'validationLogoFooter'];
$inputLogoFooter = Helper::cmsFormGroupFile($label, 'file', 'footer_logo', $valueFooterLogo, 'custom-file-input',true, 'form-group mb-3', $this->errors, 'edit');
$label = ['label' => 'Email', 'id' => 'validationEmail'];
$inputEmail = Helper::cmsFormGroup($label, 'text', 'email', $valueEmail, 'form-control',true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Address', 'id' => 'validationAddress'];
$inputAddress= Helper::cmsFormGroup($label, 'text', 'address', $valueAddress, 'form-control',true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Phone', 'id' => 'validationPhone'];
$inputPhone = Helper::cmsFormGroup($label, 'text', 'phone', $valuePhone, 'form-control',true, 'form-group mb-3', $this->errors);

$url = Url::createLink('admin', 'setting', 'index');
?>
<div class="row settings">
    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <div class="card-body">
                <form class="" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data">
                    <?php echo $inputEmail . $inputAddress . $inputPhone; ?>
                    <button type="submit" name="submit" value="save" class="submitForm btn btn-warning waves-effect waves-light">
                        <i class="bx bx-save"></i> Save
                    </button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="card">
            <div class="card-body">
                 <?php echo $inputLogoHeader?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php echo $inputLogoFooter?>
            </div>
        </div>
    </div>
</div>
