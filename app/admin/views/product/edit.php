<?php


// create radio
$raidoStatusActive = Helper::cmsRadio('status', 'active', 1, 'checked');
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
                    <div class="form-group mb-3">
                        <label for="validationFirstname">Product name</label>
                        <span class="text-danger">*</span>
                        <input type="text" name="form[product_name]" id="validationFirstname" value=""
                               class="form-control" size="" placeholder="Product name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationAvatar">Image</label>
                        <div class="custom-file">

                            <input type="file" name="image" id="validationImage" value="" class="custom-file-input"
                                   size="" placeholder="Image">
                            <label class="custom-file-label" for="validationImage">Choose file</label>

                        </div>
                        <img class="preview__avatar" src="">
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationPrice">Price</label>
                        <span class="text-danger">*</span>
                        <input type="number" name="form[price]" id="validationPrice" value="" class="form-control"
                                 placeholder="Price">
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationQuantity">Quantity</label>
                        <span class="text-danger">*</span>
                        <input type="number" min="0" name="form[quantity]" id="validationQuantity" value="" class="form-control"
                               placeholder="Price">
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationPromotion">Promotion</label>
                        <input type="number" name="form[promotion]" id="validationPromotion" value="" class="form-control"
                               placeholder="Promotion">
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationPromotionEnddate">Promotion End date</label>
                        <input type="datetime-local" name="form[promotion_end_date]" id="validationPromotionEnddate" value="" class="form-control"
                               placeholder="Promotion End date">
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationPromotion">Desciption</label>
                        <textarea class="form-control" name="form[desciption]" placeholder="desciption" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationPromotion">Content</label>
                        <textarea class="form-control" name="form[content]" placeholder="Content" id="" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="validationPromotion">Product Feautures</label>
                        <textarea class="form-control" name="form[product_feautures]" placeholder="Product Feautures" id="" cols="30" rows="10"></textarea>
                    </div>


                    <button class="btn btn-primary" type="submit">Save</button>
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
                                    <div class="col-6 cursor_label">
                                        <?php echo $raidoStatusActive; ?>
                                    </div>

                                    <div class="col-6 cursor_label">
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