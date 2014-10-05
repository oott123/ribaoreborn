<?php
    if(!class_exists('reborn')) die('Access is not allowed here');
    //检查关键词
    if(!isset($_GET['keyword'])){
        die('<script>alert("搜索关键词不能为空~");history.go(-1);</script>');
    }
    //检查搜索排序
    $rank = false;
    if(isset($_GET['rank']) && $_GET['rank']){
        $rank = true;
    }
    //检查搜索方式
    $method = 'searchByTitle';
    if(isset($_GET['searchByContent'])){
        $method = 'searchByContent';
    }
    //调取搜索结果
    $data = reborn::data()->$method($_GET['keyword'], $rank,
        $_GET['page']*20);
    //为模版准备的上下页链接
    function getPageLink($to){
        $vars = $_GET;
        $vars['page'] = intval($_GET['page']) + $to;
        return http_build_query($vars);
    }
    reborn::render('search', array(
        'keyword' => $_GET['keyword'],
        'rank' => $rank,
        'data' => $data
    ));