<?php
    //注册自动导入
    function zhihuribao_reborn_spl($class){
        $filename = dirname(__FILE__). '/'. $class. '.class.php';
        if(is_file($filename)){
            include_once $filename;
        }
    }
    spl_autoload_register('zhihuribao_reborn_spl');
    //初始化 reborn 实例
    reborn::init();