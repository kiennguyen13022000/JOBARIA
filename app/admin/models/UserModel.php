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
        $result = $this->ListRecord($query);
        return $result;
    }
    public function form($arrParams, $task){
         if($task == 'add'){
             $arrParams['user_id']    = $_SESSION['userAdmin']['user_id'];;
             $arrParams['created_at'] = date('Y-m-d H:i:s', time());
             $arrParams['password']   = md5($arrParams['password']);
             unset($arrParams['confirm_password']);
             $uploadObj = new Upload();
             $arrParams['avatar'] = $uploadObj->uploadFile($arrParams['avatar'], 'users', 100, 100);
             $arrParams = $this->prepare($arrParams);
             return $this->Insert($arrParams);

         }else{
             $arrParams['updated_at'] = date('Y-m-d H:i:s', time());
             $id = $arrParams['id'];
             unset($arrParams['confirm_password']);
             if (empty($arrParams['password']))
                 unset($arrParams['password']);
             else
                 $arrParams['password']   = md5($arrParams['password']);

             if (!empty($arrParams['avatar']['name'])){
                $info = $this->info($id);
                $uploadObj = new Upload();
                $uploadObj->removeFile('users', null, $info['avatar']);
                $arrParams['avatar'] = $uploadObj->uploadFile($arrParams['avatar'], 'users', 100, 100);
             }else{
                 unset($arrParams['avatar']);
             }
             $arrParams = $this->prepare($arrParams);
             $this->Update($arrParams, [['id', $id, '']]);
         }
    }

    public function deleteItem($id){
       return $this->Delete([$id]);
    }

    public function changeStatus($id, $status){
       $param   = array('status' => $status);
       $where   = array(array('id', $id, ''));
       return $this->Update($param, $where);
    }
    public function changeIsAdmin($id, $isAdmin){
        $param   = array('is_Admin' => $isAdmin);
        $where   = array(array('id', $id, ''));
        return $this->Update($param, $where);
    }
    public function info($id){
        $query = 'select * from users where `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }

    public function changePassword($user_id, $password){
        $password = md5($password);
        return $this->Update(['password' => $password], [['id', $user_id, '']]);
    }

}