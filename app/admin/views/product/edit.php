<?php

error_reporting(E_ERROR | E_PARSE);
// create radio
$valueStatus          = (isset($this->result['status'])) ? $this->result['status'] : '';
//$valueIsNew        = (isset($this->result['is_new'])) ? $this->result['is_new'] : '';

$raidoStatusActive = Helper::cmsRadio('status', 'active', 1, $valueStatus);
$raidoStatusNotActive = Helper::cmsRadio('status','Not active',0, $valueStatus);
//$raidoIsNew = Helper::cmsRadio('is_new', 'New', 1, $valueIsNew);
//$raidoIsNotNew = Helper::cmsRadio('is_new','Not new',0, $valueIsNew);

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
$nav_image = '';
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

    $tab_review = ' <li class="nav-item">
                        <a href="#reviews" class="nav-link" data-bs-toggle="tab" data-toggle="tab">
                            <span class="number">04</span>
                            <span class="d-none d-sm-inline">Reviews</span>
                        </a>
                    </li>
    ';
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
$starOne = 0;
$starTwo = 0;
$starThree = 0;
$starFour = 0;
$starFive = 0;
$reviewHtml = '';
$ratingTotal = count($this->reviews);
foreach ($this->reviews as $key => $value){
    $starOne = $value['rating'] == 1 ? 1 + $starOne : $starOne;
    $starTwo = $value['rating'] == 2 ? 1 + $starTwo : $starTwo;
    $starThree = $value['rating'] == 3 ? 1 + $starThree : $starThree;
    $starFour = $value['rating'] == 4 ? 1 + $starFour : $starFour;
    $starFive = $value['rating'] == 5 ? 1 + $starFive : $starFive;
    $avatar = $value['avatar'] != null ? $value['avatar'] : ($key % 2 == 0 ? 'public/template/admin/images/users/avatar-2.jpg' : 'public/template/admin/images/users/avatar-1.jpg');
    $status = $value['status'] == 1 ? '<span data-control="product" data-id="'.$value['id'].'" data-status="'.$value['status'].'" class="review-status badge badge-info">Active</span>' : '<span data-control="product" data-id="'.$value['id'].'" data-status="'.$value['status'].'" class="review-status badge badge-purple">Deactive</span>';
    $reviewHtml .= '<div class="review-item mb-3">
                        <i onclick="reviewDelete('.$value['id'].')" class="remixicon-close-circle-fill review-close text-danger"></i>
                        '. $status .'
                        <div class="review-header d-flex justify-content-between pb-2 border-bottom">
                            <div class="d-flex align-items-center">
                                <img class="img-fluid avatar-sm rounded" src="'. $avatar .'">
                                <div class="pl-2 d-flex flex-column align-items-center">
                                    <div class="font-weight-bolder w-100">'. $value['name'] .'</div>
                                    <p class="font-13 m-0">'. $value['created_at'] .'</p>
                                </div>
                            </div>
                            <div>
                                <div class="flex-inline text-warning d-inline-block ml-5">
                                    '. str_repeat('<i class="fa fa-star" aria-hidden="true"></i>', $value['rating']) .'
                                </div>
                            </div>
                        </div>
                        <div class="content pt-2">
                            <p>
                                '.$value['content'].'
                            </p>
                        </div>
                        <div class="review-separator w-100"></div>
                    </div>';
}

