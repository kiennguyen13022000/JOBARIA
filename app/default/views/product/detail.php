<?php
//<div class="form-group">
//    <label for="comment">Your Review</label>
//    <textarea class="form-control" rows="5" id="comment"></textarea>
//</div>
//<div class="form-group">
//    <label for="email">Name *</label>
//    <input type="text" class="form-control mt-3">
//</div>
//<div class="form-group">
//    <label for="email">Email *</label>
//    <input type="text" class="form-control mt-3">
//</div>
$valueReview        = (isset($this->result['content'])) ? $this->result['content'] : '';
$valueEmail         = (isset($this->result['email'])) ? $this->result['email'] : '';
$valueName          = (isset($this->result['name'])) ? $this->result['name'] : '';
$userInfo = Session::get('userInfo');
if (!empty($userInfo)){
    $valueEmail         = (!empty($userInfo['email'])) ? $userInfo['email'] : '';
    $valueName          = (!empty($userInfo['name'])) ? $userInfo['name'] : '';
}

$label = ['label' => 'You review', 'id' => 'validationYouReview'];
$inputReview = Helper::cmsTextFormGroup($label, 'content', $valueReview, 'form-control', 'required', 'form-group mb-3');
$label = ['label' => 'Name', 'id' => 'validationName'];
$inputName = Helper::cmsFormGroup($label, 'text', 'name', $valueName, 'form-control','required', 'form-group mb-3');
$label = ['label' => 'Email', 'id' => 'validationEmail'];
$inputEmail = Helper::cmsFormGroup($label, 'email', 'email', $valueEmail, 'form-control','required', 'form-group mb-3');

