<?php
class LoginController extends Controller
{
    public  $username = '';
    public  $password = '';

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
    }
    public function loginAction()
    {
//        die('xx');
        if(isset($this->_arrParam['form'])){
            $login = $this->_model->login($this->_arrParam);
            if (!empty($login)){
                header('Location: index.php?module=admin&controller=index&action=index');
            }
        }
        $this->_view->render('login',false);
//        if (!empty($_SESSION['userAdmin'])){
//            header('Location: index.php?module=admin&controller=index&action=index');
//        }
    }

}