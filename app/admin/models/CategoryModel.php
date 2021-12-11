<?php

class CategoryModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('categories');
    }

    public function list(){
        $query = 'select c1.*, c2.name as parentName from `categories` as c1 join `categories` as c2 on c1.parent_id = c2.id order by c1.`left`';
        $result = $this->ListRecord($query);
        $rootQuery = 'select * from `categories` where `name` = \'root\'';
        array_unshift($result, $this->OneRecord($rootQuery));
        return $result;
    }

    public function form($arrParams, $task){
        if($task == 'add'){
            $arrParams['user_id']    = 6;
            $arrParams['created_at'] = date('Y-m-d H:i:s', time());
            $nested = new NestedSetModel('categories');
            $data = $nested->insertNode($arrParams['parent_id']);
            $arrParams['left'] = $data['left'];
            $arrParams['right'] = $data['right'];
            $arrParams['level'] = $data['level'];
            if (!empty($arrParams['image']['name'])){
                $uploadObj = new Upload();
                $arrParams['image'] = $uploadObj->uploadFile($arrParams['image'], 'category');
            }else{
                unset($arrParams['image']);
            }

            $this->Insert($arrParams);

        }else{
            $arrParams['updated_at'] = date('Y-m-d H:i:s', time());
            $id = $arrParams['id'];
            $info = $this->info($id);
            if (!empty($arrParams['image']['name'])){
                $uploadObj = new Upload();
                $uploadObj->removeFile('category', null, $info['image']);
                $arrParams['image'] = $uploadObj->uploadFile($arrParams['image'], 'category', 100, 130);
            }else{
                unset($arrParams['image']);
            }
            $nested = new NestedSetModel('categories');
            if ($arrParams['parent_id'] != $info['parent_id'])
                    $nested->updateNode($id, $arrParams['parent_id']);
            $this->Update($arrParams, [['id', $id, '']]);
        }
    }

    public function deleteItem($id){
        $nested = new NestedSetModel('categories');
        $affected = $nested->removeNode($id);
        return $affected;
    }
    public function changeStatus($id, $status){
        $param   = array('status' => $status);
        $where   = array(array('id', $id, ''));
        return $this->Update($param, $where);
    }
    public function info($id){
        $query = 'select * from `categories` where `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }

    public function getCategory(){
        $query = 'select `id`, `name`, `level` from `categories` order by `left`';
        return $this->ListRecord($query);
    }

    public function moveNode($type, $id){
        $nested = new NestedSetModel('categories');
        if ($type == 'down'){
            $nested->moveDown($id);
        }else{
            $nested->moveUp($id);
        }
        return $this->list();
    }


}