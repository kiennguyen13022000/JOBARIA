<?php

class IndexController extends Controller
{
    public function indexAction(){
        $this->_view->sliders           = $this->_model->listSlider();
        $this->_view->topBanners        = $this->_model->getTopBanners();
        $this->_view->newProductList    = $this->_model->getNewProductList();
        $this->_view->render('index/index');
    }
}