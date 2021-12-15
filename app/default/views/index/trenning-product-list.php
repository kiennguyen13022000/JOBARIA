<?php

function createHtml($trenning){
    $htmlFashion = '';
    foreach ($trenning as $key => $value){
        $new        = $value['is_new'] == 0 ? '' : '<div class="d-inline-block px-3 py-1 rounded msg__status">New</div>';
        $promotion  = $value['promotion'] == 0 ? '' : '<div class="d-inline-block px-3 py-1 rounded msg__status">- '.$value['promotion'].'%</div>';

        $discount       = (int) $value['price'] - (int) $value['promotion'] * (int) $value['price'] / 100;
        $price = '';
        if ($value['promotion'] > 0){
            $price = '<span class="text__price pr-2">'. number_format($value['price'], 0, ',', '.') .' ₫</span>';
        }
        $formatDiscount = number_format($discount, 0, ',', '.') . ' ₫';
        $htmlFashion .= '<div class="slider_item">';
        $htmlFashion .= '<div class="item position-relative wrapper_product_item text-center">
                              <div class="product__item d-inline-block border-right" href="#">';
        $htmlFashion .= '<div class="d-flex justify-content-between  position-absolute w-100 px-3" style="left: 0">
                                        '. $new . $promotion .'
                                    </div>
                                    <div class="overflow-hidden wrapper__poduct__image">
                                        <a href="detail.html" title="">
                                            <img src="'. $value['image'] .'"
                                                 class="product__img" alt="">
                                        </a>
                                    </div>

                                    <p class="category_name">
                                        '. $value['category_name'] .'
                                    </p>
                                    <h3 class="product__name limit_line_1">
                                        <a href="detail.html" title="Janon vista fhd 4k">'. $value['product_name'] .'</a>
                                    </h3>
                                    <div class="star_box">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>

                                     '. $price .'
                                    <span class="price__discount">'. $formatDiscount .'</span>
                                </div>

                                <div class="d-flex algin-items-center justify-content-center mt-3">
                                    <button data-id="'. $value['id'] .'" class="btnModalProduct btn border btn__preview"><i class="fa fa-search"
                                                                               aria-hidden="true"></i></button>
                                    <button class="btn__favorite btn text-dark border  ">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn__addtocart border mx-1">Add to cart</button>
                                    <button class="btn__copy btn text-dark border">
                                        <i class="fa fa-file" aria-hidden="true"></i>
                                    </button>';
        $htmlFashion .= '</div></div>';
        $htmlFashion .= '</div>';

    }
    return $htmlFashion;
}

$htmlFashion        = !empty($this->trenningProductList['fashion']) ? createHtml($this->trenningProductList['fashion']) : '';
$htmlElectronics        = !empty($this->trenningProductList['electronics']) ? createHtml($this->trenningProductList['electronics']) : '';
$htmlVehicel        = !empty($this->trenningProductList['vehicel']) ? createHtml($this->trenningProductList['vehicel']) : '';

?>
<section class="trending_box mt-5">
    <div class="container">
        <div class="tab_box_trending tab_box product_list">
            <ul class="nav  nav-tabs nav-pills tab_list tab_list_trending">
                <li class="nav-item  mr-auto">
                    <a class="nav-link pr-0 pr-md-3 text-bold">2021 Trending</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link pr-0 pr-md-3 active" data-toggle="pill" href="#fashion">Fashion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pr-0 pr-md-3" data-toggle="pill" href="#electronics">
                        Electronics</a>
                </li>
                <li class="nav-item"><a class="nav-link pr-0 pr-md-3" data-toggle="pill"
                                        href="#vehicle">Vehicle</a>
                </li>

            </ul>
            <div class="tab-content">
                <div id="fashion" class="tab-pane in active show">
                    <div class="owl-carousel list_item_product product_style">
                        <?php echo $htmlFashion;  ?>
                    </div>
                </div>
                <div id="electronics" class="tab-pane">
                    <div class="owl-carousel list_item_product product_style">
                        <?php echo $htmlElectronics;  ?>
                    </div>
                </div>
                <div id="vehicel" class="tab-pane">
                    <div class="owl-carousel list_item_product product_style">
                        <?php echo $htmlVehicel;  ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>