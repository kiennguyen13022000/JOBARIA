
<main id="main" class="main_jorbaria">

    <!--     ==================== slider ===================================-->
    <?php include_once 'slider.php'; ?>
    <!--    ========================= end slider ========================================-->

    <!--     ==================== top banner ===================================-->
    <?php include_once 'top-banner.php'; ?>
    <!--    ========================= top banner ========================================-->

    <!--     ==================== support box ===================================-->
    <?php include_once 'support-box.php'; ?>
    <!--    ========================= support box ========================================-->

    <!--     ==================== product-list-new-best-feature ===================================-->
    <?php include_once 'product-list-new-best-feature.php'; ?>
    <!--    ========================= product-list-new-best-feature ========================================-->

    <!--     ==================== daily-deal-product-list ===================================-->
    <?php include_once 'daily-deal-product-list.php'; ?>
    <!--    ========================= daily-deal-product-list ========================================-->

    <!--     ==================== banner 2 ===================================-->
    <?php include_once 'banner-2.php'; ?>
    <!--    ========================= banner 2 ========================================-->

    <!--     ==================== trenning-product-list ===================================-->
    <?php include_once 'trenning-product-list.php'; ?>
    <!--    ========================= trenning-product-list ========================================-->

    <!--     ==================== banner 4 ===================================-->
    <?php include_once 'banner-4.php'; ?>
    <!--    ========================= end banner 4 ========================================-->

    <!--     ==================== slide grid product ===================================-->
    <?php include_once 'slide-grid-product.php'; ?>
    <!--    =========================slide grid product ========================================-->

    <!--     ==================== brand ===================================-->
    <?php include_once 'brand.php'; ?>
    <!--    ========================= brand ========================================-->

    <section class="sale_up mt-5" style="background: url(<?php echo $this->fiveBanner[0]['image']?>)">
        <div class="container-fluid">
            <div class="sale_up_content">
                <div class=" border_left_main">
                    <?php echo $this->fiveBanner[0]['title_1']; ?>
                </div>
                <p class="percent_off mt-2">
                    <?php echo $this->fiveBanner[0]['title_2']; ?> <span class="wireless_fetures font-weight-bold">
              <?php echo $this->fiveBanner[0]['title_3']; ?>
            </span>
                </p>

                <a href="<?php echo $this->fiveBanner[0]['url']; ?>" title="Shop Now" class="shop_now_headphone">Shop
                    Now</a>
            </div>
        </div>
    </section>

</main>