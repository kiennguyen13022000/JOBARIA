<?php
$xhtml = '';
foreach ($this->sliders as $key => $value){
    $xhtml .= '<div class="slider_item">
                    <img class="w-100 h-100" src="'. $value['image'] .'">
                    <div class="slider_content_box">
                        <div class="container">
                            <div class="slider_content">
                                <div class="slider_content_1 text-uppercase font-weight-bold">'. $value['title_1'] .'</div>
                                <div class="slider_content_2 text-uppercase font-weight-bold">'. $value['title_2'] .'</div>
                                <div class="slider_content_3 text-uppercase font-weight-bold">'. $value['title_3'] .'
                                </div>
                                <div class="slider_content_4">'. $value['title_4'] .'</div>
                                <a class="shop_now" href="list.html" title="Shop now">Shop
                                    Now</a>
                            </div>
        
                        </div>
                    </div>
                </div>';
            }
?>
<section class="slider_box">
    <div class="owl-carousel jorbaria_slider">
        <?php echo $xhtml; ?>
    </div>

</section>