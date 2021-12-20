<?php

class UserModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('users');
    }

    public function form($arrParams){
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
            $arrParams['avatar'] = $uploadObj->uploadFile($arrParams['avatar'], 'users', 100, 130);
         }else{
             unset($arrParams['avatar']);
         }

         $this->Update($arrParams, [['id', $id, '']]);

    }
    public function signup($arrParams){
        $arrParams['created_at'] = date('Y-m-d H:i:s', time());
        $arrParams['password']   = md5($arrParams['password']);
        unset($arrParams['confirm_password']);
        $this->Insert($arrParams);
    }
    public function info($id){
        $query = 'select * from users where `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }

    public function getTopBanners($position){
        $this->SetTable('banners');
        $query  = "select * from `$this->table` where `position` = $position and `status` = 1";
        return $this->ListRecord($query);
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
    public function getSettings(){
        $query = 'select * from `configs`';
        $result =  $this->ListRecord($query);
        $newResult = array();
        foreach ($result as $key => $value){
            $newResult[$value['config_name']] = $value['config_value'];
        }
        return $newResult;
    }

    public function addToFavorites($id, $userId){

        $this->SetTable('favorites');
        $params = ['user_id' => $userId, 'product_id' => $id];
        echo '<pre>';
        print_r($params);
        echo '</pre>';
        return $this->Insert($params);
    }
}