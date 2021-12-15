<?php

class ProductController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
    }

    public function editAction(){
        error_reporting (E_ALL ^ E_NOTICE);
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->title     = 'Add product';
        $this->_view->errors = null;
        if(!empty($_FILES['image'])) $this->_arrParam['edit']['image'] = $_FILES['image'];
        $task = 'add';
        $this->_view->button_form = '<button class="btn btn-primary" type="submit">Save</button>';
        $requiredPass = true;
        $this->_view->result= array();
        $product_id = $this->_arrParam['id'];
        $this->_view->getListCategories = $this->_model->getListCategories($product_id);

        if (isset($product_id)){
            $this->_view->button_form = '<button class="btn btn-primary" type="submit">Update</button>';
            $task = 'edit';
            $requiredPass = false;
            $result = $this->_model->info($product_id);
            if (empty($result)) header('Location: index.php?module=admin&controller=product&action=list');
            $this->_view->result = $result;
            $this->_view->title     = $this->_view->result['product_name'].' | Product';
            $this->_view->id = $product_id;
            $this->_view->listImages = $this->_model->getImage($product_id);

        }

        $this->_view->task = $task;
        $this->_view->errors    = null;

        //$validate   = new Validate();
        // $this->form             = $this->_model->form($this->_view->_arrParam['form']);


        if(isset($this->_arrParam['form'])){
            $form = $this->_arrParam['form'];
            $form['image'] = $_FILES['image'];
            $validate   = new Validate($form);
            $validate->addRule('product_name', 'min', ['min' => 1])
                ->addRule('price', 'int_min', ['min' => 0])
                ->addRule('quantity', 'int_min', ['min' => 0])
                ->addRule('image', 'file', ['extension' => ['png', 'jpg', 'gif']], false);
            $validate->run();

            if(!empty($validate->getError())){
                $this->_view->errors = $validate->getError();
                $this->_view->result = $validate->getResult();
            }else{
                $form['id']=$this->_model->edit($this->_arrParam, $task);
                if($this->_model->affectedAction() == 1){
                    if ($task == 'add'){
                        Session::set('success', '\'' . 'edit'.  '\'' );
                        Url::redirect('admin', 'product', 'edit',['task' => 'edit', 'id' => $form['id']]);
                    }else{
                        $id = $this->_arrParam['id'];
                        Session::set('success', '\'' . 'edit'.  '\'' );
                        Url::redirect('admin', 'product', 'edit',['task' => 'edit', 'id' => $id]);
                    }
                }
            }
        }
        $this->_view->render('product/edit');
    }
    public function listAction(){
        $this->_view->title = 'List product';
        $this->createLinkCss();
        $this->createLinkJs();

        $this->_view->data = $this->_model->list();

        $this->_view->render('product/list');
    }
    public function deleteAction(){
        $table = $this->_arrParam['table'];
        if (empty($table)) $table = 'products';
        $info = $this->_model->info($this->_arrParam['id']);
        $affected = $this->_model->deleteItem($this->_arrParam['id'], $table);
        if ($affected > 0){
            $upload = new Upload();
            $upload->removeFileName($info['image'], null);
            Session::set('success', '\'' . 'delete' . '\'');
        }
        echo json_encode(['affected' => 1]);
    }
    public function addImageAction(){

        $product_id = $_POST['product_id'];

        $img_product = !empty($_FILES['img_product']) ? $_FILES['img_product'] : array();
        $uploadObj = new Upload();
        $arrParams['product_id'] = $product_id;
        $arrParams['position']= 1;
        $sql = "UPDATE product_image SET position = position + 1";
        $this->_model->setTable('product_image');
        $this->_model->Query($sql);
        $image = $uploadObj->getUrlFile($img_product, 'product', 300, 300);
        $arrParams['image'] = $image;

        $this->_model->Insert($arrParams);
        //$listImages = $this->_model->getImage($product_id);
        $html = '
            <div class="nav-item">
                <img class="preview__image img_product"
                     src="'.$image.'">
            </div>
        ';
        echo json_encode(array(
            'msg' => 'ok',
            'html' => $html
        ));
    }
    public function changeStatusAction(){
        $id = $this->_arrParam['id'];
        $status = $this->_arrParam['status'] == 1 ? 0 : 1;
        $affected = $this->_model->changeStatus($id, $status);
        echo json_encode(['affected' => $affected, 'status' => $status]);
    }
    private function createLinkCss(){
        $css = array(
            array(
                'link' => 'public/template/admin/libs/datatables/dataTables.bootstrap4.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/responsive.bootstrap4.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/buttons.bootstrap4.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/select.bootstrap4.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/notification/index.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => 'public/template/admin/images/custom/favicon.ico',
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
                'link' => 'public/template/admin/js/vendor.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/jquery.dataTables.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/dataTables.bootstrap4.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/dataTables.responsive.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/responsive.bootstrap4.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/dataTables.buttons.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/buttons.bootstrap4.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/buttons.html5.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/buttons.flash.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/dataTables.keyTable.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/buttons.print.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/datatables/dataTables.select.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/pdfmake/pdfmake.min.js',
            ),
            array(
                'link' => 'public/template/admin/libs/pdfmake/vfs_fonts.js',
            ),
            array(
                'link' => 'public/template/admin/js/pages/datatables.init.js',
            ),
            array(
                'link' => 'public/notification/index.js',
            ),
            array(
                'link' => 'public/template/admin/js/app.min.js',
            ),
            array(
                'link' => 'public/template/admin/js/main.js',
            ),
            array(
                'link' => 'public/template/admin/js/ajax.js',
            ),
            array(
                'link' => 'public/template/admin/js/jquery.form.js',
            )
        );

        $link = '';
        foreach ($css as $key => $value){
            $link .= '<script src="'. $value['link'] .'"></script>';
        }

        $this->_view->linkJs = $link;
    }
}