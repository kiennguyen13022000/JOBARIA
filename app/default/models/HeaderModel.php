<?php

class HeaderModel extends Model
{
    public function productSearch($keyword){
        $query[]    = "select p.*, child.name as categoryName, GROUP_CONCAT(DISTINCT parent.name order by parent.left) as breakcrumbs";
        $query[]    = "from `products` as p join `categories` as child, `categories` as parent";
        $query[]    = "WHERE p.product_name like '%$keyword%' and p.category_id = child.id";
        $query[]    = "and child.left BETWEEN parent.left AND parent.right";
        $query[]    = "AND parent.left > 0 ";
        $query[]    = "GROUP BY p.id";
        $strQuery   = implode(' ', $query);
        $result     = $this->ListRecord($strQuery);
        return $result;
    }
}