<?php
    $htmlSearchProduct = '';
    foreach ($this->searchProducts as $value){
        $img =  $value['image'];
        $url    = $value['breakcrumbs'] . '/' . trim($value['product_name']). '_' . $value['id'];
        $link = Url::filterURL($url) . '.html';
        $htmlSearchProduct .= '<div class="col-4 mb-2">
                                    <div class=" search-product p-1 d-flex">
                                        <a href="/'.$link.'" class="img-search-product d-inline-block">
                                            <img class="img-fluid rounded" src="'.$img.'">
                                        </a>
                                        <a class="" href="/'.$link.'">
                                            <span class="text-dark font-13 text-product-search pl-2">'.$value['product_name'].'</span>
                                        </a>
                                    </div>
                                </div>';
    }
?>
<div class="border-top py-3 col-12">
    <div class="row">
        <?php echo $htmlSearchProduct; ?>
    </div>
</div>
