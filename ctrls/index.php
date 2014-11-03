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
    $view = 'index';
    $data = null;
    if(isset($_GET['v']) && $_GET['v'] == 'rss'){
        $view = 'rss';
        $data = reborn::data()->getRecent(10);
    }else{
        $data = reborn::data()->getByDate($date);
    }
    reborn::render($view, array(
        'news' => $data,
        'date' => $date,
        'is_today' => $date == date('Ymd')
    ));
