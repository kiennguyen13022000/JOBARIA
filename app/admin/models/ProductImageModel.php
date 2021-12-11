<?php

class ProductImageModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('product_image');
    }
}