<?php
    if(!class_exists('reborn')) die('Access is not allowed here');
    //检查date
    $date = date('Ymd');
    if(isset($_GET['date'])){
        $date = $_GET['date'] + 0;
    }
    if($date > 20220101 || $date < 20080101){
        die('no such a date');
    }
    $data = reborn::data()->getByDate($date);
    reborn::render('index', array(
        'news' => $data,
        'date' => $date
    ));
