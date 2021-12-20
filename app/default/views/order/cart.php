<?php
?>
<main id="main" class="page_list">
    <nav aria-label="breadcrumb" class="nav_breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Success</li>
            </ol>
        </div>

    </nav>
    <section class="main_page main_page_cart">
        <div class="container">
            <div class="main_cart">
                <div class="checkout_form_box">
                    <form action="" method="post" class="checkout_form">
                        <div class="cart_table_box">
                            <table id="cart_table" class="table table-bordered text-center cart_table">

                            </table>
                        </div>

                        <ul class="coupon_box nav">
                            <li class="nav-item w-100 intro_promotion text-danger font_size_15 mb-2">
                                <div>
                                    <span>***</span> Jobaria is having a program to give away a promotional code of
                                    20%
                                    of the total product value for all customers.
                                    <br> Enter code
                                    MUACUCDA to receive promotion.
                                </div>
                            </li>

                            <li class="nav-item d-flex align-items-center mr-auto flex-wrap">
                                <input type="text" class="coupon_input mr-1" name="coupon_input"
                                       placeholder="Coupon code">
                                <button type="button"
                                        class="btn btn_semi_black text-bold text-uppercase btn_check_coupon mr-2">
                                    Appy Coupon
                                </button>
                                <div class="notification_promotion mt-3 mt-md-0"></div>
                            </li>
                            <li class="nav-item d-none">
                                <button type="button"
                                        class="btn btn_semi_black text-bold text-uppercase btn_update_cart">
                                    Update cart
                                </button>
                            </li>
                        </ul>
                        <h2 class="mt-4">Cart totals</h2>
                        <div class="cart_total_details text-bold">
                            <div class="card_block">
                                <span>Subtotal</span>
                                <span class="float-right"><span id="sub_total_products_text">$00.00</span></span>
                                <input type="hidden" value="0" name="sub_total_products">
                            </div>
                            <div class="cart_promotion">
                                <hr class="separator">
                                <div class="card_block text-danger">
                                    <span>Promotion</span>
                                    <span class="float-right"><span class="promotion_text"></span></span>
                                    <input type="hidden" value="0" class="promotion" name="promotion">
                                </div>
                            </div>
                            <hr class="separator">
                            <div class="card_block">
                                <span>Total</span>
                                <span class="float-right"><span class="price_total_text"
                                                                id="price_total_products">$00.00</span></span>
                                <input type="hidden" value="0" name="price_total_products">
                            </div>

                        </div>
                        <input type="hidden" name="number_type" value="0">
                        <button type="button" class="btn btn_semi_black btn_proceed_checkout">
                            Proceed To Checkout
                        </button>
                    </form>
                </div>

                <div id="empty_product" class="text-center">
                    <img src="public/template/default/assets/images/icon/trolley.png" alt="">
                    <p class="title_block text-bold">
                        Cart is empty.
                        <a href="./index.html" title="Continue shopping" class="text-danger"> Continue
                            shopping <i class="fas fa-external-link-alt"></i> </a>
                    </p>
                </div>
            </div>
        </div>

    </section>
</main>
