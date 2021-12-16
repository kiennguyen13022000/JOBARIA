<?php
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
                            <?php echo $this->result['content'] ?>
                        </div>
                        <div id="product_detail_tab" class="tab-pane">
                            <?php echo $this->result['product_features'] ?>
                        </div>
                        <div id="reviews_tab" class="tab-pane">
                            <!--     ==================== review ===================================-->
                            <?php include_once 'review.php'; ?>
                        </div>
                    </div>
                </div>
                <?php include_once 'other_products.php'; ?>
            </div>
        </div>
    </section>
</main>
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
     It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
        PhotoSwipe keeps only 3 of them in the DOM to save memory.
        Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>



</div>
<script>
    <?php echo $this->script_img ?>
</script>
