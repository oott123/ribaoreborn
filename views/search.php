<?php reborn::render('view_header', array('title'=>'搜索 '.$keyword));?>
<body>
<h1><?php echo '搜索 '.$keyword;?></h1>
<?php reborn::render('search_box');?>
<?php foreach($data as $datum):
    reborn::render('display_item', array('datum' => $datum));
endforeach;?>
<div class="pager">
    233
</div>
</body>
</html>