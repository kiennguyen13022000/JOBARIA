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
        if(isset($this->_arrParam['form'])){
            $login = $this->_model->login($this->_arrParam);

            if (!empty($login)) header('Location: index.php?module=admin&controller=index&action=index');
            $this->_view->block_errors = 'd-block';
        }
        $this->_view->render('login',false);
    }
    public function  logoutAction(){
        Session::delete('userAdmin');
        header('Location: index.php?module=admin&controller=login&action=login');
    }
    public function forgotAction(){
        $this->_view->errors = '';
        if(isset($this->_arrParam['form'])){
            $forgot = $this->_model->forgot($this->_arrParam);
            if(empty($forgot)){
                $this->_view->errors = 'is-invalid';
            }else{
                $this->_view->errors = 'is-valid';
            }
        }
        $this->_view->render('forgot',false);
    }
}