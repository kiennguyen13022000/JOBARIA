<?php

class UserController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
    }

    public function formAction(){
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->title     = 'add user';
        $validate   = new Validate();
        $this->form             = $this->_model->form($this->_view->_arrParam['form']);

        if(isset($this->_arrParam['form'])){
            echo '<pre>';
            print_r($this->_arrParam['form']);
            echo '</pre>';
        }

        $this->_view->render('user/form');
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