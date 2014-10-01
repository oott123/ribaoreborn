<?php
    chdir(dirname(__FILE__). '/../');
    require './include/bootstrap.inc.php';
    reborn::init();
    reborn::data()->getByDate(date('Ymd'), 1);