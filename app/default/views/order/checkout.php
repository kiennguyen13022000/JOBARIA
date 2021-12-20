<?php
$login_collapse = '';
$show = 'show';
if($this->_loggedIn != 1){
    $login_collapse = ' 
                <div class="card_checkout">
                        <div class="card_header">
                            <h5 class="mb-0 text-normal">
                                <i class="fas fa-calendar color_main"></i>
                                <span class="pl-3">Returning customer? </span>
                                <a href="javascript:void(0);" class="log_in" data-toggle="collapse"
                                   data-target="#collapseOne" aria-expanded="true"
                                   aria-controls="collapseOne">Click
                                    here to login</a>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" data-parent="#accordion_checkout">
                            <div class="card-body cart-body-login">
                                <form method="post" action="'.$this->REQUEST_URI.'" class="log_in_form">
                                    <h6 class="mb-0">Please login to place order</h6>
                                    <div class="help-block '.$this->block_errors.'">
                                        <ul class="list-unstyled">
                                            <li class="alert alert-danger">'.$this->message_errors.'</li>
                                        </ul>
                                    </div>
                                    <div class="input_box">
                                        <div class="form-group">
                                            <label for="" class="mb-0">
                                                Username or email <span class="text-red">*</span>
                                            </label>
                                            <input class="form-control" type="text" name="login[username]" placeholder="">

                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-0">
                                                Password <span class="text-red">*</span>
                                            </label>
                                            <input class="form-control" type="password" name="login[password]" placeholder="">
                                        </div>
                                        <div class="form-group mb-1 d-flex align-items-center">
                                            <button type="submit" class="btn btn_semi_black btn_login text-uppercase mr-3">
                                                Login
                                            </button>
                                            <div class="remember_checkbox  d-flexx align-items-center d-none">
                                                <input type="checkbox" value="1" class="mb-1 mr-1" id="remember_checkbox">
                                                <label class="cursor-pointer mb-0" for="remember_checkbox">Remember
                                                    me</label>
                                            </div>

                                        </div>
                                        <p class="mb-0"><a href="forgot.html" title="Lost the password">Lost the password</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            ';
    $show = '';
}

