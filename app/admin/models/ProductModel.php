<?php

class ProductModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('products');
    }

    public function list(){
        $query = 'select * from products';
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
        if (empty($table)) $table = 'products';
        $this->setTable($table);
        return $this->Delete([$id]);
    }
    public function info($id){
        $this->setTable('products');
        $query = 'select * from products where `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }
    public function getImage($id){
        $this->setTable('product_image');
        $result = $this->ListRecord("SELECT * FROM product_image WHERE product_id=".$id);
        return $result;
    }
    public function getListCategories($id){
        $this->setTable('categories');
        $result = $this->ListRecord("SELECT * FROM categories WHERE status = 1 order by `left`");
        return $result;
    }
    public function addImage($id){
        $this->setTable('product_image');
        $result = $this->Insert("SELECT * FROM product_image WHERE product_id=".$id);
        return !empty($result) ? $result : array();
    }
    public function changeStatus($id, $status){
        $param   = array('status' => $status);
        $where   = array(array('id', $id, ''));
        return $this->Update($param, $where);
    }
    public function changeStatusReview($id, $status){
        $this->SetTable('reviews');
        $param   = array('status' => $status);
        $where   = array(array('id', $id, ''));
        return $this->Update($param, $where);
    }
    public function reviewDelete($id){
        $this->SetTable('reviews');
        return $this->Delete([$id]);
    }

    public function getReviews($id){
        $query = "select rv.*, u.avatar from `reviews` as rv left join `users` as u on u.id = rv.user_id where `product_id` = $id";
        $reviews = $this->ListRecord($query);

        return $reviews;
    }

}
