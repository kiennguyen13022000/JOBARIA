<?php

class SubscribeModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('subscribe');
    }

    public function list(){
        $query = 'SELECT * FROM subscribe';
        $result = $this->ListRecord($query);
        return  $result;
    }
    public function edit($params, $task){
        $this->setTable('subscribe');
        $arrParams = $params['form'];
        $arrParams['user_id'] = $_SESSION['userAdmin']['user_id'];
        $arrParams['updated_at'] = date('Y-m-d H:i:s');
        $id = $arrParams['id'] = $params['id'];
        return $this->Update($arrParams, [['id', $id, '']]);
    }
    public function deleteItem($id, $table){
        if (empty($table)) $table = 'subscribe';
        $this->setTable($table);
        return $this->Delete([$id]);
    }
    public function info($id){
        $this->setTable('subscribe');
        $query = 'SELECT * FROM orders WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }

}
