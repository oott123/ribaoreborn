<?php
    //注册自动导入
    function ribao_reborn_spl($class){
        $filename = dirname(__FILE__). '/'. $class. '.class.php';
        if(is_file($filename)){
            include_once $filename;
        }
    }
    spl_autoload_register('ribao_reborn_spl');