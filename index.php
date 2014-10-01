<?php
    require 'include/bootstrap.inc.php';
    $controller = isset($_GET['c']) ? $_GET['c'] : 'index';
    reborn::boot($controller);
