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
        if($task == 'add'){
            $arrParams = $params['form'];
            $arrParams['user_id']    = 1;
            $arrParams['created_at'] = date('Y-m-d H:i:s');

            $uploadObj = new Upload();
            $arrParams['image'] = $uploadObj->getUrlFile($params['edit']['image'], 'product', 300, 300);
            $arrParams['position']= 1;
            $sql = "UPDATE products SET position = position + 1";
            $this->Query($sql);

            return $this->Insert($arrParams);
        }else{
            $arrParams = $params['form'];
            $arrParams['updated_at'] = date('Y-m-d H:i:s');
            $id = $arrParams['id'] = $params['id'];
            $arrParams['image'] = $params['edit']['image'];

            if (isset($arrParams['image'])){
                $info = $this->info($id);
                $uploadObj = new Upload();
                $uploadObj->removeFileName($info['image'], null);
                $arrParams['image'] = $uploadObj->getUrlFile($arrParams['image'], 'product', 300, 300);
            }
            return $this->Update($arrParams, [['id', $id, '']]);
        }
    }
    public function deleteItem($id){
        return $this->Delete([$id]);
    }
    public function info($id){
        $query = 'select * from products where `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }
    public function getImage($id){
        $this->setTable('product_image');
        $result = $this->ListRecord("SELECT * FROM product_image WHERE product_id=".$id);
        return $result;
    }
    public function addImage($id){
        $this->setTable('product_image');
        $result = $this->Insert("SELECT * FROM product_image WHERE product_id=".$id);
        return !empty($result) ? $result : array();
    }
}
