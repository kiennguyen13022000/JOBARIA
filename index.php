<?php

require_once 'define.php';
spl_autoload_register(function ($classname){
    include_once LIBRARY_PATH . $classname . '.php';
});

$bootstrap = new Bootstrap();
Session::init();
$bootstrap->init();