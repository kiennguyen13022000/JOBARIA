<?php

class IndexController extends Controller
{
    public function indexAction(){
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->sliders               = $this->_model->listSlider();
        $this->_view->topBanners            = $this->_model->getTopBanners(1);
        $this->_view->newProductList        = $this->_model->getNewProductList();
//        $this->_view->bestsellerProductList = $this->_model->getBestsellerProductList();
        $this->_view->featureProductList    = $this->_model->getFeatureProductList();
        $this->_view->dailyDealProduct      = $this->_model->getDailyDealProduct();
        $this->_view->secondBanner          = $this->_model->getTopBanners(2);
        $this->_view->thirdBanner           = $this->_model->getTopBanners(3);
        $this->_view->trenningProductList   = $this->_model->getTrenningProductList();
        $this->_view->fourBanner            = $this->_model->getTopBanners(4);
        $this->_view->fiveBanner            = $this->_model->getTopBanners(5);
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->render('index/index');
    }

    public function infoAction(){
        $this->_view->productInfo           = $this->_model->info($this->_arrParam['id']);
        $this->_view->render('index/modal', false);
    }
}