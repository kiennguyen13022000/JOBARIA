<?php
class OrderController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
    }
    public function cartAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->_module = $this->_arrParam['module'];
        $this->_view->_controller = $this->_arrParam['controller'];
        $this->_view->_action = $this->_arrParam['action'];
        $this->_view->render('order/cart');
    }
    public function successAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->_module = $this->_arrParam['module'];
        $this->_view->_controller = $this->_arrParam['controller'];
        $this->_view->_action = $this->_arrParam['action'];
        $this->_view->render('order/success');
    }
    public function checkoutAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->_loggedIn = 1;
        if(!empty($_SESSION['user'])){
            $user_id = $_SESSION['user']['user_id'];
            $query = "SELECT id FROM users WHERE id='$user_id' and status=1 & is_Admin=0";
            $info_user = $this->_model->OneRecord($query);
        }
        if (empty($_SESSION['user']['loggedIn']) || empty($info_user)){
            Session::delete('user');
            //header('Location: /login-redirect?redirect=checkout');
            $this->_view->_loggedIn = 0;
        }
        $this->_view->block_errors = '';
        $this->_view->message_errors = '';

        if(isset($this->_arrParam['login'])){
            $login = $this->_model->login($this->_arrParam);
            if (!empty($login)){
                if (!empty($redirect)){
                    header('Location: /'.$redirect);die();
                }
                header('Location: /checkout');die();
            }
            $this->_view->block_errors = 'd-block';
            $this->_view->message_errors = 'Incorrect account or password';
        }
        if(isset($this->_arrParam['submitForm']) && $this->_arrParam['submitForm'] =='submitForm'){

            $client_id = $_SESSION['user']['user_id'];
            $number_type = $_POST['number_type'];
            $getMaxId = $this->_model->getMaxId();
            $orderParams['code'] = '#ORDER'.$getMaxId;
            $orderParams['status'] = 0;
            $orderParams['created_at'] = date('Y-m-d H:i:s');
            $orderParams['client_id'] = $client_id;
            $orderParams['sub_total'] = $_POST['sub_total'];
            $orderParams['total'] = $_POST['total'];
            $orderParams['payment_method'] = 1;
            $orderParams['discount_percent'] = $_POST['promotion'];
            $orderParams['coupon_code'] = !empty($_POST['promotion']) ? 'MUACUCDA' : $_POST['coupon_code'];
            $orderParams['country'] = $_POST['country'];
            $orderParams['first_name'] = $_POST['first_name'];
            $orderParams['last_name'] = $_POST['last_name'];
            $orderParams['company_name'] = $_POST['company_name'];
            $orderParams['address'] = $_POST['address'];
            $orderParams['optional'] = $_POST['optional'];
            $orderParams['state'] = $_POST['state'];
            $orderParams['postcode'] = $_POST['postcode'];
            $orderParams['email'] = $_POST['email'];
            $orderParams['phone'] = $_POST['phone'];
            $ship_defferent_address = !empty($_POST['ship_defferent_address']) ? 1 : 0;
            $orderParams['ship_defferent_address'] = $ship_defferent_address;
            $orderParams['shipping_address'] = !empty($ship_defferent_address) ? json_encode( $_POST['shipping_address'], JSON_UNESCAPED_UNICODE ) : '';

            $order_id = $this->_model->Insert($orderParams);
            if (!empty($order_id)){
                $this->_model->sendMail($orderParams);
                $arrayParrams = array();
                for ($i = 0; $i <$number_type; $i++){
                    $arrayParrams['order_id'] = $order_id;
                    $arrayParrams['product_id'] = $_POST['product_id'][$i];
                    $arrayParrams['quantity'] = $_POST['number_product'][$i];
                    $arrayParrams['price_old'] = $_POST['price'][$i];
                    $arrayParrams['price'] = $_POST['new_price'][$i];
                    $arrayParrams['promotion'] = $_POST['promotion_product'][$i];
                    $arrayParrams['product_name'] = $_POST['product_name'][$i];
                    $arrayParrams['image'] = $_POST['image'][$i];
                    // $arrayParrams[$i]['color'] = $_POST['color'][$i];
                    //$arrayParrams[$i]['size'] = $_POST['size'][$i];
                    //$field = 'product_name,slug';
                    //$info = $this->_model->infoDetail($_POST['product_id'][$i],$field);
                    $this->_model->add($arrayParrams,'product_order');
                }
            }
            header('Location: /success');
        }
        $this->_view->_redirect = !empty($redirect) ? 1 : 0;
        $this->_view->REQUEST_URI = $_SERVER['REQUEST_URI'];
        $this->_view->_module = $this->_arrParam['module'];
        $this->_view->_controller = $this->_arrParam['controller'];
        $this->_view->_action = $this->_arrParam['action'];
        $this->_view->render('order/checkout');
    }
    public function checkCouponAction(){
        $coupon_code = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';
        $msg = 'error';

        if (trim($coupon_code) == 'MUACUCDA'){
            $msg = 'ok';
            $output['percent'] = 20;
            $output['percent_text'] = '-20%';
        }
        $output['msg'] = $msg;
        echo json_encode($output);die();
    }
    public function renderProductAction(){
        $coupon_code = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';
        $getlocalStorage = isset($_POST['getlocalStorage']) ? $_POST['getlocalStorage'] : array();
        $msg = 'ok';
        $number_type = 0;
        $productsContent = '';
        if (!empty($getlocalStorage)){
            $productsContent = '
                <thead>
                      <tr>
                        <th class=" th_remove">Remove</th>
                        <th class="th_image">Images</th>
                        <th class="th_name">Product</th>
                        <th class="th_price">Unit Price</th>
                        <th class="th_quantity">Quantity</th>
                        <th class="th_total">Total</th>
                      </tr>
                    </thead>
                    <tbody>
            ';
            $i = 0;
            foreach ($getlocalStorage as $k=>$v){
               // ++ $i ;
                ++$number_type;
                $product_id = $v['product_id'];
                $info = $this->_model->info($product_id);
                $link = $this->_model->getLink($product_id);
                $number_product = $v['number_product'];
                $price = $info['price'];
                $promotion = (int) $info['promotion'];
                if ($promotion > 0){
                    $new_price = number_format($price - $price * $promotion / 100, 2, '.', ',');
                }
                $price_product_by_num = number_format($new_price *  $number_product, 2, '.', ',');
                $productsContent .='
                        <tr class="product_cart" data-product-id="'.$product_id.'">
                            <td>
                              <a href="javascript:void(0)" onclick="delProduct(this);" data-index="'.$k.'" data-product-id="'.$product_id.'" class="_remove_product"><i
                                  class="fas fa-trash" aria-hidden="true"></i></a>
                            </td>
                            <td>
                              <a href="'.$link.'">
                                <img class="img_product" src="'.$info['image'].'" alt="">
                              </a>
                            </td>
                            <td class="product_name_td">
                                <a href="'.$link.'" class="product_name">'.$info['product_name'].'</a>
                            </td>
                            <td class="text-bold">
                              <span class="unit_price_product_text">$'.$new_price.'</span>
                              <input type="hidden" data-index="'.$k.'" value="'.$new_price.'"
                                class="unit_price_product_val">
                            </td>
                            <td class="">
                              <p class="mb-0 font_size_15">Quantity</p>
                              <div class="d-flex  justify-content-center">
                                <div class="quantity border-right position-relative">
                                  <button type="button" data-index="'.$k.'"
                                    class="quantity-button down  quantity_down_cart"><i
                                      class="fas fa-angle-down"></i></button>
                                  <input type="number" data-index="'.$k.'" min="1" max="'.$info['quantity'].'" value="'.$number_product.'"
                                    class="number_product" name="number_product_'.$product_id.'">
                                  <button type="button" data-index="'.$k.'"
                                    class="quantity-button up quantity_up_cart"><i
                                      class="fas fa-angle-up"></i></button>
                                </div>
                              </div>
                            </td>
                            <td class="text-bold">
                              <span class="total_price_product_text" data-index="'.$k.'">$'.$price_product_by_num.'</span>
                              <input name="price_product_by_num_'.$k.'" type="hidden" class="total_price_product" data-index="'.$k.'"
                                value="'.$price_product_by_num.'">
                            </td>
                          </tr>
                ';
            }
            $productsContent .= '</tbody>';
        }
        echo json_encode(array(
            'msg' => $msg,
            'number_type' => $number_type,
            'productsContent' => $productsContent,
        ));die();
    }
    public function renderCartAction(){
        $dataCart = isset($_POST['dataCart']) ? $_POST['dataCart'] : array();
        $msg = 'ok';
        $renderCartHtml = '';
        $total_products= 0 ;
        $total_price_cart = 0 ;
        if (!empty($dataCart)){
            $renderCartHtml .='
                 <ul class="nav ">
            ';
            $total_products = count($dataCart);
            foreach ($dataCart as $k=>$v){
                $product_id =$v['product_id'];
                $number_product = $v['number_product'];
                $info = $this->_model->info($product_id);
                $link = $this->_model->getLink($product_id);
                $price = $info['price'];
                $product_name = $info['product_name'];
                $promotion = (int) $info['promotion'];
                if ($promotion > 0){
                    $new_price = number_format($price - $price * $promotion / 100, 2, '.', ',');
                }
                $price_product_by_num = number_format($new_price *  $number_product, 2, '.', ',');
                $total_price_cart += $price_product_by_num;
                $renderCartHtml .='
                     <li class="py-3 border-bottom ">
                        <div class="row ">
                          <div class="col-3 pr-0 ">
                            <div class="position-relative ">
                              <a href="'.$link.'" title="'.$product_name.'" class="">
                              <img src="'.$info['image'].'" alt=" ">
                              </a>
                            </div>
                  
                          </div>
                          <div class="col-9 text-left ">
                            <a href="'.$link.'" title="'.$product_name.'" class="font-weight-bold cart__title__product__name ">'.$product_name.'</a>
                            <div class="text-danger py-1">$'.$new_price.'</div>
                            <span class="font-weight-light">Demension: 40cm x 60cm</span>
                          </div>
                        </div>
                      </li>
                ';
            }
            $renderCartHtml .= '
                </ul>
                    <table class="table table-sm w-100 table-borderless ">
                      <tr>
                        <td class="text-left">Subtotal</td>
                        <td class="text-right">$'.$total_price_cart.'</td>
                      </tr>
                      <tr>
                        <td class="text-left">Shipping</td>
                        <td class="text-right">$0.00</td>
                      </tr>
                      <tr>
                        <td class="text-left">Taxes</td>
                        <td class="text-right">$00.0</td>
                      </tr>
                      <tr>
                        <td class="text-left">Total</td>
                        <td class="text-right">$'.$total_price_cart.'</td>
                      </tr>
                    </table>
                    <a href="/cart.html" class="btn btn-secondary btn-block mb-3">Checkout</a>
            ';
        }
        echo json_encode(array(
            'msg' => $msg,
            'total_price_cart' => '$'.$total_price_cart,
            'total_products' => $total_products,
            'renderCartHtml' => $renderCartHtml,
        ));die();
    }
    public function renderPriceCheckoutAction(){
        $productsCart = isset($_POST['productsCart']) ? $_POST['productsCart'] : array();
        $checkOutStorage = isset($_POST['checkOutStorage'][0]) ? $_POST['checkOutStorage'][0] : array();

        $coupon_input = isset($_POST['coupon_input']) ? $_POST['coupon_input'] : '';


        $msg = 'ok';
        $checkOutContent = '';
        $total_products= 0 ;
        $total_price_cart = 0 ;
        if (!empty($checkOutStorage)){
            $sub_total_products = $checkOutStorage['sub_total_products'];
            $price_total_products = $sub_total_products;
            $promotion_cart = $checkOutStorage['promotion'];
            if (trim($coupon_input) == 'MUACUCDA'){
                $price_total_products = number_format($sub_total_products - $sub_total_products * 20 / 100, 2, '.', ',');

            }

            $checkOutContent .='
                 <tr class="text-center text-uppercase">
                    <td class="w-50">Product</td>
                    <td class="w-50">Total</td>
                  </tr>
            ';
            $total_type_products = count($productsCart);
            foreach ($productsCart as $k=>$v){
                $product_id =$v['product_id'];
                $number_product = $v['number_product'];
                $info = $this->_model->info($product_id);
                $link = $this->_model->getLink($product_id);
                $price = $info['price'];
                $product_name = $info['product_name'];
                $promotion = (int) $info['promotion'];
                if ($promotion > 0){
                    $new_price = number_format($price - $price * $promotion / 100, 2, '.', ',');
                }
                $price_product_by_num = number_format($new_price *  $number_product, 2, '.', ',');
                $total_price_cart += $price_product_by_num;
                $checkOutContent .='
                     <tr>
                        <td>
                        <input type="hidden" name="product_id[]" value="'.$product_id.'">
                        <input type="hidden" name="number_product[]" value="'.$number_product.'">
                        <input type="hidden" name="price[]" value="'.$price.'">
                        <input type="hidden" name="new_price[]" value="'.$new_price.'">
                        <input type="hidden" name="promotion_product[]" value="'.$promotion.'">
                        <input type="hidden" name="product_name[]" value="'.$product_name.'">
                        <input type="hidden" name="image[]" value="'.$info['image'].'">
                            <span class="product_name">'.$product_name.'</span> <span
                            class="text-bold number_product"> x'.$number_product.'</span>
                        </td>
                        <td> <span class="unit_price_product_text">$'.$price_product_by_num.' </span></td>
                    </tr>
                ';
            }
            $checkOutContent .= '
                    <tr class="text-bold">
                      <td><span class="text-bold">Subtotal</span></td>
                      <td>
                        <span class="sub_total_products_text">$'.$sub_total_products.'</span> 
                        <input type="hidden" name="sub_total" value="'.$sub_total_products.'">
                      </td>
                  </tr>
                  <tr class="cart_promotion text-danger">
                    <td><span class="text-bold  ">Promotion</span></td>
                    <td>
                    <span class="text-bold promotion_text">-'.$promotion_cart.'%</span>
                    <input type="hidden" name="promotion" value="'.$promotion_cart.'" class="promotion">
                    </td>
                  </tr>
                  <tr class="text-bold">
                    <td><span class="text-bold order_total ">Order
                        total</span></td>
                    <td>
                        <span class="price_total_products_text">$'.$price_total_products.'</span>
                        <input type="hidden" name="total" value="'.$price_total_products.'">
                        <input type="hidden" name="number_type" value="'.$total_type_products.'">
                    </td>
                  </tr>
            ';
        }
        echo json_encode(array(
            'msg' => $msg,
            'promotion_cart' => $promotion_cart,
            'checkOutContent' => $checkOutContent,
        ));die();
    }
}

