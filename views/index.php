<?php reborn::render('view_header', array('title'=>reborn::genTitle($date)));?>
<body>
	<h1><?php echo reborn::genTitle($date);?></h1>
	<?php foreach($news as $datum):
        reborn::render('display_item', array('datum' => $datum));
    endforeach;?>
	<div class="pager">
	<?php if($is_today):?>
		这是今天的最新消息&nbsp;
	<?php else:?>
		<a href="?">回到今天</a>
		<a href="?date=<?php echo rebornApi::get_next_day($date);?>">查看后一天</a>
	<?php endif;?>
		<a href="?date=<?php echo rebornApi::get_next_day($date,-1);?>">查看前一天</a>
	</div>
<?php reborn::render('search_box');?>
</body>
</html>