<?php

class UserModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('users');
    }

    public function list(){
        $query = 'select * from users';
        $this->Query($query);
        $result = $this->ListRecord();
        return  $result;
    }

    public function form($params, $task){
         if($task == 'add'){
             $arrParams = $params['form'];
             $arrParams['user_id']    = 1;
             $arrParams['created_at'] = date('Y-m-d H:i:s');
             $arrParams['password']   = md5($arrParams['password']);
             unset($arrParams['confirm_password']);
             $uploadObj = new Upload();
             $arrParams['avatar'] = $uploadObj->uploadFile($arrParams['avatar'], 'users', 100, 130);
             $this->Insert($arrParams);

         }else{
             $arrParams['updated_at'] = date('Y-m-d H:i:s');
             $id = $params['id'];
             unset($arrParams['confirm_password']);
             $arrParams['password']   = md5($arrParams['password']);
             if (empty($arrParams['password']))
                 unset($arrParams['password']);

             if (isset($arrParams['avatar']['name'])){
                $info = $this->info($id);
                $imageOld = 'public/upload/user/' . $info['avatar'];
                unset($imageOld);
                $uploadObj = new Upload();
                $arrParams['avatar'] = $uploadObj->uploadFile($arrParams['avatar'], 'users', 100, 130);
             }

             $this->Update($arrParams, [['id', $id, '']]);
         }
    }

    public function deleteItem($id){
       return $this->Delete([$id]);
    }

    public function info($id){
        $query = 'select * from users where `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }

}