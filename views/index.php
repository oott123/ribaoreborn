<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>知乎日报网页阅读</title>
	<link rel="stylesheet" href="general.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>

<?php var_dump($data);?>
	<h1><?php echo $data['display_date'];?></h1>
	<?php foreach($data['news'] as $datum):?>
		<div class="entry" id="entry<?php echo $datum['id'];?>">
			<p class="title">
				<img class="title_img" src="img.php?url=<?php echo $datum['image'];?>"/>
				<a class="title_text" href="content.php?id=<?php echo $datum['id'];?>&amp;before=<?php echo $_GET['before']+0;?>#content"><?php echo nl2br(htmlspecialchars($datum['title']));?></a>
			</p>
		</div>
	<?php endforeach;?>
	<div class="pager">
	<?php if($data['date']>=$today):?>
		这是今天的最新消息&nbsp;
	<?php else:?>
		<a href="?">回到今天</a>
		<a href="?before=<?php echo get_next_day($_GET['before']);?>">查看后一天</a>
	<?php endif;?>
		<a href="?before=<?php echo get_next_day($_GET['before'],-1);?>">查看前一天</a>
	</div>
</body>
</html>