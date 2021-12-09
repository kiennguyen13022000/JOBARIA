<?php
class View{

    public $_moduleName;
    public $_title;
    public $_fileView;
    private $_templatePath;

    public function __construct($moduleName){
        $this->_moduleName = $moduleName;
       $this->setTemplatePath();
    }

    public function render($fileInclude, $loadFull = true){

        $path = APPLICATION_PATH. $this->_moduleName . DS . 'views' . DS . $fileInclude . '.php';
       
        if(file_exists($path)){
             if($loadFull == true){
                $this->_fileView = $fileInclude;
                if(file_exists($this->_templatePath)){
                    require_once $this->_templatePath;
                }
            }else{
                require_once $path;
            }
        }else{
            echo '<h3>' . __METHOD__ . ': Error</h3>';
        }
    }

    // CREATE TITLE
    public function createTitle($value){
        return '<title>'.$value.'</title>';
    }

    // SET TITLE
    public function setTitle($value){
        $this->_title = '<title>'.$value.'</title>';
    }

    // setTemplatePath
    public function setTemplatePath(){
        $this->_templatePath = TEMPLATE_PATH . $this->_moduleName . DS . 'index.php';
    }

    public function getField($field){
        return isset($field) ? $field : '';
    }
}