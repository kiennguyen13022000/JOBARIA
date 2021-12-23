<?php

class AccountController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        if (!empty($_SESSION['user']['loggedIn'])){
            $user_id = $_SESSION['user']['user_id'];
            $query = "SELECT id FROM users WHERE id='$user_id' and status=1 & is_Admin=0";
            $info_user = $this->_model->OneRecord($query);
            if (empty($info_user)){
                Session::delete('user');
                header('Location: /');die();
            }
        }else{
            header('Location: /');
        }
    }
    public function wishlistAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->settings              = $this->_model->getSettings();
        $user = Session::get('user', []);
        $this->_view->wishlists     = $this->_model->getWishList($user);
        $this->_view->render('account/wishlist');
    }
    public function historyOrderAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->settings              = $this->_model->getSettings();
        $user = Session::get('user', []);
        $this->_view->historyOrder     = $this->_model->historyOrder($user);
        $this->_view->render('account/order-history');
    }
    public function orderDetailAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->settings              = $this->_model->getSettings();
        $user = Session::get('user', []);
        $user_id =$user['user_id'];
        $this->_view->title     = 'Order detail';
        $this->_view->errors = null;
        $this->_view->result= array();
        $order_id = $this->_arrParam['id'];
        if (!isset($order_id)){
            header('Location: /order-history');
        }
        $result = $this->_model->info($order_id,$user_id);
        if (empty($result)) header('Location: /order-history');
        $this->_view->product_order = $this->_model->listProductOrder($order_id);
        $this->_view->result = $result;
        $this->_view->title     = $result['code'].' | Order detail';
        $this->_view->id = $order_id;
        $this->_view->errors    = null;
        $this->_view->control = $this->_arrParam['controller'];
        $this->_view->render('account/order-detail');
    }
    public function addToFavoritesAction(){
        $user = Session::get('user', []);
        if (empty($user)){
            echo json_encode(['result' => 'error']);
        }
        else{
            $user_id = $user['user_id'];
            $id = $this->_arrParam['id'];
            $result = $this->_model->addToFavorites($id, $user_id);
            if ($result == 'already-exist')
                echo json_encode(['result' => $result]);
            else
                echo json_encode(['result' => 'success']);
        }
    }
}