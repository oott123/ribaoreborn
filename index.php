<?php
    require 'include/bootstrap.inc.php';
    $controller = isset($_GET['c']) ? $_GET['c'] : 'index'; //默认路由
    reborn::boot($controller);
