<?php


// create radio
$valueStatus          = (isset($this->result['status'])) ? $this->result['status'] : '';
$valueIsNew        = (isset($this->result['is_new'])) ? $this->result['is_new'] : '';

$raidoStatusActive = Helper::cmsRadio('status', 'active', 1, $valueStatus);
$raidoStatusNotActive = Helper::cmsRadio('status','Not active',0, $valueStatus);
$raidoIsNew = Helper::cmsRadio('is_new', 'New', 1, $valueIsNew);
$raidoIsNotNew = Helper::cmsRadio('is_new','Not new',0, $valueIsNew);

$label = ['label' => 'Product name', 'id' => 'validationProductname'];
$inputProductname = Helper::cmsFormGroup($label, 'text', 'product_name', $this->result['product_name'], 'form-control', true, 'form-group col-lg-6 mb-3', $this->errors);
$label = ['label' => 'Price', 'id' => 'validationPrice'];
$inputPrice = Helper::cmsFormGroup($label, 'number', 'price', $this->result['price'], 'form-control', true, 'form-group col-lg-6 mb-3', $this->errors);
$label = ['label' => 'Quantity', 'id' => 'validationQuantity'];
$inputQuantity = Helper::cmsFormGroup($label, 'number', 'quantity', $this->result['quantity'], 'form-control', true, 'form-group col-lg-6 mb-3', $this->errors);

$link =Url::createLink('admin', 'product', 'edit');
if($this->task == 'edit'){
    $link =Url::createLink('admin', 'product', 'edit', ['task' => $this->task, 'id' => $this->id]);
}
$image = !empty($this->result['image']) ? $this->result['image'] : '';
$choose_file = !empty($image)? $image : 'Choose file';
$img_product = !empty($image)? 'img_product' : '';

$errors = $this->errors;
$nav_edit = '';
$list_images_view = '
    <div class="nav-item position-relative">
                            <img class="preview__image img_product"
                                 src="'.$image.'">
                        </div>
