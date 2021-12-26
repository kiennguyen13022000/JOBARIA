<?php
    function createNBF($productList, $type){
        $htmlProductList = '';
        $favorites = !empty($productList['favorites']) ? $productList['favorites'] : [];
        foreach ($productList[$type] as $key => $value){

            $classFavorites = in_array($value['id'], $favorites) ? 'class__favorite' : '';
            $url    = '/product/' . trim($value['product_name']). '-' . $value['id'];
            $link = Url::filterURL($url) . '.html';
            $new        = $value['is_new'] == 0 ? '' : '<div class="d-inline-block px-3 py-1 rounded msg__status">New</div>';
            $promotion  = $value['promotion'] == 0 ? '' : '<div class="d-inline-block px-3 py-1 rounded msg__status">- '.$value['promotion'].'%</div>';
            if ($key % 2 == 0) {
                $htmlProductList .= '<div class="slider_item h-100 align-items-baseline">';
            }
            $discount       = (int) $value['price'] - (int) $value['promotion'] * (int) $value['price'] / 100;
            $price = '';
            if ($value['promotion'] > 0){
                $price = '<span class="text__price pr-2">$'. number_format($value['price'], 0, ',', '.') .'</span>';
            }
            $formatDiscount = '$'.number_format($discount, 0, ',', '.');
            $htmlProductList .= ' <div class="item h-50 position-relative wrapper_product_item text-center">
                                    <div class="product__item d-inline-block border-right position-relative" href="#">
                                        <div class="d-flex justify-content-between position-absolute w-100 px-3" style="left: 0">
                                            '. $new . $promotion .'
                                        </div>
                                        <div class="overflow-hidden wrapper__poduct__image">
                                            <a href="'.$link.'" title=""">
                                                <img src="'. $value['image'] .'"
                                                     class="product__img " alt="">
                                            </a>
                                        </div>
                                        <p class="category_name">
                                            '. $value['category_name'] .'
                                        </p>
                                        <h3 class="product__name limit_line_1">
                                            <a href="'.$link.'" title="Janon vista fhd 4k">'. $value['product_name'] .'</a>
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
                                        <button data-id="'. $value['id'] .'" class="btn btnModalProduct border btn__preview">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                        <button data-id="'. $value['id'] .'" class="btn__favorite btn text-dark border '.$classFavorites.' ">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                        <button data-id="'. $value['id'] .'" class="btn btn__addtocart btnModalProduct border mx-1">Add to cart</button>
                                        <button class="btn__copy btn text-dark border">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </button>
                                    </div>
                            </div>';

            if ($key % 2 != 0){
                $htmlProductList .= '</div>';
            }

            if (count($productList[$type]) - 1 == $key && $key % 2 == 0){
                $htmlProductList .= '</div>';
            }
        }

        return $htmlProductList;
    }

    $newProductList = createNBF($this->newProductList, 'newProductList');

    $bestSellerProductList = createNBF($this->bestSellerProductList, 'bestSellerProductList');
    $featureProductList = createNBF($this->featureProductList, 'featureProductList');

?>
<section class="product_list mt-5">
    <div class="container">
        <div class="tab_box">
            <ul class="nav  nav-tabs nav-pills tab_list">
                <li class="nav-item active">
                    <a class="nav-link pr-0 pr-md-3 active" data-toggle="pill" href="#new_arrival">New
                        Arrival</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pr-0 pr-md-3" data-toggle="pill" href="#bestseller">
                        Bestseller</a>
                </li>
                <li class="nav-item"><a class="nav-link pr-0 pr-md-3" data-toggle="pill"
                                        href="#feature_products">Feature Products</a>
                </li>

            </ul>

            <div class="tab-content">
                <div id="new_arrival" class="tab-pane in active show">
                    <div class="owl-carousel list_item_product product_style">
                        <?php echo $newProductList; ?>
                    </div>
                </div>
                <div id="bestseller" class="tab-pane">
                    <div class="owl-carousel list_item_product product_style">
                        <?php echo $bestSellerProductList; ?>
                    </div>
                </div>
                <div id="feature_products" class="tab-pane">
                    <div class="owl-carousel list_item_product product_style">
                        <?php echo $featureProductList; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>