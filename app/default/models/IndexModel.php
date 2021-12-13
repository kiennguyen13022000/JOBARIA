<?php

class IndexModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
    }

    public function listSlider(){
        $this->SetTable('slides');
        $query  = "select * from `$this->table` where `status` = 1";
        return $this->ListRecord($query);
    }

    public function getTopBanners(){
        $this->SetTable('banners');
        $query  = "select * from `$this->table` where `position` = 1";
        return $this->ListRecord($query);
    }
    public function getNewProductList(){
        $this->SetTable('products');
        $query  = "select p.*, c.name as category_name from `$this->table` as p join `categories` as c";
        $query .= " on p.category_id = c.id";
        $query .= " where p.`is_new` = 1";

        return $this->ListRecord($query);
    }
}