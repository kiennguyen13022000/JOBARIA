<section class="main_page main_page_cart">
    <div class="container">

        <table class="table table-bordered text-center"><thead>
            <tr>
                <th class=" th_remove">Remove</th>
                <th class="th_image">Images</th>
                <th class="th_name">Product</th>
                <th class="th_price">Unit Price</th>
            </tr>
            </thead><tbody>
            <tr class="product_cart" data-product-id="1">
                <td>
                     <a href="">
                         <i class="fas fa-heart"></i>
                     </a>
                </td>
                <td>
                    <a href="">
                        <img class="img_product" src="./assets/images/product/large-size/1.jpg" alt="">
                        <input name="img_product_1" type="hidden" value="./assets/images/product/large-size/1.jpg">
                    </a>
                </td>
                <td class="product_name_td">
                    <a href="detail.html" class="product_name">Janon vista fhd 4k</a>
                    <input name="product_name_1" type="hidden" value="Janon vista fhd 4k">
                </td>
                <td class="text-bold">
                    <span class="unit_price_product_text">$19.15</span>
                    <input type="hidden" data-product-id="1" value="19.15" class="unit_price_product_val">
                </td>

            </tr>
            </tbody>
        </table>

        <div id="empty_product" class="text-center">
            <img src="./assets/images/icon/trolley.png" alt="">
            <p class="title_block text-bold">
                Cart is empty.
                <a href="./index.html" title="Continue shopping" class="text-danger"> Continue
                    shopping <i class="fas fa-external-link-alt"></i> </a>
            </p>
        </div>

    </div>

</section>