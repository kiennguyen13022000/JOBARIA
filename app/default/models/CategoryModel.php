<?php

class CategoryModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('categories');
    }

    public function list1(){
        $query = 'select c1.*, c2.name as parentName from `categories` as c1 join `categories` as c2 on c1.parent_id = c2.id order by c1.`left`';
        $result = $this->ListRecord($query);
        $rootQuery = 'select * from `categories` where `name` = \'root\'';
        array_unshift($result, $this->OneRecord($rootQuery));
        return $result;
    }
    public function list($category_id,$table,$limit_cond = ''){
        $this->setTable($table);
        $query_select = 'SELECT categories.left,categories.right FROM categories WHERE `id` ='.$category_id;
        $result_select = $this->OneRecord($query_select);

//        $query= 'SELECT p.* FROM products as p, categories as child, categories as parent WHERE p.category_id = child.id  AND p.status = 1 AND
//child.left BETWEEN '.$result_select['left'].' AND '.$result_select['right'].' GROUP BY p.id HAVING COUNT(p.id) = SUM(parent.status)'.$limit_cond;

        $query = 'SELECT p.* FROM `'.$table.'` as p, categories as child, categories as parent WHERE parent.left > 0 AND child.id = '.$category_id.' AND p.category_id = child.id  AND p.status = 1 AND
child.left BETWEEN parent.left AND parent.right GROUP BY p.id HAVING COUNT(p.id) = SUM(parent.status)'.$limit_cond;
        $result = $this->ListRecord($query);
        return $result;
    }
    public function countRecord($category_id,$table){
        $this->setTable($table);
        //$query = 'SELECT * FROM `'.$table.'` WHERE `category_id` ='.$category_id;
        $query = 'SELECT p.id FROM `'.$table.'` as p, categories as child, categories as parent WHERE parent.left > 0 AND child.id = '.$category_id.' AND p.category_id = child.id  AND p.status = 1 AND
child.left BETWEEN parent.left AND parent.right GROUP BY p.id HAVING COUNT(p.id) = SUM(parent.status)';
        $result = $this->ListRecord($query);
        return !empty($result) ? count($result) : 0;
    }
    public function listSearch($table,$cond,$limit_cond = ''){
        $this->setTable($table);
        $query_select = 'SELECT categories.left,categories.right FROM categories';
        $result_select = $this->OneRecord($query_select);
//        $query= 'SELECT p.* FROM products as p, categories as child, categories as parent WHERE p.category_id = child.id  AND p.status = 1 AND
//child.left BETWEEN '.$result_select['left'].' AND '.$result_select['right'].' GROUP BY p.id HAVING COUNT(p.id) = SUM(parent.status)'.$limit_cond;

        $query = 'SELECT p.* FROM `'.$table.'` as p, categories as child, categories as parent WHERE '.$cond.' and parent.left > 0  AND p.category_id = child.id  AND p.status = 1 AND
child.left BETWEEN parent.left AND parent.right GROUP BY p.id HAVING COUNT(p.id) = SUM(parent.status)'.$limit_cond;
        $result = $this->ListRecord($query);
        return $result;
    }
    public function countRecordSearch($table,$cond){
        $this->setTable($table);
        //$query = 'SELECT * FROM `'.$table.'` WHERE `category_id` ='.$category_id;
        $query = 'SELECT p.id FROM `'.$table.'` as p, categories as child, categories as parent WHERE '.$cond.' and parent.left > 0  AND p.category_id = child.id  AND p.status = 1 AND
child.left BETWEEN parent.left AND parent.right GROUP BY p.id HAVING COUNT(p.id) = SUM(parent.status)';
        $result = $this->ListRecord($query);
        return !empty($result) ? count($result) : 0;
    }
    public function form($arrParams, $task){
        if($task == 'add'){
            $arrParams['user_id']    = $_SESSION['userAdmin']['user_id'];;
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
            $arrParams = $this->prepare($arrParams);
            return $this->Insert($arrParams);

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
            $arrParams = $this->prepare($arrParams);
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
    public function changeTrending($id, $trending){
        $param   = array('trending' => $trending);
        $where   = array(array('id', $id, ''));
        return $this->Update($param, $where);
    }
    public function info($id){
        $query = 'select * from `categories` where `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
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
    public function getTopBanners($position){
        $this->SetTable('banners');
        $query  = "select * from `$this->table` where `position` = $position and `status` = 1";
        return $this->ListRecord($query);
    }
    public function getSettings(){
        $query = 'select * from `configs`';
        $result =  $this->ListRecord($query);
        $newResult = array();
        foreach ($result as $key => $value){
            $newResult[$value['config_name']] = $value['config_value'];
        }
        return $newResult;
    }
    public function getCategory(){
        $query[]        = 'SELECT child.id, child.name, child.level, child.parent_id, GROUP_CONCAT(DISTINCT parent.name ORDER BY parent.left)  as breakcrumbs';
        $query[]        = 'FROM `categories` as child, categories as parent';
        $query[]        = 'WHERE child.parent_id NOT IN (SELECT c.id FROM `categories` as c WHERE c.status = 0)';
        $query[]        = 'AND child.status = 1 AND child.left BETWEEN parent.left';
        $query[]        = 'AND parent.right AND parent.left > 0';
        $query[]        = 'GROUP BY child.id ORDER BY child.left';
        $strQuery       = implode(' ', $query);
        $categories     = $this->ListRecord($strQuery);
        $newCategories  = array();
        $k = 0;
        $z = 0;
        for ($i = 0; $i < count($categories); $i++){
            if ($categories[$i]['level'] == 1){
                $newCategories[$k] = $categories[$i];
                $z = 0;
                for ($j = $i + 1; $j < count($categories); $j++){
                    if ($categories[$j]['parent_id'] == $categories[$i]['id']){
                        $newCategories[$k]['child_second'][$z] = $categories[$j];
                        for ($x = $j + 1; $x < count($categories); $x++){
                            if ($categories[$x]['parent_id'] == $categories[$j]['id']){
                                $newCategories[$k]['child_second'][$z]['child_third'][] = $categories[$x];
                            }
                        }
                        $z++;
                    }

                }
                $k++;
            }
        }

        return $newCategories;
    }

}