<?php
    //读取内容用
    $id = intval($_GET['id']);
    if($id < 1){
        die('no such a id');
    }
    $content = reborn::data()->getStory($id);
    $next = reborn::data()->getNext($content['order_id'], $content['date']);
    reborn::render('content', array(
        'content' => $content,
        'next' => $next
    ));
