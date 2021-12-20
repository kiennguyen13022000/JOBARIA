<?php

class UserController extends Controller
{
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        if(!empty($_SESSION['user'])){
            $user_id = $_SESSION['user']['user_id'];
            $query = "SELECT id FROM users WHERE id='$user_id' and status=1 & is_Admin=0";
            $info_user = $this->_model->OneRecord($query);
        }
        if ($arrParams['action'] != 'signup' && (empty($_SESSION['user']['loggedIn']) || empty($info_user))){
            Session::delete('user');
            header('Location: /jobaria/');
        }
    }
    public function formAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->title     = 'Infomation';
        $this->_view->errors    = null;
        $requiredPass = false;
        $task = 'edit';
        $userInfo = $_SESSION['user']['userInfo'];
        $this->_view->result = $userInfo;
        $this->_view->result['password'] = '';
        if(!empty($_FILES['avatar'])) $this->_arrParam['form']['avatar'] = $_FILES['avatar'];

        if(isset($this->_arrParam['form'])){
            $queryUserName = "select `id` from `users` where `username` = ". "'" . $this->_arrParam['form']['username'] . "'";
            $queryEmail = "select `id` from `users` where `email` = " . "'" . $this->_arrParam['form']['email'] . "'";
            $form = $this->_arrParam['form'];
            $queryUserName .= " and `id` <> ". $userInfo['id'];
            $queryEmail .= " and `id` <> ". $userInfo['id'];
            $form['id'] = $userInfo['id'];

            $validate   = new Validate($form);
            $validate->addRule('firstname', 'min', ['min' => 3])
                     ->addRule('lastname', 'min', ['min' => 3])
                     ->addRule('username', 'string-notExistsRecord', ['database' => $this->_model, 'query' => $queryUserName ,'min' => 3])
                     ->addRule('email', 'email-notExistsRecord', ['database' => $this->_model, 'query' => $queryEmail])
                     ->addRule('password', 'password', ['action' => 'add'], $requiredPass)
                     ->addRule('avatar', 'file', ['extension' => ['png', 'jpg']], false)
                     ->addRule('confirm_password', 'confirm_password', null , $requiredPass);

            $validate->run();
            if(!empty($validate->getError())){
                $this->_view->errors = $validate->getError();
                $this->_view->result = $validate->getResult();
            }else{
                $form = $validate->getResult();
                $this->_model->form($form);
                if($this->_model->affectedAction() == 1){
                    $_SESSION['user']['userInfo'] = $this->_model->info($form['id']);
                    Session::set('success', '\'' . 'edit'.  '\'' );
                    Url::redirect(null, null, null, null, 'my-information');
                }
            }
        }
        $this->_view->_module = $this->_arrParam['module'];
        $this->_view->_controller = $this->_arrParam['controller'];
        $this->_view->_action = $this->_arrParam['action'];
        $this->_view->task = $task;
        $this->_view->render('user/form');
    }
    public function signupAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->errors    = null;
        $requiredPass = true;
        if(isset($this->_arrParam['form'])){
            $username = $this->_arrParam['form']['username'];
            $queryUserName = "select `id` from `users` where `username` = ". "'" . $username . "'";
            $queryEmail = "select `id` from `users` where `email` = " . "'" . $this->_arrParam['form']['email'] . "'";
            $this->_arrParam['form']['status'] = 1;
            $this->_arrParam['form']['is_Admin'] = 0;
            $this->_arrParam['form']['created_at'] = date('Y-m-d H:i:s', time());
            $this->_arrParam['form']['updated_at'] = date('Y-m-d H:i:s', time());
            $form = $this->_arrParam['form'];
            $validate   = new Validate($form);
            $validate->addRule('firstname', 'min', ['min' => 3])
                ->addRule('lastname', 'min', ['min' => 3])
                ->addRule('username', 'string-notExistsRecord', ['database' => $this->_model, 'query' => $queryUserName ,'min' => 3])
                ->addRule('email', 'email-notExistsRecord', ['database' => $this->_model, 'query' => $queryEmail])
                ->addRule('password', 'password', ['action' => 'add'], $requiredPass)
                ->addRule('confirm_password', 'confirm_password', null , $requiredPass);

            $validate->run();
            if(!empty($validate->getError())){
                $this->_view->errors = $validate->getError();
                $this->_view->result = $validate->getResult();
            }else{
                $form = $validate->getResult();
                $this->_model->signup($form);
                if($this->_model->affectedAction() == 1){
                    $query = "SELECT username, id, password, firstname, lastname, avatar FROM users WHERE username='$username' ";
                    $OneRecord = $this->_model->OneRecord($query);
                    if (empty($OneRecord)) return false;

                    $_SESSION['user'] = array(
                        'loggedIn'  => true,
                        'username'  => $username,
                        'user_id'   => $OneRecord['id'],
                        'userInfo'  => $OneRecord
                    );
                    header('Location: /jobaria/my-account.html');
                }
            }
        }
        $this->_view->_module = $this->_arrParam['module'];
        $this->_view->_controller = $this->_arrParam['controller'];
        $this->_view->_action = $this->_arrParam['action'];
        $this->_view->render('user/signup');
    }
    public function dashboardAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->categories            = $this->_model->getCategory();
        $this->_view->_module = $this->_arrParam['module'];
        $this->_view->_controller = $this->_arrParam['controller'];
        $this->_view->render('user/dashboard');
    }

    public function wishlistAction(){
        $this->_view->sevenBanner           = $this->_model->getTopBanners(7);
        $this->_view->settings              = $this->_model->getSettings();
        $this->_view->render('account/wishlist');
    }

    public function addToFavoritesAction(){

        $userId = Session::get('user')['user_id'];
        if (empty($userId)){
            echo json_encode('error');
        }else{
            $id = $this->_arrParam['id'];
            $this->_model->addToFavorites($id, $userId);
            echo json_encode('success');
        }

    }

}