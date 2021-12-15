<?php
class ProductController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
    }
    public function detailAction(){
        $product_id = $this->_arrParam['id'];
        //$this->_model->detail($product_id);
        $result = $this->_model->info($product_id);
        if (empty($result)) header('Location: index.php');
        $this->_view->result = $result;
        $this->_view->listImages = $this->_model->getImage($product_id);
        $this->_view->render('product/detail');
    }
}