<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title><?php echo htmlspecialchars($news_entry['title']);?></title>
	<link rel="stylesheet" href="general.css" />
	<base target="_blank" />
</head>
<body class="night">
	<div class="headimg" style="background-image:url('img.php?url=<?php echo $news_entry["image"];?>');">
		<div id="content"></div>
	</div>
	<h1 class="headtitle"><?php echo nl2br(htmlspecialchars($news_entry['title']));?></h1>
	<div class="body">
<?php 
	$body = $entry_data['body'];
	$body = preg_replace('#<img(.*?) src="(.*?)"#', '<img$1 src="img.php?url=$2"', $body);
	echo $body;
?>
	</div>
	<?php if($next):?>
	<div class="pager">
		<a href="content.php?before=<?php echo $_GET['before']+0;?>&amp;id=<?php echo $next;?>#content" target="_self">下一篇</a>
	</div>
	<?php endif;?>
	<div class="pager">
		<a href="index.php?before=<?php echo $_GET['before']+0;?>#entry<?php echo $news_entry["id"];?>" target="_self">列表</a>
		<a href="<?php echo $entry_data['share_url'];?>">分享页</a>
		<a href="<?php echo $entry_data['share_image'];?>">图片分享</a>
	</div>
</body>
</html>