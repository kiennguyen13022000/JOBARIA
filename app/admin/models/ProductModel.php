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



    public function edit($params, $task){

        if($task == 'add'){
            $arrParams = $params['form'];
            $arrParams['user_id']    = 1;
            $arrParams['created_at'] = date('Y-m-d H:i:s');

            $uploadObj = new Upload();

            $arrParams['image'] = $uploadObj->getUrlFile($params['edit']['image'], 'product', 100, 130);


            return $this->Insert($arrParams);
        }else{
            $arrParams['updated_at'] = date('Y-m-d H:i:s');
            $id = $params['id'];

            if (isset($arrParams['image']['name'])){
                $info = $this->info($id);
                $imageOld = 'public/upload/product/' . $info['image'];
                unset($imageOld);
                $uploadObj = new Upload();
                $arrParams['avatar'] = $uploadObj->uploadFile($arrParams['image'], 'product', 100, 130);
            }

            $this->Update($arrParams, [['id', $id, '']]);
        }
    }
    public function info($id){
        $query = 'select * from products where `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }

}