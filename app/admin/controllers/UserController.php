<?php

class UserController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
    }


    /**
     * @throws Exception
     */
    public function formAction(){
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->title     = 'Add user';
        $task = 'add';
        $this->_view->errors    = null;
        $requiredPass = true;
        if(!empty($_FILES['avatar'])) $this->_arrParam['form']['avatar'] = $_FILES['avatar'];
        if (isset($this->_arrParam['id'])){
            $this->_view->result = $this->_model->info($this->_arrParam['id']);
            $this->_view->result['password'] = '';
            $task = 'edit';
            $requiredPass = false;
            $this->_view->title     = 'Edit user';
            $this->_view->id = $this->_arrParam['id'];
        }
        if(isset($this->_arrParam['form'])){
            $queryUserName = "select `id` from `users` where `username` = ". "'" . $this->_arrParam['form']['username'] . "'";
            $queryEmail = "select `id` from `users` where `email` = " . "'" . $this->_arrParam['form']['email'] . "'";
            $form = $this->_arrParam['form'];
            if (isset($this->_arrParam['id'])){
                $queryUserName .= " and `id` <> ". $this->_arrParam['id'];
                $queryEmail .= " and `id` <> ". $this->_arrParam['id'];
                $form['id'] = $this->_arrParam['id'];
            }

            $validate   = new Validate($form);
            $validate->addRule('firstname', 'min', ['min' => 3])
                     ->addRule('lastname', 'min', ['min' => 3])
                     ->addRule('username', 'string-notExistsRecord', ['database' => $this->_model, 'query' => $queryUserName ,'min' => 3])
                     ->addRule('email', 'email-notExistsRecord', ['database' => $this->_model, 'query' => $queryEmail])
                     ->addRule('password', 'password', ['action' => 'add'], $requiredPass)
                     ->addRule('avatar', 'file', ['extension' => ['png', 'jpg']], false)
                     ->addRule('confirm_password', 'confirm_password', null , $requiredPass);

            $validate->run();
            if(!empty($validate->getError())){
                $this->_view->errors = $validate->getError();
                $this->_view->result = $validate->getResult();
            }else{
                $form = $validate->getResult();

                $this->_model->form($form, $task);
                if($this->_model->affectedAction() == 1){
                    if ($task == 'add'){
                        Session::set('success', '\'' . 'add'.  '\'' );
                        Url::redirect('admin', 'user', 'form');
                    }else{
                        Session::set('success', '\'' . 'edit'.  '\'' );
                        Url::redirect('admin', 'user', 'form', ['task' => 'edit', 'id' => $this->_arrParam['id']]);
                    }

                }
            }


        }
        $this->_view->task = $task;
        $this->_view->render('user/form');
    }

    public function indexAction(){
        $this->_view->title = 'List user';
        $this->createLinkCss();
        $this->createLinkJs();

        $this->_view->data = $this->_model->list();
        $this->_view->render('user/index');
    }

    public function deleteAction(){
        $info = $this->_model->info($this->_arrParam['id']);


        try
        {
            $affected = $this->_model->deleteItem($this->_arrParam['id']);
            if ($affected > 0){
                $upload = new Upload();
                $upload->removeFile('users', null, $info['avatar']);
                Session::set('success', '\'' . 'delete' . '\'');
            }
        }catch (Exception $e){

        }


        echo json_encode(['affected' => $affected]);
    }

    public function changeStatusAction(){
        $id = $this->_arrParam['id'];
        $status = $this->_arrParam['status'] == 1 ? 0 : 1;
        $affected = $this->_model->changeStatus($id, $status);
        echo json_encode(['affected' => $affected, 'status' => $status]);
    }
    public function changeIsAdminAction(){
        $id = $this->_arrParam['id'];
        $isAdmin = $this->_arrParam['isAdmin'] == 1 ? 0 : 1;
        $affected = $this->_model->changeIsAdmin($id, $isAdmin);
        echo json_encode(['affected' => $affected, 'isAdmin' => $isAdmin]);
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