$linkReviewSubmit = Url::createLink('default', 'product', 'review', ['id' => $this->product_id]);
?>
<main id="main" class="page_list">
    <nav aria-label="breadcrumb" class="nav_breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="jobaria/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product list</li>
            </ol>
        </div>

    </nav>
    <section class="main_page">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <!--     ==================== slider ===================================-->
                    <?php include_once 'slider.php'; ?>
                </div>
                <div class="col-12 col-lg-7">
                    <!--     ==================== form_detail ===================================-->
                    <?php include_once 'form_detail.php'; ?>
                </div>
                <div class="col-12 tab_list_content mt-5">
                    <ul class="nav  nav-tabs nav-pills tab_list tab_list_detail">
                        <li class="nav-item active">
                            <a class="nav-link pr-0 pr-md-3 pl-0 active" data-toggle="pill"
                               href="#description_tab">New
                                Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pr-0 pr-md-3" data-toggle="pill" href="#product_detail_tab">
                                Product Detail</a>
                        </li>
                        <li class="nav-item"><a class="nav-link pr-0 pr-md-3" data-toggle="pill"
                                                href="#reviews_tab">Reviews</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div id="description_tab" class="tab-pane in active show">
                            <div class="mb-4">
                                Use the Canon VIXIA GX10 Camcorder to capture UHD 4K video at 60 fps, recording in
                                MP4 to dual SD memory card slots. This camcorder packs several pro-style features
                                into its compact form, including Dual-Pixel Autofocus (DPAF). The GX10's 1" 8.29MP
                                CMOS sensor and dual DIGIC DV 6 image processors support Wide DR Gamma with high
                                sensitivity and low noise. Slow and fast-motion recording up to 120 fps offers
                                special looks for highlighting sports and other special events. Smooth, steady
                                shooting is assisted by the GX10's five-axis optical image stabilization. For
                                composing and viewing your footage, the VIXIA GX10 incorporates a flip-out 3.5"
                                touchscreen LCD, and a 0.24" electronic viewfinder. Additional GX10 features
                                include an HDMI 2.0 port for outputting your 4K UHD footage, assignable user
                                buttons, and remote control using the included WL-D89 controller. Wi-Fi
                                connectivity offers live streaming, FTP file sharing, and remote control via iOS
                                and Android apps.
                            </div>
                            <h5>
                                Product Hightlights
                            </h5>
                            <ul class="nav flex-column hightlights_list">
                                <li>
                                    UHD 4K Output up to 60 fps
                                </li>
                                <li>
                                    8.29MP, 1" CMOS Sensor
                                </li>
                                <li>
                                    Dual-Pixel CMOS Autofocus Feature
                                </li>
                                <li>
                                    Integrated 15x Optical Zoom Lens
                                </li>
                                <li>
                                    2 x DIGIC DV 6 Processors
                                </li>
                                <li>
                                    5-Axis Optical Image Stabilization
                                </li>
                                <li>
                                    Wide Dynamic Range Support
                                </li>
                                <li>
                                    Records 4K UHD/HD to Dual SD Card Slots
                                </li>
                                <li>
                                    3.5" Touchscreen LCD &amp; 0.24" EVF
                                </li>
                                <li>
                                    Live Stream/FTP/Remote App via Wi-Fi
                                </li>

                            </ul>
                        </div>
                        <div id="product_detail_tab" class="tab-pane">
                            <a href="" class="border d-block">
                                <img src="./assets/images/single-product/1.jpg" alt="">
                            </a>
                            <div class="mt-3">
                                <strong class="mr-3 mt-3">Reference <small
                                        class="text-normal">demo1</small></strong>
                            </div>
                            <div class="mt-3">
                                <strong class="mr-3 mt-3">In stock <small class="text-normal">295
                                        items</small></strong>
                            </div>

                        </div>
                        <div id="reviews_tab" class="tab-pane">
                            <div class="average_rating">
                                <span>Grae</span>
                                <div class="flex-inline  pl-3 d-inline-block">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="list_review">
                                <div class="review_item mt-2">
                                    <strong class="">Jobarria</strong>
                                    <div class="">
                                        12/01/2015
                                    </div>
                                </div>
                                <div class="review_item mt-2">
                                    <strong class="">User</strong>
                                    <div class="">
                                        That's Ok
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn_black btn_write_review mt-3" data-toggle="modal"
                                    data-target="#review_modal">Write Your Reviews</button>

                            <div class="modal fade " id="review_modal" tabindex="-1" role="dialog"
                                 aria-labelledby="review_modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form id="id_new_comment_form" method="post" class="mb-2" action="/jobaria/<?php echo $linkReviewSubmit; ?>">
                                                <h2 class="title">Write your review</h2>
                                                <div class="row mt-3">
                                                    <div class="product clearfix col-12 col-lg-6">
                                                        <img class="w-100" src="./assets/images/product/medium-size/1-1.jpg"
                                                             alt="">
                                                        <div class="product_desc mt-3">
                                                            <p class="product_name"><strong>HD Video Recording PJ Handycam
                                                                    Camcorder</strong></p>
                                                            <div class="limit_line_4">Create clearer, more shareable memories
                                                                with Optical
                                                                SteadyShot™
                                                                image stabilization, share with Wi-Fi® or the built-in
                                                                projector.
                                                                Enjoy Full HD/60p resolution, a 26.8mm wide angle ZEISS® lens
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="new_comment_form_content col-12 col-lg-6 mt-4 mt-lg-0">
                                                        <p>Our FeedBack</p>
                                                        <!-- <div id="new_comment_form_error" class="error"
                                                          style="display:none;padding:15px 25px">
                                                          <ul></ul>
                                                        </div> -->
                                                        <div class="flex-inline  criterions_list my-2">
                                                            <i class="fa fa-star text-dark" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                         <?php echo $inputReview . $inputName . $inputEmail; ?>
                                                         <input type="text" name="form[rating]" class="d-none" id="rating">
                                                        <div class="mt-3 mb-4">

                                                            <span>* Required fields</span>
                                                        </div>
                                                        <div class="btn_box">
                                                            <button type="button" class="btnReviewSubmit btn btn_black mr-3">Submit</button>
                                                            <button type="button" class="btn btn_black"
                                                                    data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 other_products">
                    <h2 class="text-uppercase title">12 OTHER PRODUCTS IN THE SAM CATEGORY</h2>
                    <div class="other_slider_box">
                        <div class="owl-carousel list_item_product product_style">
                            <div class="slider_item">
                                <div class="item position-relative wrapper_product_item text-center">
                                    <div class="product__item d-inline-block border-right" href="#">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">New</div>
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">-10%</div>
                                        </div>
                                        <div class="overflow-hidden">
                                            <a href="index.html" title="">
                                                <img src="./assets/images/product/medium-size/1-1.jpg"
                                                     class="product__img" alt="">
                                            </a>
                                        </div>

                                        <p class="category_name">
                                            Studio Design
                                        </p>
                                        <h3 class="product__name limit_line_1">
                                            <a href="index.html" title="Janon vista fhd 4k">Janon vista fhd 4k</a>
                                        </h3>
                                        <div class="star_box">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>

                                        <span class="text__price pr-2">$29.00</span>
                                        <span class="price__discount">$19.15</span>
                                    </div>

                                    <div class="d-flex algin-items-center justify-content-center mt-3">
                                        <button type="button" data-toggle="modal" data-target="#modal_product"
                                                class="btn border btn__preview"><i class="fa fa-search"
                                                                                   aria-hidden="true"></i></button>
                                        <button type="button" class="btn__favorite btn text-dark border  ">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn__addtocart border mx-1">Add to
                                            cart</button>
                                        <button type="button" class="btn__copy btn text-dark border">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="slider_item">
                                <div class="item position-relative wrapper_product_item text-center">
                                    <div class="product__item d-inline-block border-right" href="#">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">New</div>
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">-10%</div>
                                        </div>
                                        <div class="overflow-hidden">
                                            <a href="index.html" title="">
                                                <img src="./assets/images/product/medium-size/1-2.jpg"
                                                     class="product__img" alt="">
                                            </a>
                                        </div>

                                        <p class="category_name">
                                            Studio Design
                                        </p>
                                        <h3 class="product__name limit_line_1">
                                            <a href="index.html" title="Janon vista fhd 4k">Janon vista fhd 4k</a>
                                        </h3>
                                        <div class="star_box">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>

                                        <span class="text__price pr-2">$29.00</span>
                                        <span class="price__discount">$19.15</span>
                                    </div>

                                    <div class="d-flex algin-items-center justify-content-center mt-3">
                                        <button type="button" data-toggle="modal" data-target="#modal_product"
                                                class="btn border btn__preview"><i class="fa fa-search"
                                                                                   aria-hidden="true"></i></button>
                                        <button type="button" class="btn__favorite btn text-dark border  ">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn__addtocart border mx-1">Add to
                                            cart</button>
                                        <button type="button" class="btn__copy btn text-dark border">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="slider_item">
                                <div class="item position-relative wrapper_product_item text-center">
                                    <div class="product__item d-inline-block border-right" href="#">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">New</div>
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">-10%</div>
                                        </div>
                                        <div class="overflow-hidden">
                                            <a href="index.html" title="">
                                                <img src="./assets/images/product/medium-size/1-3.jpg"
                                                     class="product__img" alt="">
                                            </a>
                                        </div>

                                        <p class="category_name">
                                            Studio Design
                                        </p>
                                        <h3 class="product__name limit_line_1">
                                            <a href="index.html" title="Janon vista fhd 4k">Janon vista fhd 4k</a>
                                        </h3>
                                        <div class="star_box">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>

                                        <span class="text__price pr-2">$29.00</span>
                                        <span class="price__discount">$19.15</span>
                                    </div>

                                    <div class="d-flex algin-items-center justify-content-center mt-3">
                                        <button type="button" data-toggle="modal" data-target="#modal_product"
                                                class="btn border btn__preview"><i class="fa fa-search"
                                                                                   aria-hidden="true"></i></button>
                                        <button type="button" class="btn__favorite btn text-dark border  ">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn__addtocart border mx-1">Add to
                                            cart</button>
                                        <button type="button" class="btn__copy btn text-dark border">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="slider_item">
                                <div class="item position-relative wrapper_product_item text-center">
                                    <div class="product__item d-inline-block border-right" href="#">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">New</div>
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">-10%</div>
                                        </div>
                                        <div class="overflow-hidden">
                                            <a href="index.html" title="">
                                                <img src="./assets/images/product/medium-size/1-4.jpg"
                                                     class="product__img" alt="">
                                            </a>
                                        </div>

                                        <p class="category_name">
                                            Studio Design
                                        </p>
                                        <h3 class="product__name limit_line_1">
                                            <a href="index.html" title="Janon vista fhd 4k">Janon vista fhd 4k</a>
                                        </h3>
                                        <div class="star_box">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>

                                        <span class="text__price pr-2">$29.00</span>
                                        <span class="price__discount">$19.15</span>
                                    </div>

                                    <div class="d-flex algin-items-center justify-content-center mt-3">
                                        <button type="button" data-toggle="modal" data-target="#modal_product"
                                                class="btn border btn__preview"><i class="fa fa-search"
                                                                                   aria-hidden="true"></i></button>
                                        <button type="button" class="btn__favorite btn text-dark border  ">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn__addtocart border mx-1">Add to
                                            cart</button>
                                        <button type="button" class="btn__copy btn text-dark border">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="slider_item">
                                <div class="item position-relative wrapper_product_item text-center">
                                    <div class="product__item d-inline-block border-right" href="#">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">New</div>
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">-10%</div>
                                        </div>
                                        <div class="overflow-hidden">
                                            <a href="index.html" title="">
                                                <img src="./assets/images/product/medium-size/1-5.jpg"
                                                     class="product__img" alt="">
                                            </a>
                                        </div>

                                        <p class="category_name">
                                            Studio Design
                                        </p>
                                        <h3 class="product__name limit_line_1">
                                            <a href="index.html" title="Janon vista fhd 4k">Janon vista fhd 4k</a>
                                        </h3>
                                        <div class="star_box">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>

                                        <span class="text__price pr-2">$29.00</span>
                                        <span class="price__discount">$19.15</span>
                                    </div>

                                    <div class="d-flex algin-items-center justify-content-center mt-3">
                                        <button type="button" data-toggle="modal" data-target="#modal_product"
                                                class="btn border btn__preview"><i class="fa fa-search"
                                                                                   aria-hidden="true"></i></button>
                                        <button type="button" class="btn__favorite btn text-dark border  ">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn__addtocart border mx-1">Add to
                                            cart</button>
                                        <button type="button" class="btn__copy btn text-dark border">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="slider_item">
                                <div class="item position-relative wrapper_product_item text-center">
                                    <div class="product__item d-inline-block border-right" href="#">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">New</div>
                                            <div class="d-inline-block px-3 py-1 rounded msg__status">-10%</div>
                                        </div>
                                        <div class="overflow-hidden">
                                            <a href="index.html" title="">
                                                <img src="./assets/images/product/medium-size/1-6.jpg"
                                                     class="product__img" alt="">
                                            </a>
                                        </div>

                                        <p class="category_name">
                                            Studio Design
                                        </p>
                                        <h3 class="product__name limit_line_1">
                                            <a href="index.html" title="Janon vista fhd 4k">Janon vista fhd 4k</a>
                                        </h3>
                                        <div class="star_box">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>

                                        <span class="text__price pr-2">$29.00</span>
                                        <span class="price__discount">$19.15</span>
                                    </div>

                                    <div class="d-flex algin-items-center justify-content-center mt-3">
                                        <button type="button" data-toggle="modal" data-target="#modal_product"
                                                class="btn border btn__preview"><i class="fa fa-search"
                                                                                   aria-hidden="true"></i></button>
                                        <button type="button" class="btn__favorite btn text-dark border  ">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn__addtocart border mx-1">Add to
                                            cart</button>
                                        <button type="button" class="btn__copy btn text-dark border">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    var review = <?php echo Session::get('review'); Session::delete('review'); ?>;
    if (review == 'success')
        alert('Cảm ơn bạn đã đánh giá!');
</script>
