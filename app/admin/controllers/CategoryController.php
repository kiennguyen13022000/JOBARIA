<?php

class CategoryController extends Controller
{
    public function formAction(){
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->title     = 'Add category';
        $task = 'add';
        $this->_view->errors    = null;
        $requiredPass = true;
        if(!empty($_FILES['image'])) $this->_arrParam['form']['image'] = $_FILES['image'];
        if (isset($this->_arrParam['id'])){
            $this->_view->result = $this->_model->info($this->_arrParam['id']);
            $task = 'edit';
            $requiredPass = false;
            $this->_view->title     = 'Edit category';
            $this->_view->id = $this->_arrParam['id'];
        }
        if(isset($this->_arrParam['form'])){
            $queryName = "select `id` from `categories` where `name` = ". "'" . $this->_arrParam['form']['name'] . "'";
            $form = $this->_arrParam['form'];
            if (isset($this->_arrParam['id'])){
                $form['id'] = $this->_arrParam['id'];
                $queryName .= " and `id` <> ". $this->_arrParam['id'];
            }
            $validate   = new Validate($form);
            $validate->addRule('name', 'string-notExistsRecord', ['database' => $this->_model, 'query' => $queryName ,'min' => 3])
                ->addRule('image', 'file', ['extension' => ['png', 'jpg']], false);
            $validate->run();
            if(!empty($validate->getError())){
                $this->_view->errors = $validate->getError();
                $this->_view->result = $validate->getResult();
            }else{
                $form = $validate->getResult();

                $id =  $this->_model->form($form, $task);
                if($this->_model->affectedAction() == 1){
                    if ($task == 'add'){
                        Session::set('success', '\'' . 'add'.  '\'' );
                        if ($this->_arrParam['submit'] == 'save')
                            Url::redirect('admin', 'category', 'form');
                        Url::redirect('admin', 'category', 'form', ['task' => 'edit', 'id' => $id]);

                    }
                    if ($task == 'edit'){
                        Session::set('success', '\'' . 'edit'.  '\'' );
                        Url::redirect('admin', 'category', 'form', ['task' => 'edit', 'id' => $this->_arrParam['id']]);
                    }

                }
            }
        }
        $this->_view->categories = $this->_model->getCategory();
        $this->_view->task = $task;
        $this->_view->control = $this->_arrParam['controller'];
        $this->_view->render('category/form');
    }

    public function indexAction(){
        $this->_view->title = 'List category';
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->control = $this->_arrParam['controller'];
        $this->_view->data = $this->_model->list();
        $this->_view->render('category/index');
    }

    public function deleteAction(){
        $info = $this->_model->info($this->_arrParam['id']);
        $affected = $this->_model->deleteItem($this->_arrParam['id']);
        if ($affected > 0){
            if(!empty($info['image'])){
                $upload = new Upload();
                $upload->removeFile('category', null, $info['image']);
            }
            Session::set('success', '\'' . 'delete' . '\'');
        }
        echo json_encode(['affected' => $affected]);
    }
    public function moveNodeAction(){
        $data = $this->_model->moveNode($this->_arrParam['type'], $this->_arrParam['id']);
        $this->_view->data = $data;
        $this->_view->render('category/datatable', false);
    }
    public function changeStatusAction(){
        $id = $this->_arrParam['id'];
        $status = $this->_arrParam['status'] == 1 ? 0 : 1;
        $affected = $this->_model->changeStatus($id, $status);
        echo json_encode(['affected' => $affected, 'status' => $status]);
    }
    public function changeTrendingAction(){
        $id = $this->_arrParam['id'];
        $trending = $this->_arrParam['trending'] == 1 ? 0 : 1;
        $affected = $this->_model->changeTrending($id, $trending);
        echo json_encode(['affected' => $affected, 'trending' => $trending]);
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