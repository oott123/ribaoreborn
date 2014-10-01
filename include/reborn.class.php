<?php
    class reborn{
        static private $data;
        static public $base_dir;
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

        /**
         * @return rebornData
         */
        static function data(){
            return self::$data;
        }
        static function render($view, $extract_data = array()){
            extract($extract_data);
            include self::$base_dir. 'views/'. $view. '.php';
        }
        static function boot($controller){
            //路由到控制器
            if(!preg_match('/[0-9a-z_-]/', $controller)){
                die('illegal controller');
            }
            include self::$base_dir. 'ctrls/'. $controller. '.php';
        }
        static function dateToTime($date){
            $year = substr($date, 0, 4);
            $month = substr($date, 4, 2);
            $day2 = substr($date, 6);
            $now = "{$year}-{$month}-{$day2} 08:00:00";
            $now = strtotime($now);
            return $now;
        }
        static function genTitle($date){
            $time = self::dateToTime($date);
            $day = explode(',', ',一,二,三,四,五,六,日');
            $day = $day[date('N', $time)];
            return date('Y.n.j 星期', $time).$day;
        }
    }