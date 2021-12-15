<?php
    $htmlDailyDeal = '';
    foreach ($this->dailyDealProduct as $key => $value){
        $discount       = (int) $value['price'] - (int) $value['promotion'] * (int) $value['price'] / 100;
        $formatDiscount = number_format($discount, 0, ',', '.') . ' ₫';
        $new = $value['is_new'] == 0 ? '' : '<div class="new__product__msg px-3 py-1 btn ">New</div>';
        $htmlDailyDeal .= '<div class="slide_discount_item slide_discount_item_'. $value['id'] .'">
                                <div class="row slide__content__countdown border-right border-lg-right-0 mx-0">
                                    <div class="col-lg-5">
                                        '. $new .'
                                        <a class="d-inline-block p-2" href="detail.html">
                                            <img src="'. $value['image'] .'" class="w-100">
                                        </a>
                                    </div>
                                    <div class="col-lg-7 border-lg-right">
                                        <p class="text-uppercase color_main font_size_15">hurry up! offer end in:</p>
                                        <div class="d-flex wrapper__countdown justify-content-start text-center">
                                            <div class="box__countdown rounded p-2 mr-2">
                                                <span id="countdown__day__'. $value['id'] .'" class="countdown__number d-block">27</span>
                                                <span class="time__info">Days</span>
                                            </div>
                                            <div class="box__countdown rounded p-2 mr-2">
                                                <span id="countdown__hour__'. $value['id'] .'" class="countdown__number d-block">15</span>
                                                <span class="time__info">Hrs</span>
                                            </div>
                                            <div class="box__countdown rounded p-2 mr-2">
                                                <span id="countdown__minute__'. $value['id'] .'" class="countdown__number d-block">38</span>
                                                <span class="time__info">Mins</span>
                                            </div>
                                            <div class="box__countdown rounded p-2 mr-2">
                                                <span id="countdown__seconds__'. $value['id'] .'" class="countdown__number d-block">58</span>
                                                <span class="time__info">Secs</span>
                                            </div>
                                        </div>
                                        <p class="category_name mt-3">
                                            '. $value['categoryName'] .'
                                        </p>
                
                                        <h3 class="product__name limit_line_1">
                                            <a href="detail.html" title="SonicFuel Wireless Over-Ear Headphones">'. $value['product_name'] .'</a>
                                        </h3>
                
                                        <div class="star_box">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <div class="mt-3 mb-3 limit_line_2">'. $value['description'] .'</div>
                                        <span class="text__price pr-2">'. number_format($value['price'], 0, ',', '.') . ' ₫'.'</span>
                                        <span class="price__discount">'. $formatDiscount .'</span> <br>
                                        <button class="btn btn__addtocart border px-4 py-2 mx-1 mt-3">Add to
                                            cart</button>
                                    </div>
                                </div>
                                <script>countDownDiscount(\''.$value['promotion_end_date'].'\', '.$value['id'].')</script>
                            </div>';
    }
?>

<section class="daily_deal">
    <div class="container">
        <div class="row banner_daily_deals">
            <div class="col-12 col-md-4 col-lg-5  pr-md-0">
                <div class="banner_daily_deals_left px-3 py-2">
                    <i class="fa fa-history" aria-hidden="true"></i>
                    <span class="title">Jobaria's Daily Deal</span>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-7 pl-md-0 ">
                <div class="banner_daily_deals_right  h-100 d-flex align-items-center ">
              <span class="limit_line_1">Mega Sale on Tvs, Headphone, Watcher, Accessories Abc
                Def</span>
                </div>
            </div>
        </div>

        <!-- slide discount -->
        <div class="owl-carousel slide_discount product_style">
            <?php echo $htmlDailyDeal; ?>
        </div>
    </div>
</section>