<?php


$tabContent = '';
$tab = '';
$count = 0;
foreach ($this->trenningProductList as $key => $value){
    $itemTab = '';
    $activeTab = $count == 0 ? 'active' : '';
    $href = URL::filterURL($key);
    $tab .= '<li class="nav-item '. $activeTab .'">
                    <a class="nav-link pr-0 pr-md-3 '. $activeTab .'" data-toggle="pill" href="#'. $href .'">'. $key .'</a>
                </li>';

    foreach ($value as $key2 => $value2){
        $url    ='/product/' . trim($value2['product_name']). '-' . $value2['id'];
      //  $link = Url::filterURL($url) . '.html';
        $link = '';
        $new        = $value2['is_new'] == 0 ? '' : '<div class="d-inline-block px-3 py-1 rounded msg__status">New</div>';
        $promotion  = $value2['promotion'] == 0 ? '' : '<div class="d-inline-block px-3 py-1 rounded msg__status">- '.$value['promotion'].'%</div>';

        $discount       = (int) $value2['price'] - ((int) $value2['promotion'] * (int) $value2['price'] / 100);
        $price = '';
        if ($value2['promotion'] > 0){
            $price = '<span class="text__price pr-2">$'. number_format($value2['price'], 0, ',', '.') .'</span>';
        }

        $formatDiscount = '$'.number_format($discount, 0, ',', '.') ;

        $itemTab .= '<div class="slider_item">';
        $itemTab .= '<div class="item position-relative wrapper_product_item text-center">
                          <div class="product__item d-inline-block border-right" href="#">';
        $itemTab .= '<div class="d-flex justify-content-between  position-absolute w-100 px-3" style="left: 0">
                                    '. $new . $promotion .'
                                </div>
                                <div class="overflow-hidden wrapper__poduct__image">
                                    <a '.$value2['id'].' href="'.$link.'" title="">
                                        <img src="'. $value2['image'] .'"
                                             class="product__img" alt="">
                                    </a>
                                </div>

                                <p class="category_name">
                                    '. $value2['category_name'] .'
                                </p>
                                <h3 class="product__name limit_line_1">
                                    <a href="'.$link.'" title="Janon vista fhd 4k">'. $value2['product_name'] .'</a>
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
                                <button data-id="'. $value2['id'] .'" class="btnModalProduct btn border btn__preview"><i class="fa fa-search"
                                                                           aria-hidden="true"></i></button>
                                <button data-id="'. $value2['id'] .'" class="btn__favorite btn text-dark border  ">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn__addtocart border mx-1">Add to cart</button>
                                <button class="btn__copy btn text-dark border">
                                    <i class="fa fa-file" aria-hidden="true"></i>
                                </button>';
        $itemTab .= '</div></div>';
        $itemTab .= '</div>';
    }
    $activeTabContent = $count == 0 ? 'active show' : '';
    $tabContent .= '<div id="'. $href.'" class="tab-pane '. $activeTabContent .'">
                        <div class="owl-carousel list_item_product product_style">
                           '. $itemTab .'
                        </div>
                    </div>';

    $count++;

}


?>
<section class="trending_box mt-5">
    <div class="container">
        <div class="tab_box_trending tab_box product_list">
            <ul class="nav  nav-tabs nav-pills tab_list tab_list_trending">
                <li class="nav-item  mr-auto">
                    <a class="nav-link pr-0 pr-md-3 text-bold">2021 Trending</a>
                </li>
                <?php echo $tab; ?>
            </ul>
            <div class="tab-content">
                 <?php echo $tabContent; ?>

            </div>
        </div>
    </div>
</section>