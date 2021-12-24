<?php

class OrderModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('orders');
    }

    public function list(){
        $query = 'SELECT * FROM orders';
        $result = $this->ListRecord($query);
        return  $result;
    }
    public function edit($params, $task){
        $this->setTable('orders');
        $arrParams = $params['form'];
        $arrParams['user_id'] = $_SESSION['userAdmin']['user_id'];
        $arrParams['updated_at'] = date('Y-m-d H:i:s');
        $id = $arrParams['id'] = $params['id'];
        return $this->Update($arrParams, [['id', $id, '']]);
    }
    public function deleteItem($id, $table){
        if (empty($table)) $table = 'orders';
        $this->setTable($table);
        return $this->Delete([$id]);
    }
    public function info($id){
        $this->setTable('orders');
        $query = 'SELECT * FROM orders WHERE `id` = ' . $id;
        $result = $this->OneRecord($query);
        return $result;
    }
    public function listProductOrder($id){
        $this->setTable('product_order');
        $query = 'SELECT * FROM product_order WHERE `order_id` = ' . $id;
        $result = $this->ListRecord($query);
        return $result;
    }
    public function changeStatus($id, $status){
        $param   = array('status' => $status);
        $where   = array(array('id', $id, ''));
        return $this->Update($param, $where);
    }
    public function sendMailConfirmOrder($order_id){
        require "public/PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
        require "public/PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
        require 'public/PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
        $info = $this->info($order_id);
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
            $to = $info['email'];
            $from_name = $info['first_name'].' '.$info['last_name'];
            $mail->addAddress($to, $from_name); //mail và tên người nhận
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Order confirmation successful';
            $message = "
                    <b>Hello ".$from_name."</b><br>
                   Jobaria xác nhận đơn hàng của bạn. Chúng tôi sẽ gửi đơn hàng sớm nhất đến cho bạn
                    <br>
                    Mã order: ".$info['code']."<br>
                    Sub Total: $".$info['sub_total']."<br>
                    Total: $".$info['total']."<br>
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
}
