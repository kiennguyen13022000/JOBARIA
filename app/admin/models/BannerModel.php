<?php

class BannerModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('banners');
    }

    public function list(){
        $query = "select * from `$this->table` order by `position`";
        $result = $this->ListRecord($query);
        return $result;
    }

    public function form($arrParams, $task){
         if($task == 'add'){
             $arrParams['user_id']      = 6;
             $arrParams['created_at']   = date('Y-m-d H:i:s', time());
             if (!empty($arrParams['image'])){
                 $uploadObj = new Upload();
                 $arrParams['image'] = $uploadObj->uploadFile($arrParams['image'], 'banners');
             }else{
                 unset($arrParams['image']);
             }
             $this->Insert($arrParams);

         }else{
             $arrParams['updated_at'] = date('Y-m-d H:i:s', time());
             $id = $arrParams['id'];

             if (!empty($arrParams['image']['name'])){
                $info = $this->info($id);
                $uploadObj = new Upload();
                $uploadObj->removeFile('banners', null, $info['image']);
                $arrParams['image'] = $uploadObj->uploadFile($arrParams['image'], 'banners');
             }else{
                 unset($arrParams['image']);
             }
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


    public function info($id){
        $query = "select * from `$this->table` where `id` = " . $id;
        $result = $this->OneRecord($query);
        return $result;
    }

}