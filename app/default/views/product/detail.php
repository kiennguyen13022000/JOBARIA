
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
<script>
    <?php echo $this->script_img ?>

    let review = <?php echo Session::get('review'); Session::delete('review');?>;
    if(review == 'success'){
        alert('Cam on ban đã đánh giá sản phẩm!');
    }
</script>