?>
<main id="main" class="page_list">
    <nav aria-label="breadcrumb" class="nav_breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>

    </nav>
    <section class="main_page main_page_checkout">
        <div class="container">
            <div class="main_page_checkout">
                <div id="accordion_checkout">
                    <?php echo $login_collapse ?>

                    <div class="card_checkout">
                        <div class="card_header">
                            <h5 class="mb-0 text-normal">
                                <i class="fas fa-calendar color_main"></i>
                                <span class="pl-3">Have a coupon? </span>
                                <a href="javascript:void(0);" class="log_in" data-toggle="collapse"
                                   data-target="#collapseTwo" aria-expanded="true"
                                   aria-controls="collapseTwo">Click here to enter your code</a>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse <?php echo $show?>" data-parent="#accordion_checkout">
                            <div class="card-body pl-0">
                                <div class="text-danger ">
                                    <span>***</span> Jobaria is having a program to give away a promotional code of
                                    20%
                                    of the total product value for all customers.
                                    <br> Enter code
                                    MUACUCDA to receive promotion.
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="text" class="coupon_input mr-1" name="coupon_input"
                                           placeholder="Coupon code">
                                    <button type="button"
                                            class="btn btn_semi_black btn_check_coupon btn_check_coupon_checkout  mr-2">
                                        Appy Coupon
                                    </button>
                                    <div class="notification_promotion"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <form class="billing_order_form needs-validation" novalidate method="post" action="">

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="billing_details">
                                <h2 class="text-uppercase title">Billing details</h2>
                                <div class="form-group country_group">
                                    <label for="" class="mb-0">
                                        Country <span>*</span>
                                    </label>
                                    <select name="country" class="form-control select_country">
                                        <option value="1">VietNam</option>
                                        <option value="2">China</option>
                                        <option value="3">England</option>
                                        <option value="4">USA</option>
                                        <option value="5">Banglades</option>
                                        <option value="6">Thailand</option>
                                        <option value="7">Cambodia</option>
                                        <option value="8">Myanmar</option>
                                        <option value="9">Laos</option>
                                        <option value="10">Korea</option>
                                        <option value="11">Brazil</option>
                                        <option value="12">Singapore</option>
                                        <option value="13">Malaysia</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="" class="mb-0">
                                                First Name <span>*</span>
                                            </label>
                                            <input class="form-control  " required type="text" name="first_name"
                                                   placeholder="">
                                            <div class="invalid-feedback">
                                                Please provide a valid First name.
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="" class="mb-0">
                                                Last Name <span>*</span>
                                            </label>
                                            <input class="form-control  " required type="text" name="last_name"
                                                   placeholder="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Lastname.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="" class="mb-0">
                                        Company Name
                                    </label>
                                    <input class="form-control" type="text" name="company_name" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="mb-0">
                                        Address <span>*</span>
                                    </label>
                                    <input class="form-control  " required type="text" name="address"
                                           placeholder="Street address">
                                    <div class="invalid-feedback">
                                        Please provide a valid address.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control  " required type="text" name="optional"
                                           placeholder="Apartment, suite, unit ect (optional)">
                                    <div class="invalid-feedback">
                                        Please provide Apartment, suite, unit ect (optional).
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="mb-0">
                                        Town / city <span>*</span>
                                    </label>
                                    <input class="form-control  " required type="text" name="company_name"
                                           placeholder="">
                                    <div class="invalid-feedback">
                                        Please provide a valid Town / city.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="" class="mb-0">
                                                State / country <span>*</span>
                                            </label>
                                            <input class="form-control  " required type="text" name="state"
                                                   placeholder="">
                                            <div class="invalid-feedback">
                                                Please provide a valid State / country.
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="" class="mb-0">
                                                Postcode / Zip <span>*</span>
                                            </label>
                                            <input class="form-control  " required type="text" name="postcode"
                                                   placeholder="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Postcode / Zip.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="" class="mb-0">
                                                Email Address <span>*</span>
                                            </label>
                                            <input class="form-control  " required type="email" name="email"
                                                   placeholder="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Email Address.
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="" class="mb-0">
                                                Phone <span>*</span>
                                            </label>
                                            <input class="form-control  " required type="text" name="phone"
                                                   placeholder="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Phone.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group d-none">
                                    <div class=" d-flex align-items-center">
                                        <input type="checkbox" name="create_accoung" value="1" class="mb-1 mr-1"
                                               id="create_accoung">
                                        <label class="cursor-pointer mb-0" for="create_accoung">Create account</label>
                                    </div>
                                </div>
                            </div>
                            <div class="defferent_address">
                                <h2 class="text-uppercase title d-flex align-items-center mb-4">SHIP TO A
                                    DIFFERENT
                                    ADDRESS
                                    <input type="checkbox" value="1" name="ship_defferent_address"
                                           class="ml-4 mb-2 cursor-pointer check_ship_defferent_address">
                                </h2>
                                <div class="defferent_address_block">
                                    <div class="form-group country_group">
                                        <label for="" class="mb-0">
                                            Country <span>*</span>
                                        </label>
                                        <select name="shipping_address[country]" class="form-control select_country">
                                            <option value="1">VietNam</option>
                                            <option value="2">China</option>
                                            <option value="3">England</option>
                                            <option value="4">USA</option>
                                            <option value="5">Banglades</option>
                                            <option value="6">Thailand</option>
                                            <option value="7">Cambodia</option>
                                            <option value="8">Myanmar</option>
                                            <option value="9">Laos</option>
                                            <option value="10">Korea</option>
                                            <option value="11">Brazil</option>
                                            <option value="12">Singapore</option>
                                            <option value="13">Malaysia</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-0">
                                            First Name <span>*</span>
                                        </label>
                                        <input class="form-control required" type="text" name="shipping_address[first_name]"
                                               placeholder="">
                                        <div class="invalid-feedback">
                                            Please provide a valid First Name.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-0">
                                            Last Name <span>*</span>
                                        </label>
                                        <input class="form-control required" type="text" name="shipping_address[last_name]"
                                               placeholder="">
                                        <div class="invalid-feedback">
                                            Please provide a valid Last Name.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="mb-0">
                                            Company Name
                                        </label>
                                        <input class="form-control" type="text" name="shipping_address[company_name]" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-0">
                                            Address <span>*</span>
                                        </label>
                                        <input class="form-control required" type="text" name="shipping_address[address]"
                                               placeholder="Street address">
                                        <div class="invalid-feedback">
                                            Please provide a valid Address.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control required" type="text" name="shipping_address[optional]"
                                               placeholder="Apartment, suite, unit ect (optional)">
                                        <div class="invalid-feedback">
                                            Please provide a valid Apartment, suite, unit ect (optional).
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-0">
                                            Town / city <span>*</span>
                                        </label>
                                        <input class="form-control required" type="text" name="shipping_address[company_name]"
                                               placeholder="">
                                        <div class="invalid-feedback">
                                            Please provide a valid Town / city.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-0">
                                            State / country <span>*</span>
                                        </label>
                                        <input class="form-control required" type="text" name="shipping_address[state]" placeholder="">
                                        <div class="invalid-feedback">
                                            Please provide a valid State / country.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-0">
                                            Postcode / Zip <span>*</span>
                                        </label>
                                        <input class="form-control required" type="text" name="shipping_address[postcode]"
                                               placeholder="">
                                        <div class="invalid-feedback">
                                            Please provide a valid Postcode / Zip.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-0">
                                            Email Address <span>*</span>
                                        </label>
                                        <input class="form-control required" type="email" name="shipping_address[email]" placeholder="">
                                        <div class="invalid-feedback">
                                            Please provide a valid Email Address.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-0">
                                            Phone <span>*</span>
                                        </label>
                                        <input class="form-control required" type="text" name="shipping_address[phone]" placeholder="">
                                        <div class="invalid-feedback">
                                            Please provide a valid Phone.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="mb-0">
                                        Order notes
                                    </label>
                                    <textarea placeholder="Notes about your order" class="form-control" name="notes"
                                              id="" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-4 mt-lg-0 mb-4 mb-lg-0">
                            <div class="infor_order_box">
                                <h2 class="text-uppercase title">Your Order</h2>
                                <table class="table" id="checkout_table">

                                </table>
                                <p class="text-bold mb-1 font_size_20 text-333">Direct Bank Transfer</p>
                                <div class="mb-2">
                                    Make you payment directly into our bank account. Please use you order ID as the
                                    payment reference. Your order won't be shipped util the funds have clear in our
                                    account.
                                </div>
                                <p class="text-bold mb-1 font_size_20 text-333">Cheque Payment</p>
                                <p class="text-bold mb-1 font_size_20 text-333">PayPal</p>
                                <input type="hidden" name="loggedIn" value="<?php echo $this->_loggedIn ?>">
                                <input type="hidden" name="submitForm" value="submitForm">
                                <button type="submit"
                                        class="btn_place_order btn text-bold  mt-4 text-uppercase">Place
                                    Order</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</main>
