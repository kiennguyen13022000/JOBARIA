<?php
    $htmlWishList = '';
    foreach ($this->historyOrder as $value){
//        $url    = '/product/' . trim($value['product_name']). '-' . $value['id'];
//        $link = Url::filterURL($url) . '.html';
        $payment_status = $value['status'];
        //$category_name = $this->_model->getCategoryName($value['category_id']);
        if ($payment_status == 2){
            $payment_status_html = '
                                <div><span class="badge badge-soft-success">Paid</span>
                                                            </div>
                            ';
        }elseif ($payment_status == 1){
            $payment_status_html = '
                                <div><span class="badge bg-warning">Unpaid</span></div>
                            ';
        }elseif ($payment_status == 4){
            $payment_status_html = '
                            <div><span class="badge badge-soft-danger">Cancelled</span></div>
                        ';
        }else{
            $payment_status_html = '
                                <div><span class="badge badge-soft-warning">Awaiting Confirm</span></div>
                            ';
        }
        $status         = $value['status'] == 1 ? 'Shipped' : 'Delivered';
        $classStatus    = $value['status'] == 1 ? 'activeStatus' : 'deactive';
        $htmlWishList .= '<tr class="favorites_product" data-product-id="1">
                                <td>
                                     <a href="javascript:void(0)" class="font-weight-bold" data-id="'. $value['id'] .'">
                                        '. $value['code'] .'
                                     </a>
                                </td>
                                <td>
                                    '. $value['first_name'] . ' ' . $value['last_name'] .'
                                </td>
                                <td class="product_name_td">
                                    '. $value['created_at'] . '
                                </td>
                                <td class="product_name_td">
                                    '. $payment_status_html . '
                                </td>
                                <td class="text-bold">
                                    <span class="unit_price_product_text">$'. number_format($value['total'], 0, ',', '.') .'</span>                               
                                </td>
                                 <td >
                                    <a href="/order/'.$value['id'].'" class="action-icon"><i class="fas fa-eye"></i></a>                              
                                </td>
                            </tr>';
    }

    $table = ' <table class="table table-bordered text-center"><thead>
                    <tr>
                        <th class=" th_remove">Code</th>
                        <th class="th_image">Fullname</th>
                        <th class="th_name">Created</th>
                         <th class="th_name">Status</th>
                        <th class="th_price">Total</th>
                        <th class="th_price">Action</th>
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
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order history</li>
        </ol>
    </div>

</nav>
<section class="main_page main_page_cart">
    <div class="container">
        <?php
            if (count($this->historyOrder ) > 0)
                echo $table;
            else
                echo '<div id="empty_product" class="text-center">
                        <img src="./assets/images/icon/trolley.png" alt="">
                        <p class="title_block text-bold">
                            History is empty.
                            <a href="./index.html" title="Continue shopping" class="text-danger"> Continue
                                shopping <i class="fas fa-external-link-alt"></i> </a>
                        </p>
                    </div>';
        ?>
    </div>
</section>