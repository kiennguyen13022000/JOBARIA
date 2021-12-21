<?php

function createHtmlGrid($productList, $type){
    $html = '';
    $k = 1;
    foreach ($productList[$type] as $key => $value){
        if ($key == 0){
            $html .= '<div class="item">';
        }
        $discount       = (int) $value['price'] - (int) $value['promotion'] * (int) $value['price'] / 100;
        $price = '';
        if ($value['promotion'] > 0){
            $price = '<span class="text__price pr-2">'. number_format($value['price'], 0, ',', '.') .' ₫</span>';
        }
        $formatDiscount = number_format($discount, 0, ',', '.') . ' ₫';
        $html .= ' <div class="d-flex">
                        <div class="w-25 ">
                            <a href="detail.html" class="d-block">
                                <img src="'. $value['image'] .'" alt="">
                            </a>
                        </div>
                        <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                            <h3 class="product__name limit_line_1 w-100">
                                <a href="detail.html" title=" Janon vista fhd 4k">'. $value['product_name'] .'</a>
                            </h3>
                            <div class="price_product w-100">
                                <span class="price__discount">'.$formatDiscount.'</span>
                                '.$price.'
                            </div>
                        </div>
                    </div>';

        if ($k == 4){
            $k = 0;
            $html .= '</div><div class="item">';
        }

        if (count($productList[$type]) - 1 == $key && $key % 3 != 0)
            $html .= '</div>';
        $k++;
    }

    return $html;
}

$htmlNewProduct = createHtmlGrid($this->newProductList, 'newProductList');
$htmlBestsellerProduct = createHtmlGrid($this->bestSellerProductList, 'bestSellerProductList' );
$htmlFeatureProduct = createHtmlGrid($this->featureProductList, 'featureProductList');
?>
<!-- product slide  -->
<div class="container">
    <div class="row grid_product mt-5">
        <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="border-bottom pb-3 grid_product_title ml-lg-n3">
                Feature Products
            </div>
            <div class="owl-carousel  product_style_mall product_style">
                <?php echo $htmlFeatureProduct; ?>
            </div>
        </div>
        <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="border-bottom pb-3   grid_product_title">
                Bestseller
            </div>
            <div class="owl-carousel  product_style_mall product_style">
                <?php echo $htmlBestsellerProduct; ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="border-bottom pb-3 grid_product_title">
                New Products
            </div>
            <div class="owl-carousel  product_style_mall product_style">
                <?php echo $htmlNewProduct; ?>
            </div>
        </div>
    </div>
</div>
</div>