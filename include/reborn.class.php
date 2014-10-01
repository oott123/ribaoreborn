<?php
    class reborn{
        static private $data;
        static private $base_dir;
        static function init(){
            if(!defined('SAE_MYSQL_USER')){
                //不是SAE环境
                define('NOT_SAE', true);
                define('SAE_MYSQL_USER', rebornConfig::db_user);
                define('SAE_MYSQL_PASS', rebornConfig::db_pass);
                define('SAE_MYSQL_HOST_M', rebornConfig::db_host);
                define('SAE_MYSQL_PORT', rebornConfig::db_port);
                define('SAE_MYSQL_DB', rebornConfig::db_name);
            }
            self::$data = new rebornData();
            self::$base_dir = dirname(__FILE__). '/../';
        }
        static function data(){
            return self::$data;
        }
        static function render($view, $extract_data){
            extract($extract_data);
            include self::$base_dir. 'views/'. $view. '.php';
        }
    }