<?php
    $xhtml = '';
    foreach ($this->topBanners as $key => $value){
        $xhtml .= '<div
                    class="col-12 col-sm-6 col-lg-3  px-0 position-relative banner__item wow fadeIn animated "
                    data-wow-delay="0.2s">
                    <div class="bg__hover__top"></div>
                    <a href="" class="d-inline-block  "><img class="w-100 h-100"
                                                             src="'. $value['image'] .'" alt=""></a>
                    <div class="bg__hover__bottom"></div>
                </div>';
    }
?>
<section class="hot_product">
    <div class="container-fluid">
        <div class="row text-center">
            <?php echo $xhtml; ?>
        </div>
    </div>

</section>