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

    public function review($review, $product_id){
        $this->SetTable('reviews');
//        $review['user_id']      = $_SESSION['userAdmin']['user_id'];
        $review['status']         = 1;
        $review['product_id']     = $product_id;
        $review['created_at']     = date('Y-m-d H:i:s', time());
        return $this->Insert($review);
    }

    public function productInfo($id){
        $query[]    = "select p.*, child.name as categoryName, GROUP_CONCAT(DISTINCT parent.name order by parent.left) as breakcrumbs";
        $query[]    = "from `products` as p join `categories` as child, `categories` as parent";
        $query[]    = "WHERE p.id = $id and p.category_id = child.id";
        $query[]    = "and child.left BETWEEN parent.left AND parent.right";
        $query[]    = "AND parent.left > 0 ";
        $query[]    = "GROUP BY p.id";
        $strQuery   = implode(' ', $query);
        $result = $this->OneRecord($strQuery);
        $queryChildImage = 'select image from `product_image` where `product_id` = ' . $id;
        $result['childImage'] = $this->ListRecord($queryChildImage);
        return $result;
    }

    public function other_products1($product_id, $category_id){
        $query = 'SELECT id,image,product_name,price,category_id,is_new,promotion,promotion_end_date FROM products WHERE status=1 and category_id='.$category_id.' and id!='.$product_id.' limit 0,12';
        $result = $this->ListRecord($query);
        return  $result;
    }
    public function getCategoryName($category_id){
        $this->SetTable('categories');
        $query = 'SELECT name FROM categories WHERE id='.$category_id;
        $result = $this->OneRecord($query);
        return  $result;
    }
    public function other_products($product_id, $category_id){
        $this->SetTable('products');
        $query = 'select p.id,p.image,p.product_name,p.price,p.category_id,p.is_new,p.promotion,p.promotion_end_date, child.name as categoryName, GROUP_CONCAT(DISTINCT parent.name order by parent.left) as breakcrumbs from `products` as p , `categories` as child, `categories` as parent WHERE p.id != '.$product_id.' AND p.status = 1 and p.category_id = '.$category_id.' AND p.category_id = child.id and child.left BETWEEN parent.left AND parent.right AND parent.left > 0 GROUP BY p.id limit 0,12';
        return $this->ListRecord($query);
    }
}
