<?php

class IndexController extends Controller
{
    public function indexAction(){
        $this->_view->title = 'Admin';
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->control = $this->_arrParam['controller'];
        $this->_view->action = $this->_arrParam['action'];
        $this->_view->render('index/index');
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
            ),
            array(
                'link' => 'public/template/admin/libs/jquery-vectormap/jquery-jvectormap-1.2.2.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/css/style.css',
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
                'link' => 'public/template/admin/libs/apexcharts/apexcharts.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/jquery-sparkline/jquery.sparkline.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/jquery-vectormap/jquery-jvectormap-1.2.2.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/jquery-vectormap/jquery-jvectormap-world-mill-en.js',
            ),
            array(
                'link' => 'public/template/admin/libs/peity/jquery.peity.min.js',
            ),
            array(
                'link' => 'public/template/admin/js/pages/dashboard-2.init.js',
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