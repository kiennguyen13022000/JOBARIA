<?php

class OrderModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('orders');
    }

    public function list(){
        $query = 'SELECT * FROM orders';
        $result = $this->ListRecord($query);
        return  $result;
    }
    public function edit($params, $task){
        $this->setTable('products');
        $arrParams = $params['form'];
        $arrParams['user_id'] = $_SESSION['userAdmin']['user_id'];
        $arrParams['content'] = addslashes($arrParams['content']);
        $arrParams['description'] = addslashes($arrParams['description']);
        $arrParams['product_features'] = addslashes($arrParams['product_features']);
        if($task == 'add'){
            $arrParams['created_at'] = date('Y-m-d H:i:s');
            $uploadObj = new Upload();
            $arrParams['image'] = $uploadObj->getUrlFile($params['edit']['image'], 'product', 300, 300);
            $arrParams['position']= 1;
            $sql = "UPDATE products SET position = position + 1";
            $this->Query($sql);
            return $this->Insert($arrParams);
        }else{
            $arrParams['updated_at'] = date('Y-m-d H:i:s');
            $id = $arrParams['id'] = $params['id'];
            $arrParams['image'] = $params['edit']['image'];
            if (!empty($arrParams['image']['name'])){
                $info = $this->info($id);
                $uploadObj = new Upload();
                $uploadObj->removeFileName($info['image'], null);
                $arrParams['image'] = $uploadObj->getUrlFile($arrParams['image'], 'product', 300, 300);
            }else{
                unset($arrParams['image']);
            }
            return $this->Update($arrParams, [['id', $id, '']]);
        }
    }
    public function deleteItem($id, $table){
        if (empty($table)) $table = 'orders';
        $this->setTable($table);
        return $this->Delete([$id]);
    }
    public function info($id){
        $this->setTable('orders');
        $query = 'SELECT * FROM orders WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }
    public function listProductOrder($id){
        $this->setTable('product_order');
        $query = 'SELECT * FROM product_order WHERE `order_id` = ' . $id;
        $result = $this->ListRecord($query);
        return $result;
    }
    public function changeStatus($id, $status){
        $param   = array('status' => $status);
        $where   = array(array('id', $id, ''));
        return $this->Update($param, $where);
    }
}
