<?php
class OrderModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
    }
    public function cart($param)
    {

    }
    public function checkout($param)
    {

    }
    public function login($params){
        $this->setTable('users');
        $form = $params['login'];
        $username = $form['username'];
        $password = $form['password'];
        $password =  md5($password);
        $query = "SELECT username, id, password, firstname, lastname, avatar FROM users WHERE username='$username' and password='$password' and `status` = 1 and is_Admin = 0";
        $result = $this->OneRecord($query);
        if (empty($result)) return false;
        $_SESSION['user'] = array(
            'loggedIn'  => true,
            'username'  => $username,
            'user_id'   => $result['id'],
            'userInfo'  => $result
        );
        return true;
    }
    public function add($params,$table){
        $this->setTable($table);
        $this->Insert($params);
    }
    public function sendMail1($params){
        require "public/PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
        require "public/PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
        require 'public/PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
        try {
            $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0
            $mail->isSMTP();
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $from = 'dinhkhamhubt@gmail.com';
            $password = 'khamdkvl1';
            $name_to = 'Nguyễn Đình Khâm';
            $mail->Username = $from; // SMTP username
            $mail->Password = $password;   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL
            $mail->Port = 465;  // port to connect to
            $mail->setFrom($from, $name_to );
            $to = $params['email'];
            $from_name = $params['first_name'].' '.$params['last_name'];
            $mail->addAddress($to, $from_name); //mail và tên người nhận
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Order successfully';
            $message = "
                    <b>Hello ".$from_name."</b><br>
                    Chúc mừng bạn đã order thành công.
                    <br>
                    Mã order: ".$params['code']."<br>
                    Sub Total: $".$params['sub_total']."<br>
                    Total: $".$params['total']."<br>
                  " ;
            $mail->Body = $message;
            $mail->smtpConnect( array(
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
    public function sendMail($params){
        require "public/PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
        require "public/PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
        require 'public/PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
        $order_id = $params['order_id'];
        $info = $this->infoTable($order_id,'orders');
        $email_template_id = EMAIL_TEMPLATE_ORDER_SUCCESS;
        $template = $this->infoTable($email_template_id,'email_template');
        $message = $template['content'];
        $full_name = $info['first_name'].' '.$info['last_name'];
        try {
            $mail->SMTPDebug = 0;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0
            $mail->isSMTP();
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $from = $template['from_email']; //email người gửi
            $password = 'khamdkvl1';
            $name_to = $template['from_name']; //tên email người gửi
            $mail->Username = $from; // SMTP username
            $mail->Password = $password;   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL
            $mail->Port = 465;  // port to connect to
            $mail->setFrom($from, $name_to );
            $to = $info['email'];
            $from_name = $full_name; //tên người nhận
            $mail->addAddress($to, $from_name); //mail và tên người nhận
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = $template['subject'];


            $product_order = $this->listProductOrder($order_id);
            $order_information = '<div style="padding-left: 10px;padding-right: 10px;    font-family: arial, helvetica, sans-serif;font-size: 11pt">';
            if (!empty($product_order)){
                $order_information .='<div style="display: -ms-flexbox; display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-left: -12px;margin-right: -12px">';
                foreach ($product_order as $k=>$v){
                    $order_information .='
                        <div style="padding-left: 12px;padding-right: 12px;-ms-flex: 0 0 50%;
    flex: 0 0 45%;
    max-width: 45%;width: 45%">
                            <h3 style="font-weight: bold;font-size: 13pt;margin-top: 5px;">'.$v['product_name'].'</h3>
                            <p style="margin-bottom: 10px;display: none">Size : '.$v['size'].'</p>
                            <p>Quantity: '.$v['quantity'].'</p>
                            <p>Price: $'.$v['price'].'</p>
                            <p>Total: $'.number_format($v['price']*$v['quantity'], 2, '.', ',').'</p>
                        </div>
                        ';
                }
                $order_information .='</div>';
            }

            $order_information .= '
                 <h3 style="font-weight: bold;font-size: 13pt">Order summary</h3>
                 <p style="margin-bottom: 10px">Sub Total: $'.$info['sub_total'].'</p>
                 <p style="margin-bottom: 10px">Shipping Charge: Free</p>
                 <p style="margin-bottom: 10px">Estimated Tax: Free</p>
                 <p style="margin-bottom: 10px">Total: $'.$info['total'].'</p>
            ';
            $order_information .='</div>';
            $message = str_replace('[%CUSTOMER_FULLNAME%]',$full_name,$message);
            $message = str_replace('[%ORDER_CODE%]',$info['code'],$message);
            $message = str_replace('[%CUSTOMER_ADDRESS%]',$info['address'],$message);
            $message = str_replace('[%CUSTOMER_PHONE%]',$info['phone'],$message);
            $message = str_replace('[%CUSTOMER_EMAIL%]',$info['email'],$message);
            $message = str_replace('[%NOTES%]',$info['notes'],$message);
            $message = str_replace('[%HTML_ORDER_INFORMATION%]',$order_information,$message);
            $mail->Body = $message;
            $arrParams['order_invoice'] = $message;
            $this->setTable('orders');
            $this->Update($arrParams, [['id', $order_id, '']]);

            $mail->smtpConnect( array(
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
    public function getLastId($table){
        $this->setTable($table);
        $this->LastId();
    }
    public function info($id){
        $this->setTable('products');
        $query = 'SELECT * FROM products WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }
    public function infoTable($id,$table = ''){
        if(empty($table)) $table = 'orders';
        $this->setTable($table);
        $query = 'SELECT * FROM '.$table.' WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }
    public function infoDetail($id,$field){
        $this->setTable('products');
        $query = 'SELECT '.$field.' FROM products WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }
    public function getLink($id){
        $this->setTable('products');
        $query = 'SELECT slug FROM products WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        $slug = '/product/'.$result['slug'].'-'.$id.'.html';
        return $slug;
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
    public function listProductOrder($id){
        $this->setTable('product_order');
        $query = 'SELECT * FROM product_order WHERE `order_id` = ' . $id;
        $result = $this->ListRecord($query);
        return $result;
    }
}