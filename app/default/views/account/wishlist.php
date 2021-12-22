<?php
    $htmlWishList = '';
    foreach ($this->wishlists as $value){
        $url    = '/product/' . trim($value['product_name']). '-' . $value['id'];
        $link = Url::filterURL($url) . '.html';
        $htmlWishList .= '<tr class="favorites_product" data-product-id="1">
                                <td>
                                     <a href="javascript:void(0)" class="btn__favorites__page" data-id="'. $value['id'] .'">
                                         <i class="fas fa-heart"></i>
                                     </a>
                                </td>
                                <td>
                                    <a href="'. $link .'">
                                        <img class="img_product" src="'. $value['image'] .'" alt="">
                                    </a>
                                </td>
                                <td class="product_name_td">
                                    <a href="'. $link .'" class="product_name">'. $value['product_name'] .'</a>
                                </td>
                                <td class="text-bold">
                                    <span class="unit_price_product_text">$'. number_format($value['price'], 0, ',', '.') .'</span>                               
                                </td>
                            </tr>';
    }

    $table = ' <table class="table table-bordered text-center"><thead>
                    <tr>
                        <th class=" th_remove">Favorites</th>
                        <th class="th_image">Images</th>
                        <th class="th_name">Product</th>
                        <th class="th_price">Unit Price</th>
                    </tr>
                    </thead>
                    <tbody>
                        '. $htmlWishList .'
                    </tbody>
                </table>';
?>
<nav aria-label="breadcrumb" class="nav_breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="jobaria/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
        </ol>
    </div>

</nav>
<section class="main_page main_page_cart">
    <div class="container">
        <?php
            if (count($this->wishlists ) > 0)
                echo $table;
            else
                echo '<div id="empty_product" class="text-center">
                        <img src="./assets/images/icon/trolley.png" alt="">
                        <p class="title_block text-bold">
                            Wishlist is empty.
                            <a href="./index.html" title="Continue shopping" class="text-danger"> Continue
                                shopping <i class="fas fa-external-link-alt"></i> </a>
                        </p>
                    </div>';
        ?>
    </div>
</section>