';
if($this->task == 'edit'){
    $nav_edit = '
        <li class="nav-item">
            <a href="#product-img" data-toggle="tab" aria-expanded="true" class="nav-link">
               <span class="number">02</span>
                <span class="d-none d-sm-inline-block">Images</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#metadata" class="nav-link" data-bs-toggle="tab" data-toggle="tab">
                <span class="number">03</span>
                <span class="d-none d-sm-inline">Meta Data</span>
            </a>
        </li>
    ';
   $listImages =  $this->listImages;
   if (!empty($listImages)){
       foreach ($listImages as $k => $v){
           $list_images_view .='
             <div class="nav-item position-relative">
                <i class="fas fa-times remove_img" data-id="'. $v['id'] .'" data-table="product_image" data-control="product" onclick="delItem(this);"></i>
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
<div class="container-fluid">
    <div id="addproduct-nav-pills-wizard" class="twitter-bs-wizard form-wizard-header">
        <ul class="twitter-bs-wizard-nav mb-2 nav nav-pills nav-justified">
            <li class="nav-item">
                <a href="#general-info" class="nav-link active" data-bs-toggle="tab" data-toggle="tab">
                    <span class="number">01</span>
                    <span class="d-none d-sm-inline">General</span>
                </a>
            </li>

            <?php echo $nav_edit ?>

        </ul>
        <div class="tab-content twitter-bs-wizard-tab-content">
            <div class="tab-pane fade active show" id="general-info">

                <form method="post" enctype="multipart/form-data" class="needs-validation w-100" novalidate="" action="<?php echo $link; ?>">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-12 mb-3">
                                    <h4 class="header-title">General Information</h4>
                                    <p class="sub-header mb-0">Fill all information below</p>
                                </div>
                                <div class="form-group col-lg-12">
                                    <div class="row">
                                        <div class="form-group col-lg-5">
                                            <label for="validationAvatar">Image</label>
                                            <div class="custom-file cursor_label">
                                                <input type="file" name="image" id="validationImage" value="<?php echo  $image; ?>"
                                                       class="input__image custom-file-input cursor"
                                                       size="" placeholder="Image">
                                                <label class="custom-file-label" for="validationImage"><?php echo $choose_file; ?></label>

                                            </div>
                                            <img class="mt-3 preview__image <?php echo $img_product; ?>"
                                                 src="<?php echo $image; ?>">
                                        </div>
                                        <div class="col-lg-1"></div>
                                        <div class="form-group col-lg-6">
                                            <div class="form-group col-lg-6 mb-3">
                                                <label for="validationCustom01">Status <span class="text-danger">*</span></label>
                                                <div class="row cursor_label">
                                                    <div class="col-6">
                                                        <?php echo $raidoStatusActive; ?>
                                                    </div>

                                                    <div class="col-6">
                                                        <?php echo $raidoStatusNotActive; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6 mb-3">
                                                <label for="validationCustom01">Is New <span class="text-danger">*</span></label>
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


                                <?php echo $inputProductname.$inputPrice.$inputQuantity ?>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="">Category</label>
                                    <?php echo $listCategories; ?>
                                </div>

                                <div class="form-group col-lg-6 mb-3">
                                    <label for="">Promotion</label>
                                    <input type="number" name="form[promotion]" min="0" id="validationPromotion"
                                           value="<?php echo $this->result['promotion']; ?>" class="form-control"
                                           placeholder="Promotion">
                                </div>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="">Promotion End date</label>
                                    <input type="datetime-local" name="form[promotion_end_date]" id="validationPromotionEnddate"
                                           value="<?php echo $this->result['promotion_end_date']; ?>" class="form-control"
                                           placeholder="Promotion End date">
                                </div>
                                <div class="form-group col-lg-12 mb-3">
                                    <div class="row">
                                        <div class="form-group col-lg-6 ">
                                            <label for="">Intro</label>
                                            <textarea role="textbox" aria-multiline="true" class="form-control note-codable textarea" name="form[description]" placeholder="Intro" id=""
                                                      cols="30" rows="10"><?php echo htmlentities($this->result['description']); ?></textarea>
                                        </div>
                                        <div class="form-group col-lg-6 ">
                                            <label for="">Reference</label>
                                            <input type="text" name="form[reference]"
                                                   value="<?php echo $this->result['reference']; ?>" class="form-control"
                                                   placeholder="Reference">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 mb-3">
                                    <label for="">Description</label>
                                    <textarea class="form-control textarea" name="form[content]" placeholder="Description"
                                              id="" cols="30" rows="10"><?php echo htmlentities($this->result['content']); ?></textarea>
                                </div>
                                <div class="form-group col-lg-12 mb-3">
                                    <label for="">Product Detail</label>
                                    <textarea class="form-control textarea" name="form[product_features]" placeholder="Product Detail"
                                              id="" cols="30" rows="10"><?php echo htmlentities($this->result['content']); ?></textarea>
                                </div>

                            </div>


                            <?php if ($this->task != 'edit') echo $this->button_form; ?>
                        </div>
                    </div>
                    <?php
                    if ($this->task == 'edit')
                        echo '<ul class="pager wizard mb-0 list-inline text-right mb-3 mt-3 ">
                        <li class="next list-inline-item ">
                            '.$this->button_form.'
                        </li>
                        <li class="next list-inline-item ">
                            <button type="button"  class="btn btn-success btn_next_step_product">Next tab Images <i class="mdi mdi-arrow-right ms-1"></i></button>
                        </li>
                    </ul>'
                    ?>
                </form>


            </div>
            <div class="tab-pane fade" id="product-img">
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
                    <ul class="pager wizard mb-0 list-inline text-right mb-3 mt-3">
                        <li class="previous list-inline-item">
                            <button type="button" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Back to General </button>
                        </li>
                        <li class="next list-inline-item">
                            <button type="button" class="btn btn-success">Add Meta Data <i class="mdi mdi-arrow-right ms-1"></i></button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade" id="metadata">
                <h4 class="header-title">Meta Data</h4>
                <p class="sub-header">Fill all information below</p>

                <form>
                    <div class="mb-3">
                        <label for="product-meta-title" class="form-label">Meta title</label>
                        <input type="text" class="form-control" id="product-meta-title" placeholder="Enter title">
                    </div>

                    <div class="mb-3">
                        <label for="product-meta-keywords" class="form-label">Meta Keywords</label>
                        <input type="text" class="form-control" id="product-meta-keywords" placeholder="Enter keywords">
                    </div>

                    <div>
                        <label for="product-meta-description" class="form-label">Meta Description </label>
                        <textarea class="form-control" rows="5" id="product-meta-description" placeholder="Please enter description"></textarea>
                    </div>
                </form>

                <ul class="pager wizard mb-0 list-inline text-right mb-3 mt-3">
                    <li class="previous list-inline-item">
                        <button type="button" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Edit Information </button>
                    </li>
                    <li class="list-inline-item">
                        <button type="submit" class="btn btn-success">Publish Product <i class="mdi mdi-arrow-right ms-1"></i></button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
