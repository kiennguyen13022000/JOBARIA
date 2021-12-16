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
        $task = 'add';
        $this->_view->errors    = null;
        $requiredPass = true;

        $userInfo = $_SESSION['user']['userInfo'];
        if(!empty($_FILES['avatar'])) $this->_arrParam['form']['avatar'] = $_FILES['avatar'];
        if (isset($this->_arrParam['id'])){
            $this->_view->result = $this->_model->info($this->_arrParam['id']);
            $this->_view->result['password'] = '';
            $task = 'edit';
            $requiredPass = false;
            $this->_view->title     = 'Edit user';
            $this->_view->id = $this->_arrParam['id'];
        }
        if(isset($this->_arrParam['form'])){
            $queryUserName = "select `id` from `users` where `username` = ". "'" . $this->_arrParam['form']['username'] . "'";
            $queryEmail = "select `id` from `users` where `email` = " . "'" . $this->_arrParam['form']['email'] . "'";
            $form = $this->_arrParam['form'];
            if (isset($this->_arrParam['id'])){
                $queryUserName .= " and `id` <> ". $this->_arrParam['id'];
                $queryEmail .= " and `id` <> ". $this->_arrParam['id'];
                $form['id'] = $this->_arrParam['id'];
            }

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

                $this->_model->form($form, $task);
                if($this->_model->affectedAction() == 1){
                    if ($task == 'add'){
                        Session::set('success', '\'' . 'add'.  '\'' );
                        Url::redirect('admin', 'user', 'form');
                    }else{
                        Session::set('success', '\'' . 'edit'.  '\'' );
                        Url::redirect('admin', 'user', 'form', ['task' => 'edit', 'id' => $this->_arrParam['id']]);
                    }

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
        $this->_view->_module = $this->_arrParam['module'];
        $this->_view->_controller = $this->_arrParam['controller'];
        $this->_view->render('user/dashboard');
    }

}