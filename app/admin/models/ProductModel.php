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
        $this->Query($query);
        $result = $this->ListRecord();
        return  $result;
    }

    public function form($arrParams, $task){
        if($task == 'add'){
            $arrParams['user_id']    = 1;
            $arrParams['created_at'] = date('Y-m-d H:i:s');
            $arrParams['password']   = md5($arrParams['password']);
            unset($arrParams['confirm_password']);
            $uploadObj = new Upload();
            $arrParams['avatar'] = $uploadObj->uploadFile($arrParams['avatar'], 'users', 100, 130);
            $this->Insert($arrParams);

        }else{

        }
    }

}