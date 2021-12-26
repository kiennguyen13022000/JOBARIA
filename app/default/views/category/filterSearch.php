<?php
    $listCat = $this->categories;
    $cat_accordion = '';
    $category_filter = '';
    $link_categories = '/product-list/';
    $array_cat = !empty($this->cat_id) ? explode(',',$this->cat_id) : array();
    if (!empty($listCat)){
        foreach ($this->categories as $key => $value){
            $category_name = $value['name'];
            $category_id = $value['id'];
            $category_slug = makeSlug($category_name);
            $breakcrumbs = $link_categories.$category_slug.'-'.$category_id;
            $child_second = !empty($value['child_second']) ? $value['child_second'] : '';
            $checked = in_array($category_id,$array_cat)   ? 'checked' : '';
            $category_filter .='
                 <li class="item">
                    <input class="typeSearch" value="'.$category_id.'" '.$checked.' type="checkbox" id="'.$category_slug.'_item" name="cat_id[]">
                    <label class="" for="'.$category_slug.'_item">'.$category_name.'</label>
                </li>
            ';
            if (!empty($child_second)){
                $cat_accordion .='
                 <div class="card_item">
                    <div class="card_header" id="'.$category_slug.'_cat">
                        <h5 class="mb-0 position-relative title_card" data-toggle="collapse"
                            data-target="#collapse_'.$category_slug.'_cat" aria-controls="collapse_'.$category_slug.'_cat">
                            '.$category_name.'
                            <i class="fa fa-plus"></i>
                        </h5>
                    </div>

                    <div id="collapse_'.$category_slug.'_cat" class="collapse" aria-labelledby="'.$category_slug.'_cat"
                         data-parent="#cat_accordion">
                        <div class="card_body">
                            <ul class="list_style_none list_item">';
                foreach ($child_second as $k =>$v){
                    $category_child_name = $v['name'];
                    $category_child_id = $v['id'];
                    $category_child_slug = makeSlug($category_child_name);
                    $checked_child = in_array($category_child_id,$array_cat)   ? 'checked' : '';
                    $breakcrumbs_child = $link_categories.strtolower($category_child_slug).'-'.$v['id'];
                    $category_filter .='
                         <li class="item">
                            <input class="typeSearch" '.$checked_child.' value="'.$category_child_id.'" type="checkbox" id="'.$category_child_slug.'_item" name="cat_id[]">
                            <label class="" for="'.$category_child_slug.'_item"> '.$category_child_name.'</label>
                        </li>
                    ';
                    $cat_accordion .='
                            <li class="item">
                                    <a href="'.$breakcrumbs_child.'" title="'.$category_child_name.'">'.$category_child_name.'</a>
                            </li>
                    ';
                }
                $cat_accordion .='
                            </ul>
                        </div>
                    </div>
                </div>
                ';
            }else{
                $cat_accordion .='
                 <div class="card_item">
                    <div class="card_header">
                        <h5 class="mb-0 position-relative title_card" >
                            <a href="'.$breakcrumbs.'" title="'.$category_name.'">'.$category_name.'</a>
                        </h5>
                    </div>
                </div>
                ';
            }

        }
    }
