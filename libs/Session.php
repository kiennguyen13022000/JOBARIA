<?php
class Session{

    public static function init(){
        session_start();
    }

    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null){
        if(isset($_SESSION[$key])) return $_SESSION[$key];

        return $default;
    }

    public static function delete($key){
        if(isset($_SESSION[$key])) unset($_SESSION[$key]);
    }

    public static function destroy(){
        session_destroy();
    }
    public static function checkSession(){
        self::init();
        if (self::get("login") == true){
            header("Location:index.php");
        }
    }
    public static function checkLogin(){
        self::init();
        if (self::get("login") == true){
            header("Location:index.php");
        }
    }
}

