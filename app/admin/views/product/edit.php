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
    <div class="nav-item position-relative">
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
             <div class="nav-item position-relative">
                <i class="fas fa-times remove_img" data-id="'. $v['id'] .'" data-table="product_image" data-control="product" onclick="delItem(this);"></i>
                            <img class="preview__image img_product"
                                 src="'.$v['image'].'">
                        </div>
          ';
       }
   }

    $tab_review = '
        <li class="nav-item">
        <a href="#reviews" data-toggle="tab" aria-expanded="true" class="nav-link">
            <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-inline-block">Reviews</span>
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
                        <i onclick="reviewDelete('.$this->id.')" class="remixicon-close-circle-fill review-close text-danger"></i>
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
if($ratingTotal > 0){
    $starOnePercent = $starOne / $ratingTotal * 100;
    $starTwoPercent = $starTwo / $ratingTotal * 100;
    $starThreePercent = $starThree / $ratingTotal * 100;
    $starFourPercent = $starFour / $ratingTotal * 100;
    $starFivePercent = $starFive / $ratingTotal * 100;
}

$rantingAvg = (5 * $starFive + 4 * $starFour + 3 * $starThree + $starTwo * 2 + $starOne) / $ratingTotal;
?>
<ul class="nav nav-pills navtab-bg nav-tabs-detail">
    <li class="nav-item">
        <a href="#information1" data-toggle="tab" aria-expanded="false" class="nav-link active">
            <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-inline-block">Information</span>
        </a>
    </li>
    <?php echo $nav_image ?>
    <?php echo $tab_review; ?>
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
                                <label for="">Reference</label>
                                <input type="text" name="form[reference]"
                                       value="<?php echo $this->result['reference']; ?>" class="form-control"
                                       placeholder="Reference">
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
                                <label for="">Intro</label>
                                <textarea role="textbox" aria-multiline="true" class="form-control note-codable" name="form[description]" placeholder="Intro" id=""
                                          cols="30" rows="10"><?php echo htmlentities($this->result['description']); ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description</label>
                                <textarea class="form-control" name="form[content]" placeholder="Description"
                                          id="" cols="30" rows="10"><?php echo htmlentities($this->result['content']); ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Product Detail</label>
                                <textarea class="form-control" name="form[product_features]" placeholder="Product Detail"
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
    <div class="tab-pane fade" id="reviews">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4  ">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="my-0"><?php echo number_format($rantingAvg, 1); ?></h1>
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
                                    <span class="text-muted"><?php echo $starThree; ?></span>
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

