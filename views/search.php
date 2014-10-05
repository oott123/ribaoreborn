<?php reborn::render('view_header', array('title'=>'搜索 '.$keyword));?>
<body>
<h1><?php echo '搜索 '.$keyword;?></h1>
<?php reborn::render('search_box', array('rank'=>$rank, 'keyword'=> $keyword));?>
<?php foreach($data as $datum):
    reborn::render('display_item', array('datum' => $datum));
endforeach;?>
<div class="pager">
    <span class="count">
        共 <?php echo $count;?> 篇
    </span>
<?php
    $page = isset($_GET['page'])?intval($_GET['page']):1;
    $maxpage = ceil($count / rebornConfig::search_page_count);
?>
<?php if($page > 1):?>
    <a href="?<?php echo getPageLink(-1);?>">上一页</a>
<?php endif;if($page < $maxpage):?>
    <a href="?<?php echo getPageLink(1);?>">下一页</a>
<?php endif;?>
</div>
</body>
</html>