<?php
    $other_products = $this->other_products;

    $total_other_products = !empty($other_products) ? count($other_products) : 0;
    $other_products_html = '';
    if (!empty($other_products)){
        $other_products_html .=  '
            <div class="col-12 other_products">
            <h2 class="text-uppercase title">12 OTHER PRODUCTS IN THE SAM CATEGORY</h2>
            <div class="other_slider_box">
            <div class="owl-carousel list_item_product product_style">
        ';
        foreach ($other_products as $k=>$v){
            $price = $v['price'];
            $product_id = $v['id'];
            $new_price = $price;
            $text__price__modal = '';
            $promotion = $v['promotion'];
            //$category_name = $this->getCategoryName($v['id']);
            if ($promotion > 0){
                $new_price = number_format($price - $price * $promotion / 100, 2, '.', ',');
                $text__price__modal = '<del class="price__discount">$'.$price.'</del>';
            }
//            $url    = $v['breakcrumbs'] . '/' . trim($v['product_name']). '_' . $v['id'];
//            $link = Url::filterURL($url) . '.html';

            $link = '/product/'.$v['slug'].'-'.$product_id.'.html';
            $price_discount = '
            <div>
                <span class="text__price pr-2">$'.$new_price.'</span>
                '.$text__price__modal.'
            ';
            $price_discount .= '</div>';

            $v['is_new'] == 1 ? $is_new = '<div class="d-inline-block px-3 py-1 rounded msg__status">New</div>' : $is_new = '';
            !empty($v['promotion']) ? $promotion = ' <div class="d-inline-block px-3 py-1 rounded msg__status">-10%</div>' : $promotion = '';
            $other_products_html .= '
                 <div class="slider_item">
                    <div class="item position-relative wrapper_product_item text-center">
                    <div class="product__item d-inline-block border-right" href="#">
                        <div class="d-flex justify-content-between">
                            '.$is_new.'
                            '.$promotion.'
                        </div>
                        <div class="overflow-hidden">
                            <a href="'.$link.'" title="">
                                <img src="'.$v['image'].'"
                                     class="product__img" alt="">
                            </a>
                        </div>

                        <p class="category_name">
                            Studio Design
                        </p>
                        <h3 class="product__name limit_line_1">
                            <a href="'.$link.'" title="'.$v['product_name'].'">'.$v['product_name'].'</a>
                        </h3>
                        <div class="star_box">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        '.$price_discount.'
                    </div>

                    <div class="d-flex algin-items-center justify-content-center mt-3">
                       <button data-id="'.$v['id'].'" class="btn btnModalProduct border btn__preview">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn__favorite btn text-dark border  ">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </button>
                        <button data-id="'.$v['id'].'" type="button" class="btn btnModalProduct btn__addtocart border mx-1">Add to
                            cart</button>
                        <button type="button" class="btn__copy btn text-dark border">
                            <i class="fa fa-file" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                </div>
            ';
        }
        $other_products_html .= '
                </div>
            </div>
        </div>
        ';
    }
    echo $other_products_html;
?>