if (empty($reviewHtml)){
    $reviewHtml = '<p class="textdanger font-20 text-center">No reviews yet.</p>';
}
$rantingAvg = 0;
if($ratingTotal > 0){
    $starOnePercent = $starOne / $ratingTotal * 100;
    $starTwoPercent = $starTwo / $ratingTotal * 100;
    $starThreePercent = $starThree / $ratingTotal * 100;
    $starFourPercent = $starFour / $ratingTotal * 100;
    $starFivePercent = $starFive / $ratingTotal * 100;
    $rantingAvg = (5 * $starFive + 4 * $starFour + 3 * $starThree + $starTwo * 2 + $starOne) / $ratingTotal;

}

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
            <?php echo $tab_review ?>
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
                                    <p><a target="_blank" href="<?php echo $this->getLink ?>"><i class="fas fa-link"></i> <?php echo $this->DOMAIN_NAME.$this->getLink ?></a></p>
                                </div>
                                <div class="form-group col-lg-12">
                                    <div class="row">
                                        <div class="form-group col-lg-5">
                                            <label for="validationAvatar">Image</label>
                                            <div class="custom-file cursor_label">
                                                <input type="file" name="image" id="validationImg" value="<?php echo  $image; ?>"
                                                       class="input__image custom-file-input cursor"
                                                       size="" placeholder="Image">
                                                <label class="custom-file-label" for="validationImg"><?php echo $choose_file; ?></label>

                                            </div>
                                            <img class="mt-3 preview__image <?php echo $img_product; ?>"
                                                 src="<?php echo $image; ?>">
                                        </div>
                                        <div class="col-lg-1"></div>
                                        <div class="form-group col-lg-6">
                                            <div class="form-group row mb-3">
                                                <div class="col-lg-6">
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

                                            </div>
                                            <div class="form-group ">
                                                <label for="">Product type</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input id="is_new" type="checkbox" <?php if($this->result['is_new'] == 1) echo 'checked'?> name="form[is_new]"
                                                               value="1">
                                                        <label class="cursor" for="is_new">Product new</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input id="feature" type="checkbox" <?php if($this->result['feature'] == 1) echo 'checked'?> name="form[feature]"
                                                               value="1">
                                                        <label class="cursor" for="feature">Product feature</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input id="best_seller" type="checkbox" <?php if($this->result['best_seller'] == 1) echo 'checked'?> name="form[best_seller]"
                                                               value="1">
                                                        <label class="cursor" for="best_seller">Best seller</label>
                                                    </div>
                                                </div>
                                            </div>
