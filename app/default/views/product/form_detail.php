<?php
$price = $this->result['price'];
$new_price = $price;
$text__price__modal = '';
$promotion = $this->result['promotion'];
if ($promotion > 0){
    $new_price = number_format($price - $price * $promotion / 100, 2, '.', ',');
    $text__price__modal = '<del class="text__price__modal">$'.$price.'</del>';
}
$price_discount = '
    <div class="mt-3">
        <span class="price_discount_modal pr-2">$'.$new_price.'</span>
        '.$text__price__modal.'
';
$price_discount .= '</div>';
?>
<div class="mt-4 mt-lg-0 details_product_content">
    <form action="" method="" class="details_product_form">
        <input type="hidden" name="product_id" value="<?php echo $this->product_id ?>">
        <input type="hidden" name="product_name" value="Janon vista fhd 4k">
        <input type="hidden" name="new_price" value="<?php echo $new_price ?>">
        <input type="hidden" name="old_price" value="<?php echo $price ?>">
        <input type="hidden" name="url_image"
               value="/jobaria/<?php echo $this->result['image'] ?>">
        <h3 class="product_title_modal mb-3"><?php echo $this->result['product_name'] ?></h3>
        <p class="mb-3">Reference: <?php echo $this->result['reference'] ?></p>
        <div class="star_box star__modal">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>
        <?php echo $price_discount ?>
        <div class="intro_modal mb-3 mt-3"><?php echo $this->result['description'] ?></div>
        <div class="size_box">
            <p class="">Size</p>
            <div class="product_size_box">
                <select name="product_size" data-minimum-results-for-search="Infinity"
                        class="product_size" id="">
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                </select>
            </div>
        </div>
        <div class="color_box mt-3">
            <p class="">Color</p>
            <div class="product_color_box">
                <ul class="nav align-items-center  ">
                    <li class="nav-item">
                        <label for="color_white">
                            <input checked type="radio" value="white" name="product_color"
                                   id="color_white" class="input_color">
                            <span class="bg_input_color bg_color_white"></span>
                        </label>
                    </li>
                    <li class="nav-item">
                        <label for="color_red">
                            <input type="radio" value="red" name="product_color" id="color_red"
                                   class="input_color">
                            <span class="bg_input_color bg_color_red"></span>
                        </label>
                    </li>
                    <li class="nav-item">
                        <label for="color_blue">
                            <input type="radio" value="blue" name="product_color" id="color_blue"
                                   class="input_color">
                            <span class="bg_input_color bg_color_blue"></span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center mt-1">
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
            <button type="button" class="ml-3 btn btn_add_cart btn-outline-primary">Add to
                cart</button>
        </div>
        <div class="share_details_box mt-4">
            <ul class="nav align-items-center w-100">
                <li class="nav-item mr-3">
                    Share
                </li>
                <li class="nav-item mr-3">
                    <a class="facebook share__icon" href="http://www.facebook.com/Jobaria"
                       target="_blank" title="Facebook">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                </li>
                <li class="nav-item mr-3">
                    <a class="twitter share__icon" href="http://www.twitter.com/Jobaria"
                       target="_blank" title="Twitter">
                        <i class="fab fa-twitter-square"></i>
                    </a>
                </li>

                <li class="nav-item mr-3">
                    <a class="youtube share__icon" href="http://www.youtube.com/Jobaria"
                       target="_blank" title="Youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </li>
                <li class="nav-item mr-3">
                    <a class="google share__icon" href="https://www.google.com/Jobaria"
                       target="_blank" title="Google">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                </li>
                <li class="nav-item mr-3">
                    <a class="instagram share__icon" href="https://www.instagram.com/Jobaria"
                       target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>
                <li class="nav-item mt-3 w-100">
                    <a href="" class="nav-link pl-0">
                        <i class="fa fa-heart" aria-hidden="true"></i> Add to favorite
                    </a>
                </li>
            </ul>
        </div>
        <div class="reassurance_box">
            <ul class="nav flex-column reassurance_nav">
                <li class="nav-item">
                    <i class="fas fa-check-square"></i> <span>Security Policy
                        (Edit With Customer Reassurance Module)</span>
                </li>
                <li class="nav-item">
                    <i class="fas fa-truck"></i><span>Delivery Policy (Edit With
                        Customer Reassurance Module)</span>
                </li>
                <li class="nav-item">
                    <i class="fas fa-sync-alt"></i><span>Return Policy (Edit With
                        Customer Reassurance Module)</span>
                </li>
            </ul>
        </div>
    </form>
</div>
