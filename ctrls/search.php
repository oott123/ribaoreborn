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
    //检查搜索页码
    $page = isset($_GET['page'])?intval($_GET['page']):1;
    //调取搜索结果
    $data = reborn::data()->$method($_GET['keyword'], $rank,
        ($page-1)*20);
    //为模版准备的上下页链接
    function getPageLink($to){
        $vars = $_GET;
        $page = isset($_GET['page'])?intval($_GET['page']):1;
        $vars['page'] = $page + $to;
        return http_build_query($vars);
    }
    //为模版准备的生成高亮
    function highlight($title){
        $keyword = $_GET['keyword'];
        $keyword = explode(' ', $keyword);
        $keyword = array_map('preg_quote', $keyword);
        $keyword = implode('|', $keyword);
        return preg_replace(
            "/{$keyword}/",
            '<span class="highlight">\0</span>',
            $title
        );
    }
    reborn::render('search', array(
        'keyword' => $_GET['keyword'],
        'rank' => $rank,
        'data' => $data
    ));