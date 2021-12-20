<?php

class HeaderController extends Controller
{
    public function productSearchAction(){

        $keyword = $this->_arrParam['keyword'];
        $result = $this->_model->productSearch($keyword);
        if (!empty($result) && !empty($keyword)){
            $this->_view->searchProducts = $result;
            $this->_view->render('header/search-product-list', false);
        }

    }
}