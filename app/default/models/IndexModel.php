<?php

class IndexModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
    }

    public function listSlider(){
        $this->SetTable('slides');
        $query  = "select * from `$this->table` where `status` = 1";
        return $this->ListRecord($query);
    }

    public function getTopBanners($position){
        $this->SetTable('banners');
        $query  = "select * from `$this->table` where `position` = $position and `status` = 1";
        return $this->ListRecord($query);
    }

    public function getNewProductList(){
        $this->SetTable('products');
        $query  = "select p.*, c.name as category_name from `$this->table` as p join `categories` as c";
        $query .= " on p.category_id = c.id";
        $query .= " where p.`is_new` = 1";

        return $this->ListRecord($query);
    }

    public function getBestsellerProductList(){
        $this->SetTable('products');
        $query  = "select p.*, c.name as category_name from `$this->table` as p join `categories` as c";
        $query .= " on p.category_id = c.id";
        $query .= "";

        return $this->ListRecord($query);
    }

    public function getFeatureProductList(){
        $this->SetTable('products');
        $query  = "select p.*, c.name as category_name from `$this->table` as p join `categories` as c";
        $query .= " on p.category_id = c.id";
        $query .= " where p.`feature` = 1";

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

    public function getDailyDealProduct(){
        $currentTime    = date('Y-m-d H:i:s');
        $query[]        = 'select p.*, c.name as categoryName from `products` as p join `categories` as c';
        $query[]        = 'on p.category_id = c.id';
        $query[]        = 'where `promotion_end_date` > ' . '\'' . $currentTime. '\'';
        $query[]        = 'and `promotion` > 0';
        $strQuery       = implode(' ', $query);
        return $this->ListRecord($strQuery);
    }

    public function getTrenningProductList(){
        $queryBetween = 'select `left`, `right` from `categories`  where `name` = \'Fashion\'';
        $fashion = $this->OneRecord($queryBetween);
        $trenningProductList = array();
        if (!empty($fashion)){
            $queryFashion[] = 'select p.*, c.name as category_name from `products` as p JOIN `categories` as c';
            $queryFashion[] = 'ON p.category_id = c.id';
            $queryFashion[] = 'where `category_id` in (select id from `categories` WHERE';
            $queryFashion[] = '`left` between '. $fashion['left'] .' and '. $fashion['right'] .')';
            $queryFashion   = implode(' ', $queryFashion);
            $trenningProductList['fashion'] =  $this->ListRecord($queryFashion);
        }


        // electronics
        $queryBetween = 'select `left`, `right` from `categories`  where `name` = \'Electronics\'';
        $fashion = $this->OneRecord($queryBetween);
        if (!empty($fashion)){
            $queryElectronics[] = 'select p.*, c.name as category_name from `products` as p JOIN `categories` as c';
            $queryElectronics[] = 'ON p.category_id = c.id';
            $queryElectronics[] = 'where `category_id` in (select id from `categories` WHERE';
            $queryElectronics[] = '`left` between '. $fashion['left'] .' and '. $fashion['right'] .')';
            $queryElectronics   = implode(' ', $queryElectronics);
            $trenningProductList['electronics'] =  $this->ListRecord($queryElectronics);
        }


        // vehicel
        $queryBetween = 'select `left`, `right` from `categories`  where `name` = \'Vehicel\'';
        $fashion = $this->OneRecord($queryBetween);
        if (!empty($fashion)){
            $queryVehicel[] = 'select p.*, c.name as category_name from `products` as p JOIN `categories` as c';
            $queryVehicel[] = 'ON p.category_id = c.id';
            $queryVehicel[] = 'where `category_id` in (select id from `categories` WHERE';
            $queryVehicel[] = '`left` between '. $fashion['left'] .' and '. $fashion['right'] .')';
            $queryVehicel   = implode(' ', $queryVehicel);
            $trenningProductList['vehicel'] =  $this->ListRecord($queryVehicel);
        }

        return $trenningProductList;
    }

    public function info($id){
        $query = 'select p.*, c.name as categoryName from products as p join categories as c on p.category_id = c.id where p.`id` = ' . $id;
        $result = $this->OneRecord($query);
        $queryChildImage = 'select image from `product_image` where `product_id` = ' . $id;
        $result['childImage'] = $this->ListRecord($queryChildImage);
        return $result;
    }
}