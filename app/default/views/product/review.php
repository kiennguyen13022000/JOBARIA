<?php
$valueReview        = (isset($this->result['content'])) ? $this->result['content'] : '';
$valueEmail         = (isset($this->result['email'])) ? $this->result['email'] : '';
$valueName          = (isset($this->result['name'])) ? $this->result['name'] : '';
$userInfo = Session::get('user');
if (!empty($userInfo)){
    $userInfo           = $userInfo['userInfo'];
    $valueEmail         = $userInfo ['email'];
    $valueName          = $userInfo ['firstname'] . ' ' . $userInfo ['lastname'];
}

$label = ['label' => 'You review', 'id' => 'validationYouReview'];
$inputReview = Helper::cmsTextFormGroup($label, 'content', $valueReview, 'form-control', 'required', 'form-group mb-3');
$label = ['label' => 'Name', 'id' => 'validationName'];
$inputName = Helper::cmsFormGroup($label, 'text', 'name', $valueName, 'form-control','required', 'form-group mb-3');
$label = ['label' => 'Email', 'id' => 'validationEmail'];
$inputEmail = Helper::cmsFormGroup($label, 'email', 'email', $valueEmail, 'form-control','required', 'form-group mb-3');

$linkReviewSubmit = Url::createLink('default', 'product', 'review', ['id' => $this->product_id]);

$html = '';
$starOne = 0;
$starTwo = 0;
$starThree = 0;
$starFour = 0;
$starFive = 0;
$reviewHtml = '';
$ratingTotal = count($this->reviews);
foreach ($this->reviews as $value){
    $starOne = $value['rating'] == 1 ? 1 + $starOne : $starOne;
    $starTwo = $value['rating'] == 2 ? 1 + $starTwo : $starTwo;
    $starThree = $value['rating'] == 3 ? 1 + $starThree : $starThree;
    $starFour = $value['rating'] == 4 ? 1 + $starFour : $starFour;
    $starFive = $value['rating'] == 5 ? 1 + $starFive : $starFive;
    $html .= '<div class="review_item mt-2">  
                <div class="">
                    <strong class="">'. $value['name'] .'</strong>
                    <span>'. $value['created_at'] .'</span>
                </div>
                <div class="">
                  '. $value['content'] .'
                </div>
            </div>';
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
<div class="average_rating">
    <?php if($rantingAvg > 0) echo number_format($rantingAvg, 1); else echo '0'; ?>
    <p class="text-muted mb-1">based on <?php echo $ratingTotal; ?> ratings</p>
    <div class="flex-inline text-warning d-inline-block">
        <?php echo str_repeat('<i class="fa fa-star" aria-hidden="true"></i>', (int) $rantingAvg); ?>
        <?php
        if (is_float(strval($rantingAvg) + 0))
            echo str_repeat(' <i class="fas fa-star-half-alt" aria-hidden="true"></i>', 1);
        ?>
        <?php echo str_repeat('<i class="far fa-star" aria-hidden="true"></i>',  floor(5 - $rantingAvg)); ?>
    </div>
</div>
<div class="list_review">
    <?php echo $html; ?>

</div>

<button type="button" class="btn_black btn_write_review mt-3" data-toggle="modal"
        data-target="#review_modal">Write Your Reviews</button>

<div class="modal fade " id="review_modal" tabindex="-1" role="dialog"
     aria-labelledby="review_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="id_new_comment_form" method="post" class="mb-2" action="/jobaria/<?php echo $linkReviewSubmit?>">
                    <h2 class="title">Write your review</h2>
                    <div class="row mt-3">
                        <div class="product clearfix col-12 col-lg-6">
                            <img class="w-100" src="/jobaria/public/template/default/assets/images/product/medium-size/1-1.jpg"
                                 alt="">
                            <div class="product_desc mt-3">
                                <p class="product_name"><strong>HD Video Recording PJ Handycam
                                        Camcorder</strong></p>
                                <div class="limit_line_4">Create clearer, more shareable memories
                                    with Optical
                                    SteadyShot™
                                    image stabilization, share with Wi-Fi® or the built-in
                                    projector.
                                    Enjoy Full HD/60p resolution, a 26.8mm wide angle ZEISS® lens
                                    ...
                                </div>
                            </div>
                        </div>
                        <div class="new_comment_form_content col-12 col-lg-6 mt-4 mt-lg-0">
                            <p>Our FeedBack</p>
                            <!-- <div id="new_comment_form_error" class="error"
                              style="display:none;padding:15px 25px">
                              <ul></ul>
                            </div> -->
                            <div class="flex-inline  criterions_list my-2">
                                <i class="fa fa-star text-dark" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                             <?php echo $inputReview . $inputName . $inputEmail; ?>
                            <input class="d-none"  name="id" value="<?php echo $this->product_id; ?>">
                            <input class="d-none" name="form[rating]" id="rating">
                            <div class="mt-3 mb-4">

                                <span>* Required fields</span>
                            </div>
                            <div class="btn_box">
                                <button type="submit" class="btn btn_black mr-3">Submit</button>
                                <button type="button" class="btn btn_black"
                                        data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
