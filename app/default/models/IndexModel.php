<?php

class IndexModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
    }

    public function listSlider()
    {
        $this->SetTable('slides');
        $query = "select * from `$this->table` where `status` = 1";
        return $this->ListRecord($query);
    }

    public function getTopBanners($position)
    {
        $this->SetTable('banners');
        $query = "select * from `$this->table` where `position` = $position and `status` = 1";
        return $this->ListRecord($query);
    }

    public function getNewProductList($type, $field)
    {
        $user = Session::get('user');
        $this->SetTable('products');
        $query[] = "select p.*, child.name as category_name, GROUP_CONCAT(parent.name order by parent.left) as breakcrumbs";
        $query[] = "from `$this->table` as p join `categories` as child, `categories` as parent";
        $query[] = "WHERE p.status = 1 and p.category_id = child.id";
        $query[] = "and child.left BETWEEN parent.left AND parent.right";
        $query[] = "AND parent.left > 0 AND p.$field = 1";
        $query[] = "GROUP BY p.id";
        $query[] = "HAVING COUNT(p.id) = SUM(parent.status)";
        $query[] = "ORDER BY parent.left";
        $query[] = " limit 0,24";
        $query = implode(' ', $query);
        $result = [];
        if (!empty($user)) {
            $user_id = $user['user_id'];
            $queryFavorites = 'select `product_id` from `favorites` as f where f.user_id = ' . $user_id;
            $favorites = $this->ListRecord($queryFavorites);
            $newFavorites = [];
            foreach ($favorites as $value) {
                $newFavorites[] = $value['product_id'];
            }
            $result['favorites'] = $newFavorites;
        }
        $result[$type] = $this->ListRecord($query);
        return $result;
    }

    public function getCategory()
    {
        $query[] = 'SELECT child.id, child.name, child.level, child.parent_id, GROUP_CONCAT(DISTINCT parent.name ORDER BY parent.left)  as breakcrumbs';
        $query[] = 'FROM `categories` as child, categories as parent';
        $query[] = 'WHERE child.parent_id NOT IN (SELECT c.id FROM `categories` as c WHERE c.status = 0)';
        $query[] = 'AND child.status = 1 AND child.left BETWEEN parent.left';
        $query[] = 'AND parent.right AND parent.left > 0';
        $query[] = 'GROUP BY child.id ORDER BY child.left';
        $strQuery = implode(' ', $query);
        $categories = $this->ListRecord($strQuery);
        $newCategories = array();
        $k = 0;
        $z = 0;
        for ($i = 0; $i < count($categories); $i++) {
            if ($categories[$i]['level'] == 1) {
                $newCategories[$k] = $categories[$i];
                $z = 0;
                for ($j = $i + 1; $j < count($categories); $j++) {
                    if ($categories[$j]['parent_id'] == $categories[$i]['id']) {
                        $newCategories[$k]['child_second'][$z] = $categories[$j];
                        for ($x = $j + 1; $x < count($categories); $x++) {
                            if ($categories[$x]['parent_id'] == $categories[$j]['id']) {
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

    public function getDailyDealProduct()
    {
        $currentTime = date('Y-m-d H:i:s');
        $query[] = "select p.*, child.name as categoryName, GROUP_CONCAT(DISTINCT parent.name order by parent.left) as breakcrumbs";
        $query[] = "from `$this->table` as p join `categories` as child, `categories` as parent";
        $query[] = "WHERE p.status = 1 and p.category_id = child.id";
        $query[] = "and child.left BETWEEN parent.left AND parent.right";
        $query[] = "AND parent.left > 0 AND `promotion_end_date` > '$currentTime' and `promotion` > 0";
        $query[] = "GROUP BY p.id";
        $query[] = "HAVING COUNT(p.id) = SUM(parent.status)";
        $query[] = " limit 0,6";
//        $query[]    = "ORDER BY parent.left";
        $strQuery = implode(' ', $query);
        return $this->ListRecord($strQuery);
    }

    public function getTrenningProductList()
    {
        $queryBetween = 'select `id`, `name`, `left`, `right` from `categories`  where `trending` = 1';
        $trendings = $this->ListRecord($queryBetween);
        $trenningProductList = array();

        foreach ($trendings as $key => $value) {
            $query = [];
            $query[] = 'select p.*, c.name as category_name from `products` as p JOIN `categories` as c';
            $query[] = 'ON p.category_id = c.id';
            $query[] = 'where `category_id` in (select id from `categories` WHERE';
            $query[] = '`left` between ' . $value['left'] . ' and ' . $value['right'] . ')';
            $query[] = " limit 0,12";
            $query = implode(' ', $query);
            $trenningProductList[$value['name']] = $this->ListRecord($query);
        }
        return $trenningProductList;

    }

    public function getSettings()
    {
        $query = 'select * from `configs`';
        $result = $this->ListRecord($query);
        $newResult = array();
        foreach ($result as $key => $value) {
            $newResult[$value['config_name']] = $value['config_value'];
        }
        return $newResult;
    }

    public function info($id)
    {
        $query[] = "select p.*, child.name as categoryName, GROUP_CONCAT(DISTINCT parent.name order by parent.left) as breakcrumbs";
        $query[] = "from `products` as p join `categories` as child, `categories` as parent";
        $query[] = "WHERE p.id = $id and p.category_id = child.id";
        $query[] = "and child.left BETWEEN parent.left AND parent.right";
        $query[] = "AND parent.left > 0 ";
        $query[] = "GROUP BY p.id";
//        $query[]    = "ORDER BY parent.left";
        $strQuery = implode(' ', $query);
        $result = $this->OneRecord($strQuery);
        $queryChildImage = 'select image from `product_image` where `product_id` = ' . $id;
        $result['childImage'] = $this->ListRecord($queryChildImage);
        return $result;
    }

    public function getLink($id)
    {
        $this->setTable('products');
        $query = 'SELECT slug FROM products WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        $slug = '/product/' . $result['slug'] . '-' . $id . '.html';
        return $slug;
    }

    public function subscribe($email)
    {
        $this->setTable('subscribe');
        $query = "SELECT id FROM subscribe WHERE email=" . "'$email'";
        $result = $this->OneRecord($query);
        if ($result) return false;
        return $this->Insert(array(
            'email' => $email,
            'created_at' => date('Y-m-d H:i:s', time())
        ));
    }

    public function sendMailSubscribe($params)
    {
        require "public/PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
        require "public/PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
        require 'public/PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions

        $email_template_id = EMAIL_TEMPLATE_SUBSCRIBE;
        $template = $this->infoTable($email_template_id, 'email_template');
        $message = $template['content'];
        try {
            $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0
            $mail->isSMTP();
            $mail->CharSet = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $from = $template['from_email']; //email người gửi
            $password = 'khamdkvl1';
            $name_to = $template['from_name']; //tên email người gửi
            $mail->Username = $from; // SMTP username
            $mail->Password = $password;   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL
            $mail->Port = 465;  // port to connect to
            $mail->setFrom($from, $name_to);
            $to = $params['email'];
            $from_name = $params['email']; //tên người nhận
            $mail->addAddress($to, $from_name); //mail và tên người nhận
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = $template['subject'];

            $message = str_replace('[%CUSTOMER_FULLNAME%]', $params['email'], $message);

            $mail->Body = $message;
            $mail->smtpConnect(array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();
            //echo 'Đã gửi mail xong';
            return true;
        } catch (Exception $e) {
            // echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
            return false;
        }
    }

    public function infoTable($id, $table = '')
    {
        if (empty($table)) $table = 'orders';
        $this->setTable($table);
        $query = 'SELECT * FROM ' . $table . ' WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }
}