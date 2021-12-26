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
        $this->_view->action = $this->_arrParam['action'];
        $this->_view->render('category/form');
    }

    public function indexAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->title = 'List category';
        $this->createLinkCss();
        $this->createLinkJs();
        $category_id = $this->_arrParam['id'];
        $this->_view->control = $this->_arrParam['controller'];
        $type = isset($_GET["type"])? $_GET["type"] : '';
        $price_range = isset($_GET["price_range"])? (int) $_GET["price_range"] : 0;
        $current_page = isset($_GET["page"])? (int) $_GET["page"] : 1;
        $per_page = isset($_GET["per_page"])? (int) $_GET["per_page"] : 6;
        $limit_page = $current_page  > 1 ? $per_page * ($current_page - 1)  : 0;
        $limit_cond= " limit ".$limit_page.",".$per_page;
        if (isset($_POST['filter_form']) && $_POST['filter_form'] == 'filter_form'){
            $link = '/search?';
            $cat_id = isset($_POST['cat_id']) ? $_POST['cat_id'] : array();
            $cat_id = !empty($cat_id) ? implode(',',$cat_id) : '';
            if (!empty($cat_id)){
                $link .='&cat_id='.$cat_id;
            }
            $price_range = isset($_POST['price_range']) ? $_POST['price_range'] : '';
            if (!empty($price_range)){
                $link .='&price_range='.$price_range;
            }
            $per_page = isset($_POST['per_page']) ? $_POST['per_page'] : 6;
            if (!empty($per_page)){
                $link .='&per_page='.$per_page;
            }
            header('Location: '.$link);die();
        }
        $data = $this->_model->list($category_id,'products',$limit_cond);
        $this->_view->data = $data;
        $total_result = $this->_model->countRecord($category_id,'products');
        $pagination = new Pagination($total_result, $per_page, $current_page);
        //$REQUEST_URI = isset($_GET["page"]) ? $_SERVER['REQUEST_URI'] : '';
        $this->_view->getLinksHtml = $pagination->getLinksHtml('', 'page');
        $this->_view->action = $this->_arrParam['action'];
        $this->_view->total_result = $total_result;
        $this->_view->category_id = $category_id;
        $this->_view->REDIRECT_URL = $_SERVER['REDIRECT_URL'];
        $this->_view->REQUEST_URI = $_SERVER['REQUEST_URI'];
        $this->_view->type = $type;
        $this->_view->price_range = $price_range;
        $this->_view->per_page = $per_page;
        $this->_view->render('category/index');
    }
    public function searchAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->title = 'Filter';
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->control = $this->_arrParam['controller'];
        $type = isset($_GET["type"])? $_GET["type"] : '';
        $current_page = isset($_GET["page"])? (int) $_GET["page"] : 1;
        $per_page = isset($_GET["per_page"])? (int) $_GET["per_page"] : 6;
        $limit_page = $current_page  > 1 ? $per_page * ($current_page - 1)  : 0;
        $limit_cond= " limit ".$limit_page.",".$per_page;
        $cond = '1 = 1 ';
        if (isset($_POST['filter_form']) && $_POST['filter_form'] == 'filter_form'){
            $link = '/search?';
            $cat_id = isset($_POST['cat_id']) ? $_POST['cat_id'] : array();
            $cat_id = !empty($cat_id) ? implode(',',$cat_id) : '';

            if (!empty($cat_id)){
                $link .='&cat_id='.$cat_id;
            }
            $price_range = isset($_POST['price_range']) ? $_POST['price_range'] : '';
            if (!empty($price_range)){
                $link .='&price_range='.$price_range;
            }
            $per_page = isset($_POST['per_page']) ? $_POST['per_page'] : 6;
            if (!empty($per_page)){
                $link .='&per_page='.$per_page;
            }
            header('Location: '.$link);die();
        }
        $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
        if (!empty($cat_id)){
            $cond .= ' and child.id IN ('.$cat_id.')';
        }
        $price_range = isset($_GET['price_range']) ? (int) $_GET['price_range'] : 0;
        if (!empty($price_range)){
           if ($price_range == 1){
               $from = 0;
               $to = 30;
               $cond .= ' and p.price <='.$to;
           }elseif ($price_range == 2){
               $from = 30;
               $to = 60;
               $cond .= ' and p.price >='.$from.' and p.price <= '.$to;
           }elseif ($price_range == 3){
               $from = 60;
               $to = 120;
               $cond .= ' and p.price >='.$from.' and p.price <= '.$to;
           }elseif ($price_range == 4){
               $from = 120;
               $to = 200;
               $cond .= ' and p.price >='.$from.' and p.price <= '.$to;
           }elseif ($price_range == 5){
               $from = 200;
               $cond .= ' and p.price >='.$from;
           }
        }
        $data = $this->_model->listSearch('products',$cond,$limit_cond);
        $this->_view->data = $data;
        $total_result = $this->_model->countRecordSearch('products',$cond);
        $pagination = new Pagination($total_result, $per_page, $current_page);
        //$REQUEST_URI = isset($_GET["page"]) ? $_SERVER['REQUEST_URI'] : '';
        $this->_view->getLinksHtml = $pagination->getLinksHtml('', 'page');
        $this->_view->action = $this->_arrParam['action'];
        $this->_view->total_result = $total_result;
        $this->_view->REDIRECT_URL = $_SERVER['REDIRECT_URL'];
        $this->_view->REQUEST_URI = $_SERVER['REQUEST_URI'];

        $this->_view->per_page = $per_page;
        $this->_view->type = $type;
        $this->_view->cat_id = $cat_id;
        $this->_view->price_range = $price_range;
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