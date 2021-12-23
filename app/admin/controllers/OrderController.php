<?php

class OrderController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
    }

    public function editAction(){
        //error_reporting (E_ALL ^ E_NOTICE);
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->title     = 'Order detail';
        $this->_view->errors = null;

        $task = 'add';
        $this->_view->button_form = '<button class="btn btn-primary" type="submit">Save</button>';
        $requiredPass = true;
        $this->_view->result= array();
        $order_id = $this->_arrParam['id'];

        if (isset($order_id)){
            $this->_view->button_form = '<button class="btn btn-primary" type="submit">Update</button>';
            $task = 'edit';
            $requiredPass = false;
            $result = $this->_model->info($order_id);
            if (empty($result)) header('Location: index.php?module=admin&controller=order&action=list');
            $this->_view->result = $result;
            $this->_view->product_order = $this->_model->listProductOrder($order_id);
            $this->_view->title     = 'Order detail';
            $this->_view->id = $order_id;
        }
        $this->_view->task = $task;
        $this->_view->errors    = null;

        if(isset($this->_arrParam['form'])){
            $form = $this->_arrParam['form'];
            $form['id']=$this->_model->edit($this->_arrParam, $task);
            if($this->_model->affectedAction() == 1){
                if ($task == 'add'){
                    Session::set('success', '\'' . 'edit'.  '\'' );
                    Url::redirect('admin', 'order', 'edit',['task' => 'edit', 'id' => $form['id']]);
                }else{
                    $id = $this->_arrParam['id'];
                    Session::set('success', '\'' . 'edit'.  '\'' );
                    Url::redirect('admin', 'order', 'edit',['task' => 'edit', 'id' => $id]);
                }
            }
        }
        $this->_view->control = $this->_arrParam['controller'];
        $this->_view->render('order/edit');
    }
    public function listAction(){
        $this->_view->title = 'List order';
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->data = $this->_model->list();
        $this->_view->control = $this->_arrParam['controller'];
        $this->_view->render('order/list');
    }
    public function deleteAction(){
        $table = $this->_arrParam['table'];
        if (empty($table)) $table = 'orders';
        $query = "SELECT id FROM product_order WHERE order_id=".$this->_arrParam['id'];
        $listProductOrder = $this->_model->ListRecord($query);

        if (!empty($listProductOrder)){
            foreach ($listProductOrder as $k=>$v){
                $this->_model->deleteItem($v['id'], 'product_order');
            }
        }
        $affected = $this->_model->deleteItem($this->_arrParam['id'], $table);
        echo json_encode(['affected' => $affected]);
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