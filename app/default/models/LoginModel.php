<?php

class LoginModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('users');
    }
    public function login($params){
        $this->setTable('users');
        $form = $params['form'];
        $username = $form['username'];
        $password = $form['password'];
        $password =  md5($password);

        $query = "SELECT username, id, password, firstname, lastname, avatar, email FROM users WHERE username='$username' and password='$password' and `status` = 1 and is_Admin = 0";
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
    public function forgot($params){
//        echo getcwd();die();
        $email = $params['form']['email'];
        $result=$this->OneRecord("SELECT id,username,firstname,lastname,email,password FROM users WHERE is_Admin = 0 and email='$email'");
        if (empty($result)) return false;
        $from_name = $result['firstname'].' '. $result['lastname'];
        if (empty($result['firstname']) && empty($result['lastname'])) $from_name = $result['username'];
        $new_password = substr(md5(rand(0,9999)),0,6);
        $user_id = $result['id'];
        $sql = "UPDATE users SET password = '".md5($new_password)."' WHERE id=".$user_id;
        $this->Query($sql);

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
            $to = $email;
            $mail->addAddress($to, $from_name); //mail và tên người nhận
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Reset password';
            $message = "
                    <b>Hello ".$from_name."</b><br>
                    Your new password is  ".$new_password."
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
