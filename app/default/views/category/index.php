<?php
$listProduct = '';
$listProductGrid = '';
$data = $this->data;
if (!empty($data)){
    foreach ($data as $k=>$v){
        $product_name = $v['product_name'];
        $product_id = $v['id'];
        $slug = $v['slug'];
        $product_link = getLinkProduct($product_id,$slug);
        $price = $v['price'];
        $new_price = $price;
        $promotion = $v['promotion'];
        if ($promotion > 0){
            $new_price = number_format($price - $price * $promotion / 100, 2, '.', ',');
            $text__price__modal = '<span class="price__discount">$'.$price.'</span>';
        }
        $price_discount = '
            <div>
             '.$text__price__modal.'
                <span class="text__price pr-2">$'.$new_price.'</span>
               
            ';
        $price_discount .= '</div>';
        $price_discount_grid = '
            <div>
             <span class="text__price pr-2">$'.$new_price.'</span>
             '.$text__price__modal.'
               
               
            ';
        $price_discount_grid .= '</div>';
        $is_new = !empty($v['is_new']) ? '<div class="d-inline-block px-3 py-1 rounded msg__status">New</div>' : '';
        $is_promotion = !empty($promotion) ? '<div class="d-inline-block px-3 py-1 rounded msg__status">-'.$v['promotion'].'%</div>' : '';
        $listProduct .= '
            <div class="col-12 col-sm-6 col-md-4">
                <div class="item position-relative wrapper_product_item text-center">
                    <div class="product__item d-inline-block border-right" href="#">
                        <div class="d-flex justify-content-between">
                            '.$is_new.'
                            '.$is_promotion.'
                        </div>
                        <div class="overflow-hidden">
                            <a href="'.$product_link.'" title="'.$product_name.'">
                                <img src="'.$v['image'].'"
                                     class="product__img" alt="'.$product_name.'">
                            </a>
                        </div>
                        <p class="category_name">
                            Studio Design
                        </p>
                        <h3 class="product__name limit_line_1">
                            <a href="'.$product_link.'" title="'.$product_name.'">'.$product_name.'</a>
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
                        <a href="'.$product_link.'" class="btn__copy btn__link btn  border">
                            <i class="fa fa-file" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        ';
        $listProductGrid .='
            <div class="row item_grid">
                <div class="col-md-5">
                    <div class="wrap_img_product">
                        <a title="'.$product_name.'" class="d-inline-block" href="'.$product_link.'">
                            <img src="'.$v['image'].'" class="w-100" alt="'.$product_name.'">
                        </a>
                        <button data-id="'.$v['id'].'" 
                                class="btn border btn__preview btnModalProduct"><i class="fa fa-search"
                                                                   aria-hidden="true"></i></button>
                    </div>

                </div>
                <div class="col-md-7">
                    <p class="category_name mt-3">
                        Studio Design
                    </p>

                    <h3 class="product__name limit_line_1">
                        <a href="'.$product_link.'" title="'.$product_name.'">'.$product_name.'</a>
                    </h3>

                    <div class="star_box">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="mt-3 mb-3 limit_line_4 description">'.strip_tags($v['description']).'</div>
                    '.$price_discount_grid.'
                    <div class="d-flex algin-items-center mt-3">
                        <button class="btn__favorite btn ">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </button>
                        <button data-id="'.$v['id'].'" class="btn btn__addtocart mx-1 btnModalProduct">Add to cart</button>
                         <a href="'.$product_link.'" class="btn__copy btn__link btn  border">
                            <i class="fa fa-file" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        ';
    }
}
?>
<main id="main" class="page_list">
    <nav aria-label="breadcrumb" class="nav_breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product list</li>
            </ol>
        </div>

    </nav>
    <section class="main_page">
        <div class="container">
            <div class="row flex-wrap-reverse flex-lg-wrap">
                <?php
                    if ($this->type != 'search'){
                        include_once 'filter.php';
                    }else{
                        include_once 'filterSearch.php';
                    }
                ?>
                <div class="col-12 col-lg-9">
                    <div class="position-relative banner__item">
                        <div class="bg__hover__top"></div>
                        <a href="">
                            <img class="w-100 h-100" src="/public/template/default/assets/images/shop/2.jpg" alt="">
                        </a>
                        <div class="bg__hover__bottom"></div>
                    </div>
                    <ul class="nav top_list_product align-items-center <?php if(empty($listProductGrid)) echo 'd-none'?>">
                        <li class="nav-item  mr-auto">
                            <ul class="nav pills-tab align-items-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-list-tab" data-toggle="pill"
                                       href="#pills-list" role="tab" aria-controls="pills-list"
                                       aria-selected="true"><i class="fa fa-th" aria-hidden="true"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-grid-tab" data-toggle="pill" href="#pills-grid"
                                       role="tab" aria-controls="pills-grid" aria-selected="false"><i
                                                class="fa fa-list-ul" aria-hidden="true"></i></a>
                                </li>
                                <li class="nav-item ml-3">
                                     <?php
                                         if ($this->total_result == 1){
                                            echo 'There is '.$this->total_result.' product';
                                         }elseif ($this->total_result > 1){
                                             echo 'There are '.$this->total_result.' products';
                                         }else{

                                         }
                                     ?>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item d-flex align-items-center filter_btn_mb flex-wrap">
                            <button type="button" class="btn d-block d-lg-none btn_open_filter_modal"
                                    data-toggle="modal" data-target="#modal_filter_form">
                                <i class="fa fa-filter" aria-hidden="true"></i> Filter
                            </button>
                            <div class="sort_box d-flex1 align-items-center  d-none">
                                <div class="mr-3 text-bold">
                                    Sort By:
                                </div>
                                <div class="select_sort_box">
                                    <select class="sort select_sort" data-minimum-results-for-search="Infinity">
                                        <option>Relevance</option>
                                        <option>Name A to Z</option>
                                        <option>Name Z to A</option>
                                        <option>Price low to hight</option>
                                        <option>Price hight to low</option>
                                    </select>
                                </div>
                            </div>

                        </li>
                    </ul>
                    <div class="product_list <?php if(empty($listProductGrid)) echo 'mt-5'?>">
                        <?php if(empty($listProductGrid)) echo ' <h5>Product updating.....</h5>'?>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="pills-list" role="tabpanel"
                                 aria-labelledby="pills-list-tab">
                                <div class="row">
                                    <?php echo $listProduct;?>
                                </div>
                            </div>
                            <div class="tab-pane fade pills-grid" id="pills-grid" role="tabpanel"
                                 aria-labelledby="pills-grid-tab">
                                <div class="grid_product_tab">
                                    <?php echo $listProductGrid;?>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center pagination_box">
                            <div class="col-lg-4  mb-3 mb-lg-0 <?php if(empty($listProductGrid)) echo 'd-none'?>">
                                <div class="d-flex aling-items-center0">
                                    <div class="mr-3 lh_30">Show</div>
                                    <div class="per_page mr-3">
                                        <select name="per_page_select" data-minimum-results-for-search="Infinity"
                                                class="per_page_select" id="">
                                            <option <?php if($this->per_page == 6) echo 'selected'?> value="6">6</option>
                                            <option <?php if($this->per_page == 12) echo 'selected'?> value="12">12</option>
                                            <option <?php if($this->per_page == 24) echo 'selected'?> value="24">24</option>
                                        </select>
                                        <input type="submit" value="submitPerPage" class="d-none">
                                    </div>
                                    <div class="lh_30">Per Page</div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <?php echo $this->getLinksHtml ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

</main>
<!--<script>
    var REDIRECT_URL = ' <?php /*echo $this->REDIRECT_URL */?>';
</script>-->