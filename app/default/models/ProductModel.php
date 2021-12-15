<?php
class ProductModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
    }
    public function detail($product_id){

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
}
