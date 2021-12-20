<?php
class LoginController extends Controller
{
    public function __construct($arrParams)
    {
//        error_reporting (E_ALL ^ E_NOTICE);
        parent::__construct($arrParams);
        if (!empty($_SESSION['user']['loggedIn'])){
            $user_id = $_SESSION['user']['user_id'];
            $query = "SELECT id FROM users WHERE id='$user_id' and status=1 & is_Admin=0";
            $info_user = $this->_model->OneRecord($query);
            if (empty($info_user)){
                Session::delete('user');
                header('Location: /jobaria/');die();
            }
            header('Location: /jobaria/');
        }
    }
    public function loginAction()
    {
        $redirect = !empty($this->_arrParam['redirect']) ? $this->_arrParam['redirect'] : '';
        $this->_view->block_errors = '';
        $this->_view->message_errors = '';
        if(isset($this->_arrParam['form'])){
            $login = $this->_model->login($this->_arrParam);
            if (!empty($login)){
//                if (!empty($redirect)){
//                    header('Location: /jobaria/'.$redirect);die();
//                }
                header('Location: /jobaria/my-account.html');die();
            }
            $this->_view->block_errors = 'd-block';
            $this->_view->message_errors = 'Incorrect account or password';
        }
        $this->_view->_redirect = !empty($redirect) ? 1 : 0;
        $this->_view->REQUEST_URI = $_SERVER['REQUEST_URI'];
        $this->_view->_module = $this->_arrParam['module'];
        $this->_view->_controller = $this->_arrParam['controller'];
        $this->_view->_action = $this->_arrParam['action'];
        $this->_view->render('account/login');
    }
    public function logoutAction(){
        Session::delete('user');
        header('Location: /jobaria/');
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
        $this->_view->_module = $this->_arrParam['module'];
        $this->_view->_controller = $this->_arrParam['controller'];
        $this->_view->_action = $this->_arrParam['action'];
        $this->_view->render('account/forgot');
    }
}