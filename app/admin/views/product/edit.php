<?php


// create radio
$raidoStatusActive = Helper::cmsRadio('status', 'active', 1, 'checked');
$raidoStatusNotActive = Helper::cmsRadio('status','Not active', 0);
$raidoIsNew = Helper::cmsRadio('is_new', 'Active', 1, 'checked');
$raidoIsNotNew = Helper::cmsRadio('is_new','Not active', 0);


$link =Url::createLink('admin', 'product', 'edit');
if($this->task == 'edit'){
    $link =Url::createLink('admin', 'product', 'form', ['task' => $this->task, 'id' => $this->id]);
}

$choose_file = !empty($this->result['image'])? $this->result['image'] : 'Choose file';

?>

<form method="post" enctype="multipart/form-data" class="needs-validation w-100" novalidate="" action="<?php echo $link; ?>">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="validationFirstname">Product name</label>
                        <span class="text-danger">*</span>
                        <input type="text" name="form[product_name]" id="validationFirstname"
                               value="<?php echo $this->result['product_name']; ?>"
                               class="form-control" size="" placeholder="Product name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationAvatar">Image</label>
                        <div class="custom-file cursor_label">

                            <input type="file" name="image" id="validationImage" value="<?php echo $this->result['image']; ?>"
                                   class="input__image custom-file-input cursor"
                                   size="" placeholder="Image">
                            <label class="custom-file-label" for="validationImage"><?php echo $choose_file; ?></label>

                        </div>
                        <img class="preview__image" width="200" height="200" src="<?php echo $this->result['image']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationPrice">Price</label>
                        <span class="text-danger">*</span>
                        <input type="number" name="form[price]" id="validationPrice"
                               value="<?php echo $this->result['price']; ?>" class="form-control"
                                 placeholder="Price">
                    </div>
                    <div class="form-group mb-3">
                        <label for="validationQuantity">Quantity</label>
                        <span class="text-danger">*</span>
                        <input type="number" min="0" name="form[quantity]" id="validationQuantity"
                               value="<?php echo $this->result['quantity']; ?>" class="form-control"
                               placeholder="Price">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Promotion</label>
                        <input type="number" name="form[promotion]" id="validationPromotion"
                               value="<?php echo $this->result['promotion']; ?>" class="form-control"
                               placeholder="Promotion">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Promotion End date</label>
                        <input type="datetime-local" name="form[promotion_end_date]" id="validationPromotionEnddate"
                               value="<?php echo $this->result['promotion_end_date']; ?>" class="form-control"
                               placeholder="Promotion End date">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Description</label>
                        <textarea class="form-control" name="form[description]" placeholder="description" id="" cols="30" rows="10">
                            <?php echo $this->result['description']; ?>
                        </textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Content</label>
                        <textarea class="form-control" name="form[content]" placeholder="Content" id="" cols="30" rows="10">
                            <?php echo $this->result['content']; ?>
                        </textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Product Features</label>
                        <textarea class="form-control" name="form[product_features]" placeholder="Product Features" id="" cols="30" rows="10">
                             <?php echo $this->result['content']; ?>
                        </textarea>
                    </div>


                    <?php echo $this->button_form; ?>
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