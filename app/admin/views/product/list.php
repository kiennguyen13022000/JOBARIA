<?php

$label = ['label' => 'Product name', 'id' => 'validationProductname'];
$inputFirstname = Helper::cmsFormGroup($label, 'text', 'productname', null, 'form-control', null, null, 'form-group mb-3 col-lg-6');
$label = ['label' => 'Price', 'id' => 'validationPrice'];
$inputLastname = Helper::cmsFormGroup($label, 'text', 'price', null, 'form-control', null, null, 'form-group mb-3 col-lg-6');
$rowFirstLast = Helper::cmsRow($inputFirstname . $inputLastname);
$label = ['label' => 'Quantity', 'id' => 'validationQuantity'];
$inputUsername = Helper::cmsFormGroup($label, 'number', 'quantity', null, 'form-control', null, null, 'form-group mb-3');
$label = ['label' => 'Promotion', 'id' => 'validationPromotion'];
$inputEmail = Helper::cmsFormGroup($label, 'text', 'promotion', null, 'form-control', null, null, 'form-group mb-3');
$label = ['label' => 'Desciption', 'id' => 'validationDesciption'];
$inputPhone = Helper::cmsTextFormGroup($label, 'text', 'desciption', null, 'form-control', null, null, 'form-group mb-3');
$label = ['label' => 'Content', 'id' => 'validationContent'];
$inputContent = Helper::cmsTextFormGroup($label, 'text', 'content', null, 'form-control', null, null, 'form-group mb-3');
$label = ['label' => 'Features', 'id' => 'validationFeatures'];
$inputFeatures = Helper::cmsTextFormGroup($label, 'text', 'features', null, 'form-control', null, null, 'form-group mb-3');


// create radio
$raidoIsNew = Helper::cmsRadio('status', 'Active', 1, 'checked');
$raidoStatusNotActive = Helper::cmsRadio('status','Not active', 0);
$raidoIsNew = Helper::cmsRadio('is_new', 'Active', 1, 'checked');
$raidoIsNotNew = Helper::cmsRadio('is_new','Not active', 0);


$link =Url::createLink('admin', 'product', 'edit');
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
                                <label for="validationCustom01">Is New</label>
                                <div class="row">
                                    <div class="col-6">
                                        <?php echo $raidoIsNew; ?>
                                    </div>

                                    <div class="col-6">
                                        <?php echo $raidoIsNotNew; ?>
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