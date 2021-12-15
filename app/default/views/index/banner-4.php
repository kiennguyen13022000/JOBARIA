<!-- banner  -->
<div class="container">
    <div class="row">
        <?php
            foreach ($this->fourBanner as $key => $value){
                echo '<div class="col-12 col-lg-6 px-0 mb-lg-0 mb-4">
                        <a href="">
                            <img class="w-100 h-100" src="'. $value['image'] .'" alt="">
                        </a>
                    </div>';
            }
        ?>
    </div>
</div>