?>
<div class="col-12 col-lg-3">
    <div class="filer_box">
        <div class="modal " id="modal_filter_form" tabindex="-1" role="dialog"
             aria-labelledby="modal_filter_formLabel" aria-hidden="true">
            <div class="" role="document">
                <div class="modal_body_form">
                    <h1 class="cat_title text-uppercase">Panel Category</h1>
                    <div class="cat_list_accordion_box">
                        <div id="cat_accordion">
                            <?php echo $cat_accordion?>
                        </div>
                    </div>
                    <button type="button" class="close close_modal" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="<?php echo $this->REQUEST_URI?>" class="filter_form" method="post">
                        <input type="hidden" name="filter_form" value="filter_form">
                        <input type="hidden" name="per_page" value="<?php echo $this->per_page?>">
                        <p class="text-uppercase mt-2 filter_by">Filter by</p>
                        <button class="btn focus_none clear_all d-none"><i class="fa fa-times mr-1"></i>
                            Clear
                            All</button>
                        <div class="list_filter">
                            <div class="category_filter_box">
                                <p class="title_filter_box text-uppercase">Categories</p>
                                <ul class="list-unstyled list_fil">
                                    <?php echo $category_filter ?>
                                </ul>
                            </div>
                            <div class="category_filter_box d-none">
                                <p class="title_filter_box text-uppercase">Brand</p>
                                <ul class="list-unstyled list_fil">
                                    <li class="item">
                                        <input class="typeSearch" type="checkbox" id="corner_item" name="brand_filter">
                                        <label class="" for="corner_item">Graphic Corner (13)</label>
                                    </li>
                                    <li class="item">
                                        <input class="typeSearch" type="checkbox" id="desgin_item" name="brand_filter">
                                        <label class="" for="desgin_item">Studio desgin (12)</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="category_filter_box">
                                <p class="title_filter_box text-uppercase">Prices</p>
                                <ul class="list-unstyled list_fil">
                                    <li class="item">
                                        <input class="typeSearch" type="radio" <?php if ($this->price_range == 1) echo 'checked'?>
                                               value="1" id="0-30" name="price_range">
                                        <label class="" for="0-30">$0 - 30.00</label>
                                    </li>
                                    <li class="item">
                                        <input class="typeSearch" type="radio" <?php if ($this->price_range == 2) echo 'checked'?>
                                               value="2" id="30-60" name="price_range">
                                        <label class="" for="30-60">$30.00 - 60.00</label>
                                    </li>
                                    <li class="item">
                                        <input class="typeSearch" type="radio" <?php if ($this->price_range == 3) echo 'checked'?>
                                               value="3" id="60-120" name="price_range">
                                        <label class="" for="60-120">$60.00 - 120.00</label>
                                    </li>
                                    <li class="item">
                                        <input class="typeSearch" type="radio" <?php if ($this->price_range == 4) echo 'checked'?>
                                               value="4" id="120-200" name="price_range">
                                        <label class="" for="120-200">$120.00 - 200.00</label>
                                    </li>
                                    <li class="item">
                                        <input class="typeSearch" type="radio" <?php if ($this->price_range == 5) echo 'checked'?>
                                               value="5" id="over-200" name="price_range">
                                        <label class="" for="over-200">Over $200</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="category_filter_box d-none">
                                <p class="title_filter_box text-uppercase">Size</p>
                                <ul class="list-unstyled list_fil">
                                    <li class="item">
                                        <input type="checkbox" id="s_item" name="size_filter">
                                        <label class="" for="s_item">S (5)</label>
                                    </li>
                                    <li class="item">
                                        <input type="checkbox" id="m_item" name="size_filter">
                                        <label class="" for="m_item">M (12)</label>
                                    </li>
                                    <li class="item">
                                        <input type="checkbox" id="l_item" name="size_filter">
                                        <label class="" for="l_item">L (8)</label>
                                    </li>
                                    <li class="item">
                                        <input type="checkbox" id="xl_item" name="size_filter">
                                        <label class="" for="xl_item">XL (3)</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="category_filter_box d-none">
                                <p class="title_filter_box text-uppercase">Color</p>
                                <ul class="list-unstyled list_fil">
                                    <li class="item">
                                        <input type="checkbox" id="white_item" name="color_filter">
                                        <label class="" for="white_item">white (13)</label>
                                    </li>
                                    <li class="item">
                                        <input type="checkbox" id="black_item" name="color_filter">
                                        <label class="" for="black_item">Black (12)</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="category_filter_box d-none">
                                <p class="title_filter_box text-uppercase">Demension</p>
                                <ul class="list-unstyled list_fil">
                                    <li class="item">
                                        <input type="checkbox" id="40_60_item" name="demension_filter">
                                        <label class="" for="40_60_item">40x60cm (13)</label>
                                    </li>
                                    <li class="item">
                                        <input type="checkbox" id="60_90_item" name="demension_filter">
                                        <label class="" for="60_90_item">60x90cm (12)</label>
                                    </li>
                                    <li class="item">
                                        <input type="checkbox" id="80_120_item" name="demension_filter">
                                        <label class="" for="80_120_item">80x120cm (13)</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <a href="">
            <img class="h-100 w-100" src="/public/template/default/assets/images/banner/1-7.jpg" alt="">
        </a>
    </div>
    <div class="recommened_box">
        <div class="border-bottom pb-2 mb-2   grid_product_title">
            Recommened
        </div>
        <div class="owl-carousel  product_style_mall product_style">
            <div class="item">
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-2.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-3.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-4.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-2.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-3.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-4.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-2.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-3.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="w-25 ">
                        <a href="detail.html" class="d-block">
                            <img src="/public/template/default/assets/images/product/medium-size/1-4.jpg" alt="">
                        </a>
                    </div>
                    <div class="w-75 pl-3 d-flex align-content-center flex-wrap">
                        <h3 class="product__name limit_line_1 w-100">
                            <a href="detail.html" title=" Janon vista fhd 4k">Janon vista fhd
                                4k</a>
                        </h3>
                        <div class="price_product w-100">
                            <span class="price__discount">$19.15</span>
                            <span class="text__price pr-2">$29.00</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
