<?php

class AccountModel extends Model
{
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

    public function getWishList($user){
         $result = [];
         if (!empty([$user])){
             $query = 'select p.* from `products` as p join `favorites` as f on p.id = f.product_id where f.user_id = ' . $user['user_id'];
             $result = $this->ListRecord($query);
         }
         return $result;
    }
    public function historyOrder($user){
        $result = [];
        if (!empty([$user])){
            $query = 'select id, code, status, first_name, last_name, total, created_at, phone from `orders` as o where o.client_id = ' . $user['user_id'];
            $result = $this->ListRecord($query);
        }
        return $result;
    }

    public function addToFavorites($id, $userId){
        $this->SetTable('favorites');
        $params = ['user_id' => $userId, 'product_id' => $id];
        $query = 'select `id` from `favorites` where `user_id` = ' .$userId . ' and `product_id` = ' . $id;
        $result = $this->OneRecord($query);
        if (!empty($result)){
            $this->Delete([$result['id']]);
            return 'already-exist';
        }
        return $this->Insert($params);
    }
}