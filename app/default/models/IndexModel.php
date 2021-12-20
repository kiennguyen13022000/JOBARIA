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
        $query[]    = "select p.*, child.name as category_name, GROUP_CONCAT(parent.name order by parent.left) as breakcrumbs";
        $query[]    = "from `$this->table` as p join `categories` as child, `categories` as parent";
        $query[]    = "WHERE p.status = 1 and p.category_id = child.id";
        $query[]    = "and child.left BETWEEN parent.left AND parent.right";
        $query[]    = "AND parent.left > 0 AND p.is_new = 1";
        $query[]    = "GROUP BY p.id";
        $query[]    = "HAVING COUNT(p.id) = SUM(parent.status)";
        $query[]    = "ORDER BY parent.left";
        $query      = implode(' ', $query);
        return $this->ListRecord($query);
    }

    public function getBestsellerProductList(){
        $this->SetTable('products');
        $query[]    = "select p.*, child.name as category_name, GROUP_CONCAT(DISTINCT parent.name order by parent.left) as breakcrumbs";
        $query[]    = "from `$this->table` as p join `categories` as child, `categories` as parent";
        $query[]    = "WHERE p.status = 1 and p.category_id = child.id";
        $query[]    = "and child.left BETWEEN parent.left AND parent.right";
        $query[]    = "AND parent.left > 0 AND p.is_new = 1";
        $query[]    = "GROUP BY p.id";
        $query[]    = "HAVING COUNT(p.id) = SUM(parent.status)";
        $query[]    = "ORDER BY parent.left";
        $query      = implode(' ', $query);

        return $this->ListRecord($query);
    }

    public function getFeatureProductList(){
        $this->SetTable('products');
        $query[]    = "select p.*, child.name as category_name, GROUP_CONCAT(DISTINCT parent.name order by parent.left) as breakcrumbs";
        $query[]    = "from `$this->table` as p join `categories` as child, `categories` as parent";
        $query[]    = "WHERE p.status = 1 and p.category_id = child.id";
        $query[]    = "and child.left BETWEEN parent.left AND parent.right";
        $query[]    = "AND parent.left > 0 AND p.feature = 1";
        $query[]    = "GROUP BY p.id";
        $query[]    = "HAVING COUNT(p.id) = SUM(parent.status)";
//        $query[]    = "ORDER BY parent.left";
        $query      = implode(' ', $query);

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
        $query[]    = "select p.*, child.name as categoryName, GROUP_CONCAT(DISTINCT parent.name order by parent.left) as breakcrumbs";
        $query[]    = "from `$this->table` as p join `categories` as child, `categories` as parent";
        $query[]    = "WHERE p.status = 1 and p.category_id = child.id";
        $query[]    = "and child.left BETWEEN parent.left AND parent.right";
        $query[]    = "AND parent.left > 0 AND `promotion_end_date` > '$currentTime' and `promotion` > 0";
        $query[]    = "GROUP BY p.id";
        $query[]    = "HAVING COUNT(p.id) = SUM(parent.status)";
//        $query[]    = "ORDER BY parent.left";
        $strQuery       = implode(' ', $query);
        return $this->ListRecord($strQuery);
    }

    public function getTrenningProductList(){
        $queryBetween = 'select `id`, `name`, `left`, `right` from `categories`  where `trending` = 1';
        $trendings = $this->ListRecord($queryBetween);
        $trenningProductList = array();

        foreach ($trendings as $key => $value){
            $query = [];
            $query[] = 'select p.*, c.name as category_name from `products` as p JOIN `categories` as c';
            $query[] = 'ON p.category_id = c.id';
            $query[] = 'where `category_id` in (select id from `categories` WHERE';
            $query[] = '`left` between '. $value['left'] .' and '. $value['right'] .')';
            $query   = implode(' ', $query);
            $trenningProductList[$value['name']] =  $this->ListRecord($query);
        }
        return $trenningProductList;

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
    public function info($id){
        $query[]    = "select p.*, child.name as categoryName, GROUP_CONCAT(DISTINCT parent.name order by parent.left) as breakcrumbs";
        $query[]    = "from `products` as p join `categories` as child, `categories` as parent";
        $query[]    = "WHERE p.id = $id and p.category_id = child.id";
        $query[]    = "and child.left BETWEEN parent.left AND parent.right";
        $query[]    = "AND parent.left > 0 ";
        $query[]    = "GROUP BY p.id";
//        $query[]    = "ORDER BY parent.left";
        $strQuery   = implode(' ', $query);
        $result = $this->OneRecord($strQuery);
        $queryChildImage = 'select image from `product_image` where `product_id` = ' . $id;
        $result['childImage'] = $this->ListRecord($queryChildImage);
        return $result;
    }
    public function getLink($id){
        $this->setTable('products');
        $query = 'SELECT slug FROM products WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        $slug = '/product/'.$result['slug'].'-'.$id.'.html';
        return $slug;
    }
}