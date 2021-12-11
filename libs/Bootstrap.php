<?php
class Bootstrap{

    private $_params;
    private $_controllerObject;

    public function init(){
        $this->setParam();

        $controllerName	= ucfirst($this->_params['controller']) . 'Controller';
        $filePath	= APPLICATION_PATH . $this->_params['module'] . DS . 'controllers' . DS . $controllerName . '.php';
        
        if(file_exists($filePath)){
            $this->loadExistingController($filePath, $controllerName);
            $this->callMethod();
        }else{
            $this->_error();
        }
    }

    // CALL METHODE
    private function callMethod(){
        $actionName = $this->_params['action'] . 'Action';
        if(method_exists($this->_controllerObject, $actionName)==true){
            $module = $this->_params['module'];
            $controller = $this->_params['controller'];
            $action = $this->_params['action'];
            if($module == 'admin'){
                $this->_controllerObject->{$actionName}();
            }else if($module == 'default'){

            }

        }else{
            $this->_error();
        }

    }
    private function callLoginAction($module = 'default'){
        Session::delete('user');
        require_once (APPLICATION_PATH . $module . DS . 'controllers' . DS . 'IndexController.php');
        $indexController = new IndexController($this->_params);
        $indexController->loginAction();
    }
    // SET PARAMS
    public function setParam(){
        $this->_params 	= array_merge($_GET, $_POST);
        $this->_params['module'] 		= isset($this->_params['module']) ? $this->_params['module'] : DEFAULT_MODULE;
        $this->_params['controller'] 	= isset($this->_params['controller']) ? $this->_params['controller'] : DEFAULT_CONTROLLER;
        $this->_params['action'] 		= isset($this->_params['action']) ? $this->_params['action'] : DEFAULT_ACTION;
    }

    // LOAD EXISTING CONTROLLER
    private function loadExistingController($filePath, $controllerName){
        require_once $filePath;
        $this->_controllerObject = new $controllerName($this->_params);
    }

    // ERROR CONTROLLER
    public function _error(){
        require_once APPLICATION_PATH . 'default' . DS . 'views' . DS . 'error.html';
    }
}