<!--                                            <div class="form-group col-lg-6 mb-3">-->
<!--                                                <label for="validationCustom01">Is New <span class="text-danger">*</span></label>-->
<!--                                                <div class="row cursor_label">-->
<!--                                                    <div class="col-6">-->
<!--                                                        --><?php //echo $raidoIsNew; ?>
<!--                                                    </div>-->
<!---->
<!--                                                    <div class="col-6">-->
<!--                                                        --><?php //echo $raidoIsNotNew; ?>
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
                                        </div>
                                    </div>
                                </div>


                                <?php echo $inputProductname.$inputPrice.$inputQuantity ?>
                                <div class="form-group col-lg-6 mb-3">
                                    <label for="">Category</label>
                                    <?php echo $listCategories; ?>
                                </div>
                                <!--                                <div class="form-group col-lg-6 mb-3">-->
                                <!--                                    <label for="">Promotion End date</label>-->
                                <!--                                    <input type="datetime-local" name="form[promotion_end_date]" id="validationPromotionEnddate"-->
                                <!--                                           value="--><?php //echo $this->result['promotion_end_date']; ?><!--" class="form-control"-->
                                <!--                                           placeholder="Promotion End date">-->
                                <!--                                </div>-->
                                <div class="form-group col-lg-12 mb-3">
                                    <div class="row">
                                        <div class="form-group col-lg-6 ">
                                            <label for="">Intro</label>
                                            <textarea role="textbox" aria-multiline="true" class="form-control note-codable textarea" name="form[description]" placeholder="Intro" id=""
                                                      cols="30" rows="10"><?php echo htmlentities($this->result['description']); ?></textarea>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="">Promotion</label>
                                                <input type="number" name="form[promotion]" min="0" id="validationPromotion"
                                                       value="<?php echo $this->result['promotion']; ?>" class="form-control"
                                                       placeholder="Promotion">
                                            </div>
                                            <div class="form-group ">
                                                <label for="">Reference</label>
                                                <input type="text" name="form[reference]"
                                                       value="<?php echo $this->result['reference']; ?>" class="form-control"
                                                       placeholder="Reference">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group col-lg-12 mb-3">
                                    <label for="">Description</label>
                                    <textarea class="form-control textarea" name="form[content]" placeholder="Description"
                                              id="" cols="30" rows="10"><?php echo $this->result['content']; ?></textarea>
                                </div>
                                <div class="form-group col-lg-12 mb-3">
                                    <label for="">Product Detail</label>
                                    <textarea class="form-control textarea" name="form[product_detail]" placeholder="Product Detail"
                                              id="" cols="30" rows="10"><?php echo $this->result['product_detail']; ?></textarea>
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
                                <label for="img_product" class="dropzone dz-clickable cursor px-3 w-100">
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
            <div class="tab-pane fade" id="reviews">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4  ">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="my-0"><?php if($rantingAvg > 0) echo number_format($rantingAvg, 1); else echo '0'; ?></h1>
                                    <p class="text-muted mb-1">based on <?php echo $ratingTotal; ?> ratings</p>
                                    <div class="flex-inline text-warning d-inline-block">
                                        <?php echo str_repeat('<i class="fa fa-star" aria-hidden="true"></i>', (int) $rantingAvg); ?>
                                        <?php
                                        if (is_float(strval($rantingAvg) + 0))
                                            echo str_repeat(' <i class="fas fa-star-half-alt" aria-hidden="true"></i>', 1);
                                        ?>
                                        <?php echo str_repeat('<i class="far fa-star" aria-hidden="true"></i>',  floor(5 - $rantingAvg)); ?>
                                    </div>
                                    <div class="progress-count mt-2">
                                        <div class="d-flex justify-content-between">
                                        <span>
                                            <span class="font-weight-bolder">5</span>
                                            <i class="fa fa-star text-warning font-13" aria-hidden="true"></i>
                                        </span>
                                            <span class="text-muted"><?php echo $starFive; ?></span>
                                        </div>
                                        <div class="progress" height="10">
                                            <div class="progress-bar light-success-bg" role="progressbar" aria-valuenow="10"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $starFivePercent?>%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-count mt-2">
                                        <div class="d-flex justify-content-between">
                                        <span>
                                            <span class="font-weight-bolder">4</span>
                                            <i class="fa fa-star text-warning font-13" aria-hidden="true"></i>
                                        </span>
                                            <span class="text-muted"><?php echo $starFour; ?></span>
                                        </div>
                                        <div class="progress mt-1" height="10">
                                            <div class="progress-bar bg-info-light" role="progressbar" aria-valuenow="42"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $starFourPercent?>%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-count mt-2">
                                        <div class="d-flex justify-content-between">
                                        <span>
                                            <span class="font-weight-bolder">3</span>
                                            <i class="fa fa-star text-warning font-13" aria-hidden="true"></i>
                                        </span>
                                            <span class="text-muted"><?php echo $starThree; ?></span>
                                        </div>
                                        <div class="progress mt-1" height="10">
                                            <div class="progress-bar bg-lightyellow" role="progressbar" aria-valuenow="43"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $starThreePercent?>%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-count mt-2">
                                        <div class="d-flex justify-content-between">
                                        <span>
                                            <span class="font-weight-bolder">2</span>
                                            <i class="fa fa-star text-warning font-13" aria-hidden="true"></i>
                                        </span>
                                            <span class="text-muted"><?php echo $starTwo; ?></span>
                                        </div>
                                        <div class="progress mt-1" height="10">
                                            <div class="progress-bar light-danger-bg" role="progressbar" aria-valuenow="20"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $starTwoPercent?>%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-count mt-2">
                                        <div class="d-flex justify-content-between">
                                        <span>
                                            <span class="font-weight-bolder">1</span>
                                            <i class="fa fa-star text-warning font-13" aria-hidden="true"></i>
                                        </span>
                                            <span class="text-muted"><?php echo $starOne; ?></span>
                                        </div>
                                        <div class="progress mt-1" height="10">
                                            <div class="progress-bar bg-careys-pink" role="progressbar" aria-valuenow="40"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $starOnePercent?>%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <?php echo $reviewHtml; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
