<?php
    $listImages =  $this->listImages;
    $d_none='';
    if(empty($listImages) && empty($this->result['image'])) $d_none = 'd-none';
    $splide__list = '<ul class="splide__list">
                    <li class="splide__slide">
                        <img src="/'. $this->result['image'].'">
                    </li>
                ';
    if (!empty($listImages)){
        foreach ($listImages as $k => $v){
            $splide__list .='
                <li class="splide__slide">
                    <img '.$v['id'].' src="'.$v['image'].'">
                </li>
              ';
        }
    }
    $splide__list .= '</ul>';
?>
<div class="slider_detail_product <?php echo $d_none ?>">
    <div class="border">
        <!-- slide main -->
        <div id="" class="splide splide_detail">
            <button class="zoom__plus"><i class="fa fa-search-plus" aria-hidden="true"></i></button>
            <div class="splide__arrows">
                <!-- <button type="button" class="zoom_image d-none"><i class="fa fa-search-plus"
                    aria-hidden="true"></i></button> -->
                <button type="button" class="splide__arrow splide__arrow--prev"
                        aria-label="Go to last slide">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </button>
                <button type="button" class="splide__arrow splide__arrow--next"
                        aria-label="Next slide">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
            <div class="splide__track">
                <?php echo $splide__list ?>
            </div>
        </div>

    </div>
    <!-- slide thumb -->
    <div class="splide thumbnail_splide thumbnail_splide_detail mt-3">
        <div class="splide__track">
            <?php echo $splide__list ?>
        </div>
    </div>
</div>

