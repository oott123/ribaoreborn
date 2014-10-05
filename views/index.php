<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>知乎日报网页阅读</title>
	<link rel="stylesheet" href="static/general.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
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
    <div class="search">
        <input type="text" name="keyword" placeholder="站内检索" />
        <input type="submit" name="search_title" value="标题检索"/>
        <input type="submit" name="search_body" value="全文检索" />
    </div>
</body>
</html>