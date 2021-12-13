<?php


// create radio
$valueStatus          = (isset($this->result['status'])) ? $this->result['status'] : '';
$valueIsNew        = (isset($this->result['is_new'])) ? $this->result['is_new'] : '';

$raidoStatusActive = Helper::cmsRadio('status', 'active', 1, $valueStatus);
$raidoStatusNotActive = Helper::cmsRadio('status','Not active',0, $valueStatus);
$raidoIsNew = Helper::cmsRadio('is_new', 'Active', 1, $valueIsNew);
$raidoIsNotNew = Helper::cmsRadio('is_new','Not active',0, $valueIsNew);

$label = ['label' => 'Product name', 'id' => 'validationProductname'];
$inputProductname = Helper::cmsFormGroup($label, 'text', 'product_name', $this->result['product_name'], 'form-control', true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Price', 'id' => 'validationPrice'];
$inputPrice = Helper::cmsFormGroup($label, 'number', 'price', $this->result['price'], 'form-control', true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Quantity', 'id' => 'validationQuantity'];
$inputQuantity = Helper::cmsFormGroup($label, 'number', 'quantity', $this->result['quantity'], 'form-control', true, 'form-group mb-3', $this->errors);

$link =Url::createLink('admin', 'product', 'edit');
if($this->task == 'edit'){
    $link =Url::createLink('admin', 'product', 'edit', ['task' => $this->task, 'id' => $this->id]);
}
$image = !empty($this->result['image']) ? $this->result['image'] : '';
$choose_file = !empty($image)? $image : 'Choose file';
$img_product = !empty($image)? 'img_product' : '';

$errors = $this->errors;
$nav_image = '';
$list_images_view = '
    <div class="nav-item">
                            <img class="preview__image img_product"
                                 src="'.$image.'">
                        </div>
';
if($this->task == 'edit'){
    $nav_image = '
        <li class="nav-item">
        <a href="#images1" data-toggle="tab" aria-expanded="true" class="nav-link">
            <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-inline-block">Images</span>
        </a>
    </li>
    ';
   $listImages =  $this->listImages;
   if (!empty($listImages)){
       foreach ($listImages as $k => $v){
           $list_images_view .='
             <div class="nav-item">
                            <img class="preview__image img_product"
                                 src="'.$v['image'].'">
                        </div>
          ';
       }
   }
}
$listCategories = '
     <select class="form-control" name="form[category_id]" id="">
';
$getListCategories = $this->getListCategories;
if (!empty($getListCategories)){
    foreach ($getListCategories as $k =>$v){
        $name = str_repeat('-', $v['level'] * 2) . $v['name'] . str_repeat('-', $v['level'] * 2);
        $category_id = $this->result['category_id'];
        ($category_id == $v['id']) ? $selected = 'selected' : $selected = '';
        $listCategories .='
            <option '.$selected.' value="'.$v['id'].'">'.$name.'</option>
        ';
    }
}
$listCategories .= '</select>';
?>
<ul class="nav nav-pills navtab-bg nav-tabs-detail">
    <li class="nav-item">
        <a href="#information1" data-toggle="tab" aria-expanded="false" class="nav-link active">
            <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-inline-block">Information</span>
        </a>
    </li>
    <?php echo $nav_image ?>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active show" id="information1">
        <form method="post" enctype="multipart/form-data" class="needs-validation w-100" novalidate="" action="<?php echo $link; ?>">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="validationAvatar">Image</label>
                                <div class="custom-file cursor_label">
                                    <input type="file" name="image" id="validationImage" value="<?php echo  $image; ?>"
                                           class="input__image custom-file-input cursor"
                                           size="" placeholder="Image">
                                    <label class="custom-file-label" for="validationImage"><?php echo $choose_file; ?></label>

                                </div>
                                <img class="preview__image <?php echo $img_product; ?>"
                                     src="<?php echo $image; ?>">
                            </div>
                            <?php echo $inputProductname.$inputPrice.$inputQuantity ?>
                            <div class="form-group mb-3">
                                <label for="">Category</label>
                                <?php echo $listCategories; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Promotion</label>
                                <input type="number" name="form[promotion]" min="0" id="validationPromotion"
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
                                <textarea role="textbox" aria-multiline="true" class="form-control note-codable" name="form[description]" placeholder="description" id=""
                                          cols="30" rows="10"><?php echo htmlentities($this->result['description']); ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Content</label>
                                <textarea class="form-control" name="form[content]" placeholder="Content"
                                          id="" cols="30" rows="10"><?php echo htmlentities($this->result['content']); ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Product Features</label>
                                <textarea class="form-control" name="form[product_features]" placeholder="Product Features"
                                          id="" cols="30" rows="10"><?php echo htmlentities($this->result['content']); ?></textarea>
                            </div>
                            <?php echo $this->button_form; ?>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="validationCustom01">Status</label>
                                        <div class="row cursor_label">
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
                                        <div class="row cursor_label">
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
    </div>
    <div class="tab-pane fade" id="images1">
        <div class="container-fluid">
            <form action="" method="post">
                <input type="hidden" name="product_id" value="<?php echo $this->id; ?>">
                <div class="card">
                    <div class="card-body images_block">
                        <nav class="product_images nav mb-3">
                            <?php echo $list_images_view ?>
                        </nav>
                        <label for="img_product" class="dropzone dz-clickable cursor px-3">
                            <div class="dz-message needsclick mt-3 mb-3 text-center ">
                                <input type="file"  id="img_product" name="img_product" class="filePhotoImage d-none">
                                <p class="h1 text-muted"><i class="mdi mdi-cloud-upload"></i></p>
                                <h3>Drop files here or click to upload.</h3>
                                <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
                                                    <strong>not</strong> actually uploaded.)</span>
                            </div>
                        </label>
                    </div>
                </div>
            </form>

        </div>


<!--        <a title="Upload" class="add_image_product cursor">-->
<!--            <img src="public/template/admin/images/file-icons/upload.png" alt="">-->
<!--        </a>-->
    </div>

</div>

