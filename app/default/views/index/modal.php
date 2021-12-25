<?php
$slideImage = '';
if (!empty($this->productInfo['childImage'])){
    foreach ($this->productInfo['childImage'] as $value){
        $slideImage .= ' <li class="splide__slide">
            <img src="'. $value['image'] .'">
        </li>';
    }
}

$discount       = (int) $this->productInfo['price'] - (int) $this->productInfo['promotion'] * (int) $this->productInfo['price'] / 100;
$price = '';
if ($this->productInfo['promotion'] > 0){
    $price = '<del class="text__price__modal">$'. number_format($this->productInfo['price'], 2, '.', ',') .'</del>';
}
$numFormatDiscount = number_format($discount, 2, '.', ',');
$formatDiscount = '$'. $numFormatDiscount;
?>

<div class="modal fade" id="modal_product" tabindex="-1" role="dialog"
     aria-labelledby="modal_productLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="product_id" value="<?php echo $this->productInfo['id']; ?>">
<!--                    <input type="hidden" name="product_name" value="Janon vista fhd 4k">-->
<!--                    <input type="hidden" name="new_price" value="--><?php //echo $numFormatDiscount ?><!--">-->
<!--                    <input type="hidden" name="old_price" value="--><?php //echo $this->productInfo['price'] ?><!--">-->
<!--                    <input type="hidden" name="url_image" value="--><?php //echo $this->productInfo['image'] ?><!--">-->
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="border">
                                <!-- slide main -->
                                <div id="" class="splide splide_modal">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            <li class="splide__slide">
                                                <img src="<?php echo $this->productInfo['image']; ?>">
                                            </li>
                                            <?php echo $slideImage; ?>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <!-- slide thumb -->
                            <div class="splide thumbnail_splide thumbnail_splide_modal mt-3">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <li class="splide__slide">
                                            <img src="<?php echo $this->productInfo['image']; ?>">
                                        </li>
                                        <?php echo $slideImage; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 text-left mt-3 mt-lg-0">
                            <h3 class="product_title_modal"> <?php echo $this->productInfo['product_name']; ?></h3>
                            <p class="mb-2">Reference:  <?php echo $this->productInfo['categoryName']; ?></p>
                            <div class="star_box star__modal">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>

                            <div class="mt-2">
                                <span class="price_discount_modal pr-2"><?php echo $formatDiscount ?></span>
                                <?php echo $price; ?>
                            </div>

                            <div class="intro_modal mb-3"><?php echo $this->productInfo['description']; ?></div>
                            <div class="d-flex flex-wrap align-items-center">
                                <span>Quantity:</span>
                                <div class="d-flex border text-center ml-4">
                                    <div class="quantity border-right position-relative">
                                        <button type="button" class="quantity-button down quantity-down"><i
                                                class="fas fa-angle-down"></i></button>
                                        <input type="number" min="1" max="99" value="1" name="number_product"
                                               class="number_product">
                                        <button type="button" class="quantity-button up quantity-up"><i
                                                class="fas fa-angle-up"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="ml-3 btn btn_add_cart btn-outline-primary">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </form>

            </div>
            <div class="modal-footer justify-content-start">
                <ul class="nav align-items-center w-100">
                    <li class="nav-item mr-3">
                        <a class="facebook share__icon" href="http://www.facebook.com/Jobaria" target="_blank"
                           title="Facebook">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="twitter share__icon" href="http://www.twitter.com/Jobaria" target="_blank"
                           title="Twitter">
                            <i class="fab fa-twitter-square"></i>
                        </a>
                    </li>

                    <li class="nav-item mr-3">
                        <a class="youtube share__icon" href="http://www.youtube.com/Jobaria" target="_blank"
                           title="Youtube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="google share__icon" href="https://www.google.com/Jobaria" target="_blank"
                           title="Google">
                            <i class="fab fa-google-plus-g"></i>
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="instagram share__icon" href="https://www.instagram.com/Jobaria"
                           target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="nav-item mt-3 ml-md-auto">
                        <a href="javascript:void(0)" class="nav-link btn-favorite" data-id="<?php echo $this->productInfo['id']; ?>">
                            <i class="fa fa-heart" aria-hidden="true"></i> Add to favorite
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>