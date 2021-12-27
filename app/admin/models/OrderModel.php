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
    public function info($id,$table = ''){
        if(empty($table)) $table = 'orders';
        $this->setTable($table);
        $query = 'SELECT * FROM '.$table.' WHERE `id` = ' . $id;
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
        $info = $this->info($order_id,'orders');
        $email_template_id = EMAIL_TEMPLATE_CONFIRM_ORDER_SUCCESSFULL;
        $template = $this->info($email_template_id,'email_template');
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
            $message = str_replace('[%NOTES%]',$info['notes'],$message);
            $message = str_replace('[%HTML_ORDER_INFORMATION%]',$order_information,$message);
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
