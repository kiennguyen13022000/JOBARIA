<?php

class SettingController extends Controller
{
    public function indexAction(){

        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->title     = 'General';
        $this->_view->errors    = null;

        if(!empty($_FILES['header_logo'])) $this->_arrParam['form']['header_logo'] = $_FILES['header_logo'];
        if(!empty($_FILES['footer_logo'])) $this->_arrParam['form']['footer_logo'] = $_FILES['footer_logo'];

        if(isset($this->_arrParam['form'])){
            $form = $this->_arrParam['form'];
            $validate   = new Validate($form);
            $validate->addRule('header_logo', 'file', ['extension' => ['png', 'jpg']], false)
                ->addRule('address', 'min', ['min' => 3])
                ->addRule('email', 'email')
                ->addRule('phone', 'phone')
                ->addRule('footer_logo', 'file', ['extension' => ['png', 'jpg']], false);
            $validate->run();
            if(!empty($validate->getError())){
                $this->_view->errors = $validate->getError();
                $this->_view->result = $validate->getResult();
            }else{
                $form = $validate->getResult();
                $ud = $this->_model->form($form);

                if($ud >= 1){
                    Session::set('success', '\'' . 'edit'.  '\'' );
                    Url::redirect('admin', 'setting', 'index');
                }
            }
        }
        $this->_view->control = $this->_arrParam['controller'];
        $this->_view->action = $this->_arrParam['action'];
        $this->_view->result = $this->_model->getConfig();
        $this->_view->render('settings/index');
    }
    public function listTemplateAction(){
        $this->_view->title = 'List Template';
        $this->createLinkCss();
        $this->createLinkJs();
        $field = 'id,template_name';
        $this->_view->data = $this->_model->list($field,'email_template');
        $this->_view->control = $this->_arrParam['controller'];
        $this->_view->action = $this->_arrParam['action'];
        $this->_view->render('settings/listTemplate');
    }
    public function emailTemplateAction(){
        $this->createLinkCss();
        $this->createLinkJs();
        $email_template_id = $this->_arrParam['id'];
        if (isset($this->_arrParam['form'])){
            $arrParams = $this->_arrParam['form'];
            //$arrParams['user_id']      = $_SESSION['userAdmin']['user_id'];
            //$arrParams['created_at']   = date('Y-m-d H:i:s', time());
            $arrParams['updated_at']   = date('Y-m-d H:i:s', time());
            $this->_model->setTable('email_template');
            if( $this->_model->Update($arrParams, [['id', $email_template_id, '']])){
                Session::set('success', '\'' . 'emailTemplate'.  '\'' );
                Url::redirect('admin', 'setting', 'emailTemplate', ['id' => $this->_arrParam['id']]);
            }
        }

        $data = $this->_model->info($email_template_id,'email_template');
        $this->_view->data = $data;
        $this->_view->title = !empty($data['template_name']) ? $data['template_name'] : 'Email template';
        $this->_view->control = $this->_arrParam['controller'];
        $this->_view->action = $this->_arrParam['action'];
        $this->_view->id = $email_template_id;
        $this->_view->render('settings/email_template');
    }
    private function createLinkCss(){
        $css = array(
            array(
                'link' => 'public/template/admin/libs\datatables\dataTables.bootstrap4.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/libs\datatables\responsive.bootstrap4.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/libs\datatables\buttons.bootstrap4.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/libs\datatables\select.bootstrap4.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/notification/index.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/images\custom\favicon.ico',
                'type' => '',
                'rel'  => 'shortcut icon'
            ),
            array(
                'link' => 'https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css',
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
        ,
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
                'link' => 'public/template/admin/libs\datatables\jquery.dataTables.min.js',
            ),
            array(
                'link' => 'public/template/admin\libs\datatables\dataTables.bootstrap4.js',
            ),
            array(
                'link' => 'public/template/admin\libs\datatables\dataTables.responsive.min.js',
            ),
            array(
                'link' => 'public/template/admin\libs\datatables\responsive.bootstrap4.min.js',
            ),
            array(
                'link' => 'public/template/admin\libs\datatables\dataTables.buttons.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs\datatables\buttons.bootstrap4.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs\datatables\buttons.html5.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs\datatables\buttons.flash.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs\datatables\buttons.print.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs\datatables\dataTables.keyTable.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs\datatables\dataTables.select.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs\pdfmake\pdfmake.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs\pdfmake\vfs_fonts.js',
            ),
            array(
                'link' => 'public/template/admin/js\pages\datatables.init.js',
            ),
            array(
                'link' => 'public/notification/index.js',
            ),
            array(
                'link' => 'public/template/admin/js\app.min.js',
            ),
            array(
                'link' => 'public/template/admin/js\main.js',
            )
        );

        $link = '';
        foreach ($css as $key => $value){
            $link .= '<script src="'. $value['link'] .'"></script>';
        }

        $this->_view->linkJs = $link;
    }
}