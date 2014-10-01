<?php
    $url = $_GET['url'];
    if(!preg_match('#^http://p(ic)?[0-9]+\.zhimg\.com#', $url)){
        die('Access Denied');
    }
    //防盗链保护
    if(!isset($_SERVER['HTTP_REFERER'])){
        die('Welcome to zhihuribao reborn');
    }
    if(!preg_match('#^http://'. preg_quote($_SERVER['HTTP_HOST']).
        '#', $_SERVER['HTTP_REFERER'])){
        die('Hotlink protected');
    }
    include 'include/bootstrap.inc.php';
    reborn::init();
    $cache = new SScache(reborn::$base_dir.rebornConfig::cache_dir, 36000);
    $img = $cache->get($url);
    if(!$img){
        header('X-SSCache: MISS');
        $curl = new Curl();
        $img = $curl->get($url);
        $cache->set($url, ($img));
    }else{
        header('X-SSCache: HIT');
    }
    header('Content-type: image/jpeg');
    echo $img;

