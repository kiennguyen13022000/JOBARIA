<?php

class ProductController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
    }

    public function editAction(){
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->title     = 'Add product';
        //$validate   = new Validate();
       // $this->form             = $this->_model->form($this->_view->_arrParam['form']);
       
        if(isset($this->_arrParam['edit'])){
            echo '<pre>';
            print_r($this->_arrParam['edit']);
            echo '</pre>';
        }

        $this->_view->render('product/edit');
    }
    function pre ($expression, $wrap = true){
		  $css = 'border:1px dashed #06f;padding:1em;text-align:left;';
		  if ($wrap) {
			$str = '<p style="' . $css . '"><tt>' . str_replace(
			  array('  ', "\n"), array('&nbsp; ', '<br />'),
			  htmlspecialchars(print_r($expression, true))
			) . '</tt></p>';
		  } else {
			$str = '<pre style="' . $css . '">'
			. htmlspecialchars(print_r($expression, true)) . '</pre>';
		  }
		  echo $str;
	}
    private function createLinkCss(){
        $css = array(
            array(
                'link' => 'public/template/admin/images\custom\favicon.ico',
                'type' => '',
                'rel'  => 'shortcut icon'
            ),
            array(
                'link' => 'ttps://unpkg.com/boxicons@2.0.9/css/boxicons.min.css',
                'type' => '',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/css/bootstrap.min.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/css/icons.min.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/css/app.min.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            )
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
                'link' => 'public/template/admin/js\vendor.min.js',
            ),
            array(
                'link' => 'public/template/admin/js\app.min.js',
            )
        );

        $link = '';
        foreach ($css as $key => $value){
            $link .= '<script src="'. $value['link'] .'"></script>';
        }

        $this->_view->linkJs = $link;
    }

}