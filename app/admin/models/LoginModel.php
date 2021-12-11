<?php

class LoginModel extends Model
{
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->setTable('users');
    }
    public function login($params){
        $form = $params['form'];
        $username = $form['username'];
        $password = $form['password'];
        $password =  md5($password);

        $query = "SELECT username,id,password FROM users WHERE username='$username' and password='$password' and is_admin=1 limit 0,1";
        $result = $this->ListRecord($query);
        if (empty($result)) return false;
        $_SESSION['userAdmin'] = array(
            'username' => $username,
            'user_id' => $result[0]['id']
        );
        return true;

    }

}
