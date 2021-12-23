<?php

class SlideModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('slides');
    }

    public function list(){
        $query = "select * from `$this->table` order by `position`";
        $result = $this->ListRecord($query);
        return $result;
    }

    public function form($arrParams, $task){
         if($task == 'add'){
             $arrParams['user_id']      = $_SESSION['userAdmin']['user_id'];
             $arrParams['created_at']   = date('Y-m-d H:i:s', time());
             $arrParams['position']     = $this->lastPosition() + 1;
             if (!empty($arrParams['image'])){
                 $uploadObj = new Upload();
                 $arrParams['image'] = $uploadObj->uploadFile($arrParams['image'], 'slides');
             }else{
                 unset($arrParams['image']);
             }
             $arrParams = $this->prepare($arrParams);
             return $this->Insert($arrParams);

         }else{
             $arrParams['updated_at'] = date('Y-m-d H:i:s', time());
             $id = $arrParams['id'];

             if (!empty($arrParams['image']['name'])){
                $info = $this->info($id);
                $uploadObj = new Upload();
                $uploadObj->removeFile('slides', null, $info['image']);
                $arrParams['image'] = $uploadObj->uploadFile($arrParams['image'], 'slides');
             }else{
                 unset($arrParams['image']);
             }
             $arrParams = $this->prepare($arrParams);
             $this->Update($arrParams, [['id', $id, '']]);
         }
    }

    public function deleteItem($id){
        $position               = $this->OneRecord("select `position` from `$this->table` where `id` = '$id'")['position'];

        $queryPosstionUpdate    = "update `$this->table` set `position` = `position` - 1 where `position` > '$position'";
        $this->Query($queryPosstionUpdate);
        return $this->Delete([$id]);
    }
    public function changeStatus($id, $status){
        $param   = array('status' => $status);
        $where   = array(array('id', $id, ''));
        return $this->Update($param, $where);
    }
    public function changeOrder($data){
        if ($data['type'] == 'down'){
              $query            = "select `id`, `position` from `$this->table` where `position` > " . $data['position'] . ' order by `position` asc limit 1';
              $row              = $this->OneRecord($query);
              $checkUpdate_1    = $this->Update(['position' => $row['position']], [['id', $data['id'], '']]);
              $checkUpdate_2    = $this->Update(['position' => $data['position']], [['id', $row['id'], '']]);
              return $checkUpdate_1 && $checkUpdate_2;
        }else{
            $query = "select `id`, `position` from `$this->table` where `position` < " . $data['position'] . ' order by `position` desc limit 1';
            $row              = $this->OneRecord($query);
            $checkUpdate_1    = $this->Update(['position' => $row['position']], [['id', $data['id'], '']]);
            $checkUpdate_2    = $this->Update(['position' => $data['position']], [['id', $row['id'], '']]);
            return $checkUpdate_1 && $checkUpdate_2;
        }

    }

    public function info($id){
        $query = "select * from `$this->table` where `id` = " . $id;
        $result = $this->OneRecord($query);
        return $result;
    }

}