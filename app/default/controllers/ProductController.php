<?php
class ProductController extends Controller
{
    public function detailAction(){
       // error_reporting (E_ALL ^ E_NOTICE);
        $product_id = $this->_arrParam['id'];
        $result = $this->_model->info($product_id);
        if (empty($result) || $result['status'] == 0) header('Location: index.php');
        $this->_view->product_id = $product_id;
        $this->_view->result = $result;
        $listImages = $this->_model->getImage($product_id);
        $this->_view->listImages = $listImages;
        $script_img = ' var items_img_product =[';
        if (!empty($this->_arrParam['image'])) {
            $script_img .= '
                {
                    src: "/jobaria/'.$this->_arrParam['image'].'",
                    w: 600,
                    h: 600
                },
            ';
        }
        if (!empty($listImages)){
            foreach ($listImages as $k=>$v){
                $script_img .= '
                {
                    src: "/jobaria/'.$v['image'].'",
                    w: 600,
                    h: 600
                },
            ';
            }
        }
        $script_img .=']';
        $this->_view->script_img = $script_img;
       // $this->_view->newProductList        = $this->_model->getNewProductList();
        $this->_view->other_products = $this->_model->other_products($product_id, $result['category_id']);
        $this->_view->render('product/detail');
    }

    public function reviewAction(){
        $id = $this->_model->review($this->_arrParam['form'], $this->_arrParam['id']);
        if ($id > 0){
            Session::set('review', '\'' . 'success' . '\'');
            $value = $this->_model->productInfo($this->_arrParam['id']);
            $url    = $value['breakcrumbs'] . '/' . trim($value['product_name']). '_' . $value['id'];
            $url = Url::filterURL($url) . '.html';
            Url::redirect(null,  null, null, null, $url);
        }
    }

    private function createLinkCss(){
        $css = array(
            array(
                'link' => 'public/template/admin/libs/datatables/dataTables.bootstrap4.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),

        );

        $link = '';

        foreach ($css as $key => $value){
            $link .= '<link href="'. $value['link'] .'" rel="'. $value['rel'] .'" type="'. $value['type'] .'">';
        }

        $this->_view->linkCss = $link;
    }
    private function createLinkJs(){
        $css = array(
            array(
                'link' => 'public/template/admin/js/vendor.min.js',
            ),
        );

        $link = '';
        foreach ($css as $key => $value){
            $link .= '<script src="'. $value['link'] .'"></script>';
        }

        $this->_view->linkJs = $link;
    }
}