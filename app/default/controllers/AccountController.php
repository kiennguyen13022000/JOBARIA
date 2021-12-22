<?php

class AccountController extends Controller
{
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