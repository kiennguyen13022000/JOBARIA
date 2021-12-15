<?php
    $bannerOne      = '';
    $bannerTwo      = '';
    $bannerThree    = '';
    $bannerFour     = '';
    error_reporting (E_ALL ^ E_NOTICE);
    if (!empty($this->secondBanner[0]['image'])){
        $bannerOne = '<a href="'. $this->secondBanner[0]['url'] .'" class="">
                            <img class="w-100 h-100" src="'. $this->secondBanner[0]['image'] .'" alt="">
                        </a>';
    }

    if (!empty($this->secondBanner[1]['image'])){
        $bannerTwo = '<a href="'. $this->secondBanner[1]['url'] .'" class="">
                                <img class="w-100 h-100" src="'. $this->secondBanner[1]['image'] .'" alt="">
                            </a>';
    }

    if (!empty($this->secondBanner[2]['image'])){
        $bannerThree = '<a href="'. $this->secondBanner[2]['url'] .'" class="">
                                <img class="w-100 h-100" src="'. $this->secondBanner[2]['image'] .'" alt="">
                            </a>';
    }
    if (!empty($this->secondBanner[3]['image'])){
        $bannerFour = '<a href="'. $this->secondBanner[3]['url'] .'" class="">
                                <img class="w-100 h-100" src="'. $this->secondBanner[3]['image'] .'" alt="">
                            </a>';
    }

?>
<section class="news_box">
    <div class="container-fluid">
        <div class="row banner2">
            <div class="col-lg-6 px-0 banner__item">
                <div class="bg__hover__top"></div>
                <?php echo $bannerOne; ?>
                <div class="bg__hover__bottom"></div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-sm-6 px-0 banner__item">
                        <div class="bg__hover__top"></div>
                        <?php echo $bannerTwo; ?>
                        <div class="bg__hover__bottom"></div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="row flex-column">
                            <div class="col px-0 banner__item">
                                <div class="bg__hover__top"></div>
                                <?php echo $bannerThree; ?>
                                <div class="bg__hover__bottom"></div>
                            </div>
                            <div class="col px-0 banner__item">
                                <div class="bg__hover__top"></div>
                                <?php echo $bannerFour; ?>
                                <div class="bg__hover__bottom"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="headphone_box" style="background-image: url(<?php echo $this->thirdBanner[0]['image']; ?>)">
        <div class="bg__hover__top"></div>
        <div class="bg__hover__bottom"></div>

        <div class="container">
            <div class="headphone_content ">
                <div class="headphone_sale border_left_main">
                    <?php echo $this->thirdBanner[0]['title_1']; ?>
                </div>

                <p class="title__headphone">
                    <?php echo $this->thirdBanner[0]['title_2']; ?>
                </p>

                <div class="headphone__content limit_line_3"><?php echo $this->thirdBanner[0]['title_3']; ?></div>
                <a href="<?php echo $this->thirdBanner[0]['url']; ?>" title="Shop Now" class="shop_now_headphone">Shop
                    Now</a>
            </div>
        </div>
    </div>
</section>